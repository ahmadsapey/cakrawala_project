<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreAssignmentRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AssignmentController extends Controller
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

    public function create(): View
    {
        $user = Auth::user();
        $isAdmin = $user?->role === 'admin';
        $selectedClassroomId = request()->integer('classroom_id') ?: null;
        $teacher = $this->resolveTeacher($selectedClassroomId);

        if ($isAdmin || ! $teacher) {
            $classrooms = Classroom::orderBy('name')->get();
        } else {
            $classrooms = Classroom::where('teacher_id', $teacher->id)->orderBy('name')->get();
            if ($classrooms->isEmpty()) {
                $classrooms = Classroom::orderBy('name')->get();
            }
        }

        return view('modulGuru.assignmentForm', [
            'classrooms' => $classrooms,
            'selectedClassroomId' => $selectedClassroomId,
        ]);
    }

    public function store(StoreAssignmentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $classroom = Classroom::findOrFail($data['classroom_id']);

        $user = $request->user();
        $teacher = $user?->teacher ?? $this->resolveTeacher($classroom->id);
        $teacherId = $teacher?->id ?? $classroom->teacher_id ?? Teacher::first()?->id;

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('assignments', 'public');
        }

        unset($data['attachment']);

        Assignment::create([
            ...$data,
            'attachment_path' => $attachmentPath,
            'teacher_id' => $teacherId,
            'classroom_id' => $classroom->id,
        ]);

        return redirect()->route('guru.tugas.tambah')->with('success', 'Tugas berhasil disimpan.');
    }
}
