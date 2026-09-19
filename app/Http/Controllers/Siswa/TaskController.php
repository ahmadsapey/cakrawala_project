<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Quiz;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        return view('modulSiswa.taskIndex', [
            'assignments' => Assignment::with('classroom')->where('status', 'published')->latest()->get(),
            'quizzes' => Quiz::with('classroom')->where('status', 'published')->latest()->get(),
        ]);
    }
}
