<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentSubmissionController extends Controller
{
    /**
     * Store student assignment submission.
     */
    public function store(Request $request, Assignment $assignment): RedirectResponse
    {
        $request->validate([
            'submission_text' => ['nullable', 'string', 'max:5000'],
            'file' => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx,png,jpg,jpeg'],
        ]);

        if (! $request->filled('submission_text') && ! $request->hasFile('file')) {
            return back()->with('error', 'Harap isi catatan pengerjaan atau unggah berkas tugas.');
        }

        $student = Auth::user()?->student;
        if (! $student) {
            $student = Student::first();
        }

        $filePath = null;
        $fileName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('assignments', 'public');
        }

        AssignmentSubmission::updateOrCreate(
            [
                'assignment_id' => $assignment->id,
                'student_id' => $student->id,
            ],
            [
                'submission_text' => $request->input('submission_text'),
                'file_path' => $filePath ?? optional(AssignmentSubmission::where('assignment_id', $assignment->id)->where('student_id', $student->id)->first())->file_path,
                'file_name' => $fileName ?? optional(AssignmentSubmission::where('assignment_id', $assignment->id)->where('student_id', $student->id)->first())->file_name,
                'status' => 'submitted',
                'submitted_at' => now(),
            ]
        );

        return redirect()->route('siswa.tugas')->with('success', "Tugas \"{$assignment->title}\" berhasil dikumpulkan.");
    }
}
