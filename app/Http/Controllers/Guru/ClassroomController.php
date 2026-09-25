<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreAttendanceRequest;
use App\Http\Requests\Guru\StoreClassroomRequest;
use App\Http\Requests\Guru\UpdateClassroomRequest;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $teacherId = Auth::user()?->teacher?->id;

        return view('modulGuru.classroomIndex', [
            'classrooms' => Classroom::query()->where('teacher_id', $teacherId)->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modulGuru.classroomForm', ['classroom' => new Classroom]);
    }

    public function learning(Classroom $classroom): View
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);

        return view('modulGuru.kelasGuru_pembelajaran', [
            'classroom' => $classroom,
            'materials' => $classroom->materials()->latest('published_at')->get(),
            'assignments' => $classroom->assignments()->latest()->get(),
            'quizzes' => $classroom->quizzes()->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request): RedirectResponse
    {
        Classroom::create([
            ...$request->validated(),
            'teacher_id' => $request->user()->teacher->id,
            'subject' => $request->user()->teacher->subject,
        ]);

        return redirect()->route('guru.kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom): View
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);

        return view('modulGuru.classroomShow', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom): View
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);

        return view('modulGuru.classroomForm', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        abort_unless($classroom->teacher_id === $request->user()->teacher->id, 404);
        $classroom->update($request->validated());

        return redirect()->route('guru.kelas')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom): RedirectResponse
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);
        $classroom->delete();

        return redirect()->route('guru.kelas')->with('success', 'Kelas berhasil dihapus.');
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
        $quizzes = $classroom ? $classroom->quizzes()->latest()->get() : collect();

        $totalItems = $materials->count() + $assignments->count() + $quizzes->count();
        $progressPercent = $totalItems > 0 ? min(100, round(($materials->where('status', 'published')->count() / $totalItems) * 100)) : 65;

        return view('modulGuru.detailKelas', [
            'classroom' => $classroom,
            'students' => $students,
            'materials' => $materials,
            'assignments' => $assignments,
            'quizzes' => $quizzes,
            'progressPercent' => $progressPercent,
        ]);
    }

    /**
     * Save student attendance records for a classroom session.
     */
    public function saveAttendance(StoreAttendanceRequest $request, Classroom $classroom): RedirectResponse
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);

        $validated = $request->validated();
        $studentIds = $classroom->students()->pluck('students.id')->all();
        $attendance = $validated['attendance'];
        $submittedStudentIds = array_map('intval', array_keys($attendance));

        abort_if(array_diff($submittedStudentIds, $studentIds), 422, 'Siswa tidak terdaftar di kelas ini.');

        $timestamp = now();
        $records = collect($studentIds)->map(fn (int $studentId): array => [
            'classroom_id' => $classroom->id,
            'student_id' => $studentId,
            'attendance_date' => $validated['date'],
            'status' => $attendance[$studentId] ?? 'absent',
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ])->all();

        Attendance::upsert($records, ['classroom_id', 'student_id', 'attendance_date'], ['status', 'updated_at']);

        return redirect()->route('guru.kelas.absensi', ['classroom' => $classroom, 'date' => $validated['date']])
            ->with('success', "Presensi kehadiran kelas {$classroom->name} berhasil disimpan.");
    }

    public function attendance(Classroom $classroom): View
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);

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
