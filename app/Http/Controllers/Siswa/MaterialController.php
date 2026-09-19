<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(Request $request): View
    {
        $student = Student::find(session('student_id'));
        $classroomIds = $student?->classrooms()->pluck('classrooms.id');
        $materialsQuery = Material::with('teacher.user')
            ->where('status', 'published');
        $assignmentsQuery = Assignment::with('classroom')
            ->where('status', 'published');
        $quizzesQuery = Quiz::with('classroom')
            ->where('status', 'published');

        if ($classroomIds?->isNotEmpty()) {
            $materialsQuery->whereIn('classroom_id', $classroomIds);
            $assignmentsQuery->whereIn('classroom_id', $classroomIds);
            $quizzesQuery->whereIn('classroom_id', $classroomIds);
        }

        if ($request->filled('subject')) {
            $materialsQuery->where('subject', $request->string('subject')->toString());
        }

        return view('modulSiswa.materials.index', [
            'materials' => $materialsQuery
                ->latest('published_at')
                ->get(),
            'assignments' => $assignmentsQuery->latest()->get(),
            'quizzes' => $quizzesQuery->latest()->get(),
        ]);
    }
}
