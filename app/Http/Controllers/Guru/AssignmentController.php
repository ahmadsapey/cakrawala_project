<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreAssignmentRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AssignmentController extends Controller
{
    public function create(): View
    {
        return view('modulGuru.assignmentForm', ['classrooms' => Classroom::where('teacher_id', Auth::user()->teacher->id)->orderBy('name')->get(), 'selectedClassroomId' => request()->integer('classroom_id')]);
    }

    public function store(StoreAssignmentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $classroom = Classroom::where('teacher_id', $request->user()->teacher->id)->findOrFail($data['classroom_id']);
        Assignment::create([...$data, 'teacher_id' => $request->user()->teacher->id, 'classroom_id' => $classroom->id]);

        return redirect()->route('guru.tugas.tambah')->with('success', 'Tugas berhasil disimpan.');
    }
}
