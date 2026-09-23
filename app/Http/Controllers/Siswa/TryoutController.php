<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TryoutController extends Controller
{
    public function index(): View
    {
        $student = Auth::user()?->student ?? Student::first();

        $tryouts = Quiz::with(['classroom', 'questions'])
            ->where('status', 'published')
            ->latest()
            ->get();

        $submissions = $student
            ? QuizSubmission::where('student_id', $student->id)->get()->keyBy('quiz_id')
            : collect();

        return view('modulSiswa.tryoutIndex', [
            'tryouts' => $tryouts,
            'submissions' => $submissions,
            'student' => $student,
        ]);
    }
}
