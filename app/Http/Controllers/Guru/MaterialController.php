<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreMaterialRequest;
use App\Models\Classroom;
use App\Models\Material;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MaterialController extends Controller
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

        return view('modulGuru.materialForm', [
            'classrooms' => $classrooms,
            'selectedClassroomId' => $selectedClassroomId,
            'material' => null,
        ]);
    }

    public function edit(Material $material): View
    {
        $user = Auth::user();
        $isAdmin = $user?->role === 'admin';
        $teacher = $this->resolveTeacher($material->classroom_id);

        $classrooms = Classroom::query()
            ->when(! $isAdmin && $teacher, fn ($q) => $q->where('teacher_id', $teacher->id))
            ->orderBy('name')
            ->get();

        return view('modulGuru.materialForm', [
            'classrooms' => $classrooms,
            'selectedClassroomId' => $material->classroom_id,
            'material' => $material,
        ]);
    }

    public function store(StoreMaterialRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $attachmentPath = $request->file('attachment')?->store('materials', 'public');
        $user = $request->user();
        $isAdmin = $user?->role === 'admin';
        $teacher = $this->resolveTeacher($data['classroom_id']);

        $classroomQuery = Classroom::query();
        if (! $isAdmin && $teacher) {
            $classroomQuery->where('teacher_id', $teacher->id);
        }
        $classroom = $classroomQuery->findOrFail($data['classroom_id']);
        $teacherId = $teacher?->id ?? $classroom->teacher_id ?? Teacher::first()?->id;

        Material::create([
            ...$data,
            'attachment_path' => $attachmentPath,
            'teacher_id' => $teacherId,
            'classroom_id' => $classroom->id,
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        if ($data['status'] === 'published') {
            return redirect()->route('siswa.home')->with('success', 'Materi berhasil diterbitkan dan tampil di home siswa.');
        }

        return redirect()->route('guru.material.create')->with('success', 'Materi berhasil disimpan sebagai draf.');
    }

    public function update(StoreMaterialRequest $request, Material $material): RedirectResponse
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

        if ($request->hasFile('attachment')) {
            if ($material->attachment_path) {
                Storage::disk('public')->delete($material->attachment_path);
            }

            $data['attachment_path'] = $request->file('attachment')->store('materials', 'public');
        }

        unset($data['attachment']);
        $material->update([
            ...$data,
            'classroom_id' => $classroom->id,
            'published_at' => $data['status'] === 'published' ? ($material->published_at ?? now()) : null,
        ]);

        return redirect()->route('guru.kelas.learning', $classroom)->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Material $material): RedirectResponse
    {
        $classroom = $material->classroom;

        if ($material->attachment_path) {
            Storage::disk('public')->delete($material->attachment_path);
        }

        $material->delete();

        return redirect()->route('guru.kelas.learning', $classroom)->with('success', 'Materi berhasil dihapus.');
    }
}
