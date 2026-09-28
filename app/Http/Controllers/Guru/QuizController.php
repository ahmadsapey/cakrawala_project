<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreQuizRequest;
use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QuizController extends Controller
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
        $selectedClassroomId = request()->integer('classroom_id');
        $teacher = $this->resolveTeacher($selectedClassroomId);

        $classrooms = Classroom::query()
            ->when(! $isAdmin && $teacher, fn ($q) => $q->where('teacher_id', $teacher->id))
            ->orderBy('name')
            ->get();

        return view('modulGuru.quizForm', [
            'classrooms' => $classrooms,
            'selectedClassroomId' => $selectedClassroomId,
        ]);
    }

    public function store(StoreQuizRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $isAdmin = $user?->role === 'admin';
        $teacher = $this->resolveTeacher($data['classroom_id']);

        $classroomQuery = Classroom::query();
        if (! $isAdmin && $teacher) {
            $classroomQuery->where('teacher_id', $teacher->id);
        }
        $classroom = $classroomQuery->findOrFail($data['classroom_id']);

        $teacherId = $teacher?->id ?? $classroom->teacher_id ?? Teacher::first()?->id;

        Quiz::create([
            ...$data,
            'teacher_id' => $teacherId,
            'classroom_id' => $classroom->id,
        ]);

        return redirect()->route('guru.kuis.tambah')->with('success', 'Kuis berhasil disimpan.');
    }
}
