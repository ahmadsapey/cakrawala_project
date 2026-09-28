<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreClassroomRequest;
use App\Http\Requests\Guru\UpdateClassroomRequest;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    /**
     * Resolve the active teacher based on authentication, session, or database fallback.
     */
    private function resolveTeacher(): ?Teacher
    {
        $user = Auth::user();
        if ($user?->teacher) {
            return $user->teacher;
        }

        if (session('teacher_id')) {
            $teacher = Teacher::find(session('teacher_id'));
            if ($teacher) {
                return $teacher;
            }
        }

        return Teacher::with('user')->first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();
        $isAdmin = $user?->role === 'admin';
        $teacher = $this->resolveTeacher();

        $classrooms = Classroom::query()
            ->when(! $isAdmin && $teacher, fn ($q) => $q->where('teacher_id', $teacher->id))
            ->with(['teacher.user', 'schedules', 'materials', 'assignments'])
            ->withCount(['students', 'materials', 'assignments'])
            ->latest()
            ->get();

        return view('modulGuru.classroomIndex', [
            'classrooms' => $classrooms,
            'teacher' => $teacher,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        abort(403, 'Hanya admin yang berhak membuat kelas.');
    }

    public function learning(Classroom $classroom): View
    {
        $user = Auth::user();
        $teacher = $this->resolveTeacher();

        if ($user?->role !== 'admin') {
            abort_unless($classroom->teacher_id === $teacher?->id, 404);
        }

        if ($teacher || $classroom->teacher) {
            TeacherAttendance::firstOrCreate([
                'teacher_id' => $classroom->teacher_id ?: $teacher?->id,
                'classroom_id' => $classroom->id,
                'attendance_date' => now()->toDateString(),
            ], [
                'session_started_at' => now(),
                'status' => 'hadir',
            ]);
        }

        return view('modulGuru.kelasGuru_pembelajaran', [
            'classroom' => $classroom->load(['teacher.user', 'schedules']),
            'materials' => $classroom->materials()->latest('published_at')->get(),
            'assignments' => $classroom->assignments()->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request): RedirectResponse
    {
        abort(403, 'Hanya admin yang berhak membuat kelas.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom): View
    {
        $user = Auth::user();
        $teacher = $this->resolveTeacher();

        if ($user?->role !== 'admin') {
            abort_unless($classroom->teacher_id === $teacher?->id, 404);
        }

        return view('modulGuru.classroomShow', [
            'classroom' => $classroom->load(['teacher.user', 'schedules', 'students.user']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom): View
    {
        abort(403, 'Hanya admin yang berhak mengubah kelas.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        abort(403, 'Hanya admin yang berhak mengubah kelas.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom): RedirectResponse
    {
        abort(403, 'Hanya admin yang berhak menghapus kelas.');
    }

    /**
     * Display detailed progress, syllabus, and student members of a classroom.
     */
    public function detail(Request $request, ?Classroom $classroom = null): View
    {
        $teacher = Auth::user()?->teacher ?? Teacher::first();

        if (! $classroom || ! $classroom->exists) {
            $classroomId = $request->query('classroom_id');
            $classroom = $classroomId ? Classroom::find($classroomId) : Classroom::when($teacher, fn ($q) => $q->where('teacher_id', $teacher->id))->latest()->first();
        }

        if (! $classroom) {
            $classroom = Classroom::first();
        }

        $students = $classroom ? $classroom->students()->with('user')->get() : collect();
        $materials = $classroom ? $classroom->materials()->orderBy('created_at')->get() : collect();
        $assignments = $classroom ? $classroom->assignments()->latest()->get() : collect();

        $totalItems = $materials->count() + $assignments->count();
        $progressPercent = $totalItems > 0 ? min(100, round(($materials->where('status', 'published')->count() / $totalItems) * 100)) : 65;

        return view('modulGuru.detailKelas', [
            'classroom' => $classroom,
            'students' => $students,
            'materials' => $materials,
            'assignments' => $assignments,
            'progressPercent' => $progressPercent,
        ]);
    }

    /**
     * Save student attendance records for a classroom session.
     */
    public function saveAttendance(Request $request, Classroom $classroom): RedirectResponse
    {
        $user = Auth::user();
        $teacher = $this->resolveTeacher();

        if ($user?->role !== 'admin') {
            abort_unless($classroom->teacher_id === $teacher?->id, 404);
        }

        $date = $request->input('date', now()->toDateString());
        $attendance = $request->input('attendance', $request->input('attendances', []));
        $studentIds = $classroom->students()->pluck('students.id')->all();

        if (! empty($attendance)) {
            $statusMap = [
                'Hadir' => 'present',
                'hadir' => 'present',
                'present' => 'present',
                'Izin' => 'excused',
                'izin' => 'excused',
                'excused' => 'excused',
                'Sakit' => 'excused',
                'sakit' => 'excused',
                'Alpa' => 'absent',
                'alpa' => 'absent',
                'absent' => 'absent',
            ];

            $timestamp = now();
            $records = [];
            foreach ($studentIds as $studentId) {
                $rawStatus = $attendance[$studentId] ?? 'absent';
                $status = $statusMap[$rawStatus] ?? 'present';
                $records[] = [
                    'classroom_id' => $classroom->id,
                    'student_id' => $studentId,
                    'attendance_date' => $date,
                    'status' => $status,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }

            if (! empty($records)) {
                Attendance::upsert($records, ['classroom_id', 'student_id', 'attendance_date'], ['status', 'updated_at']);
            }
        }

        return redirect()->route('guru.kelas.absensi', ['classroom' => $classroom, 'date' => $date])
            ->with('success', "Presensi kehadiran kelas {$classroom->name} berhasil disimpan.");
    }

    public function attendance(Classroom $classroom): View
    {
        $user = Auth::user();
        $teacher = $this->resolveTeacher();

        if ($user?->role !== 'admin') {
            abort_unless($classroom->teacher_id === $teacher?->id, 404);
        }

        $date = request()->query('date', now()->toDateString());
        $students = $classroom->students()->with('user')->orderBy('class_name')->get();
        $attendance = Attendance::query()
            ->where('classroom_id', $classroom->id)
            ->whereDate('attendance_date', $date)
            ->get()
            ->keyBy('student_id');

        return view('modulGuru.absensi', compact('classroom', 'students', 'attendance', 'date'));
    }
}
