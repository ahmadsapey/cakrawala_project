<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClassroomRequest;
use App\Http\Requests\Admin\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('modulAdmin.manageKelas', [
            'classrooms' => Classroom::with('teacher.user')->withCount('students')->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modulAdmin.createKelas', [
            'classroom' => null,
            'teachers' => Teacher::with('user')->where('status', 'active')->orderBy('id')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['subject'] = Teacher::findOrFail($data['teacher_id'])->subject;
        Classroom::create($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom): View
    {
        return view('modulAdmin.classroomShow', ['classroom' => $classroom->load(['teacher.user', 'students.user'])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom): View
    {
        return view('modulAdmin.createKelas', [
            'classroom' => $classroom,
            'teachers' => Teacher::with('user')->where('status', 'active')->orderBy('id')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        $data = $request->validated();
        $data['subject'] = Teacher::findOrFail($data['teacher_id'])->subject;
        $classroom->update($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom): RedirectResponse
    {
        $classroom->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
