<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreLearningRecommendationRequest;
use App\Models\Classroom;
use App\Models\LearningRecommendation;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LearningRecommendationController extends Controller
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

    public function store(StoreLearningRecommendationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $teacher = $this->resolveTeacher($data['classroom_id'] ?? null);
        $teacherId = $teacher?->id;

        abort_unless($teacherId, 403);

        LearningRecommendation::create([
            ...$data,
            'teacher_id' => $teacherId,
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        return redirect()->route('guru.kelas')->with('success', 'Rekomendasi belajar berhasil disimpan.');
    }
}
