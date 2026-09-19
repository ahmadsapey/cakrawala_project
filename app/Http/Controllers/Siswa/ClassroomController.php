<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    public function index(): View
    {
        return view('modulSiswa.kelas', [
            'classrooms' => Classroom::with('teacher.user')->withCount('students')->latest()->get(),
        ]);
    }

    public function show(Classroom $classroom): View
    {
        return view('modulSiswa.classroomLearning', [
            'classroom' => $classroom->load('teacher.user'),
            'materials' => $classroom->materials()->where('status', 'published')->latest('published_at')->get(),
            'assignments' => $classroom->assignments()->where('status', 'published')->latest()->get(),
            'quizzes' => $classroom->quizzes()->where('status', 'published')->latest()->get(),
        ]);
    }
}
