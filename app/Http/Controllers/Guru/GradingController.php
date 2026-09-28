<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GradingController extends Controller
{
    /**
     * Show assignment correction dashboard.
     */
    public function taskCorrection(Request $request): View
    {
        $teacher = Auth::user()?->teacher ?? Teacher::first();

        $assignmentsQuery = Assignment::with(['classroom', 'submissions.student.user'])
            ->when($teacher, fn ($q) => $q->where('teacher_id', $teacher->id));

        $assignments = $assignmentsQuery->latest()->get();

        $allSubmissions = AssignmentSubmission::query()
            ->when($teacher, fn ($q) => $q->whereHas('assignment', fn ($aq) => $aq->where('teacher_id', $teacher->id)))
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
     * Show quiz analytics dashboard.
     */
    public function quizAnalytics(Request $request, ?Quiz $quiz = null): View
    {
        $teacher = Auth::user()?->teacher ?? Teacher::first();

        if (! $quiz || ! $quiz->exists) {
            $quizId = $request->query('quiz_id');
            $quiz = $quizId ? Quiz::find($quizId) : Quiz::when($teacher, fn ($q) => $q->where('teacher_id', $teacher->id))->latest()->first();
        }

        if (! $quiz) {
            $quiz = Quiz::with('classroom')->first();
        }

        $quizzes = Quiz::when($teacher, fn ($q) => $q->where('teacher_id', $teacher->id))->get();

        $submissions = $quiz ? $quiz->submissions()->with('student.user')->get() : collect();
        $totalParticipants = $submissions->count();

        $avgScore = $totalParticipants > 0 ? round($submissions->avg('score'), 1) : 0;
        $passingScore = $quiz?->passing_score ?? 75;
        $passedCount = $submissions->where('score', '>=', $passingScore)->count();
        $passRate = $totalParticipants > 0 ? round(($passedCount / $totalParticipants) * 100) : 0;

        // Score Distribution
        $distExcellent = $submissions->where('score', '>=', 90)->count();
        $distGood = $submissions->whereBetween('score', [75, 89.99])->count();
        $distBelow = $submissions->where('score', '<', 75)->count();

        // Hardest question calculation
        $questions = $quiz ? $quiz->questions()->get() : collect();
        $hardestQuestion = null;
        $lowestAccuracy = 100;

        if ($totalParticipants > 0 && $questions->isNotEmpty()) {
            foreach ($questions as $q) {
                $correct = 0;
                foreach ($submissions as $sub) {
                    $ans = $sub->answers[$q->id] ?? null;
                    if ($ans && strtoupper((string) $ans) === strtoupper($q->correct_answer)) {
                        $correct++;
                    }
                }
                $accuracy = ($correct / $totalParticipants) * 100;
                if ($accuracy <= $lowestAccuracy) {
                    $lowestAccuracy = round($accuracy, 1);
                    $hardestQuestion = [
                        'question' => $q,
                        'accuracy' => $lowestAccuracy,
                        'correct_students' => $correct,
                        'total_students' => $totalParticipants,
                    ];
                }
            }
        }

        return view('modulGuru.koreksiKuis', [
            'quiz' => $quiz,
            'quizzes' => $quizzes,
            'avgScore' => $avgScore,
            'passRate' => $passRate,
            'totalParticipants' => $totalParticipants,
            'distExcellent' => $distExcellent,
            'distGood' => $distGood,
            'distBelow' => $distBelow,
            'hardestQuestion' => $hardestQuestion,
        ]);
    }

    /**
     * Show classroom students list with attendance & recent grades.
     */
    public function classStudents(Request $request, ?Classroom $classroom = null): View
    {
        $teacher = Auth::user()?->teacher ?? Teacher::first();

        if (! $classroom || ! $classroom->exists) {
            $classroomId = $request->query('classroom_id');
            $classroom = $classroomId ? Classroom::find($classroomId) : Classroom::when($teacher, fn ($q) => $q->where('teacher_id', $teacher->id))->first();
        }

        if (! $classroom) {
            $classroom = Classroom::first();
        }

        $students = $classroom ? $classroom->students()->with([
            'user',
            'assignmentSubmissions' => fn ($q) => $q->latest(),
            'quizSubmissions' => fn ($q) => $q->latest(),
        ])->get() : collect();

        return view('modulGuru.viewSiswa', [
            'classroom' => $classroom,
            'students' => $students,
        ]);
    }
}
