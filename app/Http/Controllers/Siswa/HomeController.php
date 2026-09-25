<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\LearningRecommendation;
use App\Models\Material;
use App\Models\Student;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $student = Student::with('user')->find(session('student_id'));
        $hasEnrolledClassrooms = $student && $student->classrooms()->exists();

        $classrooms = $hasEnrolledClassrooms
            ? $student->classrooms()->with('teacher.user')->withCount('students')->latest()->limit(4)->get()
            : Classroom::with('teacher.user')->latest()->limit(4)->get();

        $publishedMaterials = Material::query()
            ->where('status', 'published')
            ->when(
                $hasEnrolledClassrooms,
                fn ($query) => $query->whereIn('classroom_id', $student->classrooms()->select('classrooms.id'))
            );

        return view('modulSiswa.home', [
            'student' => $student,
            'classrooms' => $classrooms,
            'subjects' => (clone $publishedMaterials)
                ->select('subject')
                ->selectRaw('count(*) as materials_count')
                ->whereNotNull('subject')
                ->groupBy('subject')
                ->orderBy('subject')
                ->get(),
            'recommendations' => LearningRecommendation::with('teacher.user')
                ->where('status', 'published')
                ->latest('published_at')
                ->limit(4)
                ->get(),
            'videoRecommendations' => (clone $publishedMaterials)
                ->with('teacher.user')
                ->whereNotNull('video_url')
                ->where('video_url', '!=', '')
                ->latest('published_at')
                ->limit(4)
                ->get(),
        ]);
    }
}
