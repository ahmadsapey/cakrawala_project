<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreQuizRequest;
use App\Models\Classroom;
use App\Models\Quiz;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QuizController extends Controller
{
    public function create(): View
    {
        return view('modulGuru.quizForm', ['classrooms' => Classroom::where('teacher_id', Auth::user()->teacher->id)->orderBy('name')->get(), 'selectedClassroomId' => request()->integer('classroom_id')]);
    }

    public function store(StoreQuizRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $classroom = Classroom::where('teacher_id', $request->user()->teacher->id)->findOrFail($data['classroom_id']);
        Quiz::create([...$data, 'teacher_id' => $request->user()->teacher->id, 'classroom_id' => $classroom->id]);

        return redirect()->route('guru.kuis.tambah')->with('success', 'Kuis berhasil disimpan.');
    }
}
