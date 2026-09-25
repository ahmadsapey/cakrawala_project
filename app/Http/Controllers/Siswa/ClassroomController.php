<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    public function index(Request $request): View
    {
        $student = Student::find(session('student_id'));
        $query = $student
            ? $student->classrooms()->with('teacher.user')->withCount('students')
            : Classroom::query()->whereKey([]);

        if ($request->filled('subject') && $request->string('subject')->toString() !== 'Semua') {
            $query->where('subject', $request->string('subject'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();
            $query->where(function ($subQuery) use ($search): void {
                $subQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('teacher.user', function ($teacherQuery) use ($search): void {
                        $teacherQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $classrooms = $query->latest()->get();

        $availableSubjects = $student
            ? $student->classrooms()->whereNotNull('subject')->distinct()->pluck('subject')->toArray()
            : [];
        $defaultSubjects = ['Fisika', 'Matematika', 'Kimia', 'Biologi'];
        $subjects = array_values(array_unique(array_merge($defaultSubjects, $availableSubjects)));

        return view('modulSiswa.kelas', [
            'classrooms' => $classrooms,
            'subjects' => $subjects,
            'selectedSubject' => $request->input('subject', 'Semua'),
            'search' => $request->input('search', ''),
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
