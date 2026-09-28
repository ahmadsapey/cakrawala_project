<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GradingController extends Controller
{
    /**
     * Resolve active teacher or fallback safely for admin/preview mode.
     */
    private function resolveTeacher(?int $classroomId = null): ?Teacher
    {
        $user = Auth::user();
        if ($user?->teacher) {
            return $user->teacher;
        }

        if ($classroomId) {
            $classroom = Classroom::find($classroomId);
            if ($classroom?->teacher) {
                return $classroom->teacher;
            }
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
     * Show assignment correction dashboard.
     */
    public function taskCorrection(Request $request): View
    {
        $user = Auth::user();
        $isAdmin = $user?->role === 'admin';
        $teacher = $this->resolveTeacher();

        $assignmentsQuery = Assignment::with(['classroom', 'submissions.student.user'])
            ->when(! $isAdmin && $teacher, fn ($q) => $q->where('teacher_id', $teacher->id));

        $assignments = $assignmentsQuery->latest()->get();

        $allSubmissions = AssignmentSubmission::query()
            ->when(! $isAdmin && $teacher, fn ($q) => $q->whereHas('assignment', fn ($aq) => $aq->where('teacher_id', $teacher->id)))
            ->with(['assignment.classroom', 'student.user'])
            ->latest('submitted_at')
            ->get();

        $totalSubmissions = $allSubmissions->count();
        $gradedCount = $allSubmissions->where('status', 'graded')->count();
        $pendingCount = $allSubmissions->where('status', 'submitted')->count();

        return view('modulGuru.koreksiTugas', [
            'assignments' => $assignments,
            'submissions' => $allSubmissions,
            'totalSubmissions' => $totalSubmissions,
            'gradedCount' => $gradedCount,
            'pendingCount' => $pendingCount,
        ]);
    }

    /**
     * Show grade input form for a specific assignment submission.
     */
    public function inputGrade(?AssignmentSubmission $submission = null): View|RedirectResponse
    {
        if (! $submission || ! $submission->exists) {
            $submission = AssignmentSubmission::where('status', 'submitted')->latest()->first()
                ?? AssignmentSubmission::latest()->first();
        }

        if (! $submission) {
            return redirect()->route('guru.koreksi.tugas')->with('error', 'Belum ada tugas siswa yang dapat dinilai.');
        }

        $submission->load(['assignment.classroom', 'student.user']);

        return view('modulGuru.inputNilai_siswa', [
            'submission' => $submission,
            'assignment' => $submission->assignment,
            'student' => $submission->student,
        ]);
    }

    /**
     * Store grade and teacher feedback for a submission.
     */
    public function storeGrade(Request $request, AssignmentSubmission $submission): RedirectResponse
    {
        $request->validate([
            'score' => ['required', 'numeric', 'min:0', 'max:100'],
            'feedback' => ['nullable', 'string', 'max:2000'],
        ]);

        $submission->update([
            'score' => (float) $request->input('score'),
            'feedback' => $request->input('feedback'),
            'status' => 'graded',
            'graded_at' => now(),
        ]);

        return redirect()->route('guru.koreksi.tugas')->with('success', "Penilaian untuk {$submission->student?->user?->name} berhasil disimpan.");
    }

    /**
     * Show classroom students list with attendance & recent grades.
     */
    public function classStudents(Request $request, ?Classroom $classroom = null): View
    {
        $user = Auth::user();
        $isAdmin = $user?->role === 'admin';
        $teacher = $this->resolveTeacher();

        if (! $classroom || ! $classroom->exists) {
            $classroomId = $request->query('classroom_id');
            $classroom = $classroomId ? Classroom::find($classroomId) : Classroom::when(! $isAdmin && $teacher, fn ($q) => $q->where('teacher_id', $teacher->id))->first();
        }

        if (! $classroom) {
            $classroom = Classroom::first();
        }

        $students = $classroom ? $classroom->students()->with([
            'user',
            'assignmentSubmissions' => fn ($q) => $q->latest(),
        ])->get() : collect();

        return view('modulGuru.viewSiswa', [
            'classroom' => $classroom,
            'students' => $students,
        ]);
    }
}
