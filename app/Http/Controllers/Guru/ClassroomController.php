<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreClassroomRequest;
use App\Http\Requests\Guru\UpdateClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $teacherId = Auth::user()?->teacher?->id;

        return view('modulGuru.classroomIndex', [
            'classrooms' => Classroom::query()->where('teacher_id', $teacherId)->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modulGuru.classroomForm', ['classroom' => new Classroom]);
    }

    public function learning(Classroom $classroom): View
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);

        return view('modulGuru.kelasGuru_pembelajaran', [
            'classroom' => $classroom,
            'materials' => $classroom->materials()->latest('published_at')->get(),
            'assignments' => $classroom->assignments()->latest()->get(),
            'quizzes' => $classroom->quizzes()->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request): RedirectResponse
    {
        Classroom::create([
            ...$request->validated(),
            'teacher_id' => $request->user()->teacher->id,
        ]);

        return redirect()->route('guru.kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom): View
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);

        return view('modulGuru.classroomShow', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom): View
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);

        return view('modulGuru.classroomForm', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        abort_unless($classroom->teacher_id === $request->user()->teacher->id, 404);
        $classroom->update($request->validated());

        return redirect()->route('guru.kelas')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom): RedirectResponse
    {
        abort_unless($classroom->teacher_id === Auth::user()?->teacher?->id, 404);
        $classroom->delete();

        return redirect()->route('guru.kelas')->with('success', 'Kelas berhasil dihapus.');
    }
}
