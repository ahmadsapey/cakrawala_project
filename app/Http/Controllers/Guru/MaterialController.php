<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreMaterialRequest;
use App\Models\Classroom;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function create(): View
    {
        return view('modulGuru.materialForm', [
            'classrooms' => Classroom::where('teacher_id', Auth::user()?->teacher?->id)->orderBy('name')->get(),
            'selectedClassroomId' => request()->integer('classroom_id'),
            'material' => null,
        ]);
    }

    public function edit(Material $material): View
    {
        $teacherId = Auth::user()?->teacher?->id;
        abort_unless($teacherId, 403);

        $material = Material::where('teacher_id', $teacherId)->findOrFail($material->id);

        return view('modulGuru.materialForm', [
            'classrooms' => Classroom::where('teacher_id', $teacherId)->orderBy('name')->get(),
            'selectedClassroomId' => $material->classroom_id,
            'material' => $material,
        ]);
    }

    public function store(StoreMaterialRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $attachmentPath = $request->file('attachment')?->store('materials', 'public');
        $teacherId = Auth::user()?->teacher?->id;

        abort_unless($teacherId, 403);
        $classroom = Classroom::where('teacher_id', $teacherId)->findOrFail($data['classroom_id']);

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
        $teacherId = Auth::user()?->teacher?->id;
        abort_unless($teacherId, 403);

        $material = Material::where('teacher_id', $teacherId)->findOrFail($material->id);
        $classroom = Classroom::where('teacher_id', $teacherId)->findOrFail($data['classroom_id']);

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
        $teacherId = Auth::user()?->teacher?->id;
        abort_unless($teacherId, 403);

        $material = Material::where('teacher_id', $teacherId)->findOrFail($material->id);
        $classroom = $material->classroom;

        if ($material->attachment_path) {
            Storage::disk('public')->delete($material->attachment_path);
        }

        $material->delete();

        return redirect()->route('guru.kelas.learning', $classroom)->with('success', 'Materi berhasil dihapus.');
    }
}
