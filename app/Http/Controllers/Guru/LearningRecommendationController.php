<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreLearningRecommendationRequest;
use App\Models\LearningRecommendation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LearningRecommendationController extends Controller
{
    public function store(StoreLearningRecommendationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $teacherId = Auth::user()?->teacher?->id;

        abort_unless($teacherId, 403);

        LearningRecommendation::create([
            ...$data,
            'teacher_id' => $teacherId,
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        return redirect()->route('guru.kelas')->with('success', 'Rekomendasi belajar berhasil disimpan.');
    }
}
