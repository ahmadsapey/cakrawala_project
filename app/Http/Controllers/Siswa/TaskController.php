<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $student = Auth::user()?->student ?? Student::first();

        $assignmentSubmissions = $student
            ? AssignmentSubmission::where('student_id', $student->id)->get()->keyBy('assignment_id')
            : collect();

        $quizSubmissions = $student
            ? QuizSubmission::where('student_id', $student->id)->get()->keyBy('quiz_id')
            : collect();

        return view('modulSiswa.tugas', [
            'assignments' => Assignment::with('classroom')->where('status', 'published')->latest()->get(),
            'quizzes' => Quiz::with('classroom')->where('status', 'published')->latest()->get(),
            'assignmentSubmissions' => $assignmentSubmissions,
            'quizSubmissions' => $quizSubmissions,
        ]);
    }
}
