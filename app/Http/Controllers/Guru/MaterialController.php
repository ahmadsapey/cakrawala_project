<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru\StoreMaterialRequest;
use App\Models\Classroom;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function create(): View
    {
        return view('modulGuru.materialForm', [
            'classrooms' => Classroom::where('teacher_id', Auth::user()?->teacher?->id)->orderBy('name')->get(),
            'selectedClassroomId' => request()->integer('classroom_id'),
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
}
