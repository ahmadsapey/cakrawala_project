<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $teacher = $user?->teacher;

        if (! $teacher && session('teacher_id')) {
            $teacher = Teacher::find(session('teacher_id'));
        }

        if (! $teacher) {
            $teacher = Teacher::with('user')->first();
        }

        $teacherName = $teacher?->user?->name ?? 'Bapak/Ibu Guru';
        $teacherSubject = $teacher?->subject ?? 'Sains & Teknologi';

        // Get teacher's classrooms
        $classroomsQuery = Classroom::withCount(['students', 'assignments', 'quizzes']);
        if ($teacher) {
            $classroomsQuery->where('teacher_id', $teacher->id);
        }
        $classrooms = $classroomsQuery->latest()->get();

        // Calculate active students across teacher's classrooms
        $classroomIds = $classrooms->pluck('id');
        $studentCount = Student::whereHas('classrooms', function ($q) use ($classroomIds): void {
            $q->whereIn('classrooms.id', $classroomIds);
        })->count();

        if ($studentCount === 0) {
            $studentCount = Student::where('status', 'active')->count();
        }

        // Active assignments & quizzes
        $assignments = Assignment::with('classroom')
            ->when($teacher, fn ($q) => $q->where('teacher_id', $teacher->id))
            ->latest()
            ->take(3)
            ->get();

        $quizzes = Quiz::with('classroom')
            ->when($teacher, fn ($q) => $q->where('teacher_id', $teacher->id))
            ->latest()
            ->take(3)
            ->get();

        $pendingTasksCount = $assignments->count() + $quizzes->count();

        return view('modulGuru.home', [
            'teacher' => $teacher,
            'teacherName' => $teacherName,
            'teacherSubject' => $teacherSubject,
            'studentCount' => $studentCount,
            'pendingTasksCount' => $pendingTasksCount,
            'classrooms' => $classrooms,
            'assignments' => $assignments,
            'quizzes' => $quizzes,
        ]);
    }
}
