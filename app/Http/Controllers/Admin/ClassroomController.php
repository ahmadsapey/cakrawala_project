<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClassroomRequest;
use App\Http\Requests\Admin\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    public function index(): View
    {
        return view('modulAdmin.manageKelas', [
            'classrooms' => Classroom::with(['teacher.user', 'subjectRelation'])->withCount('students')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('modulAdmin.createKelas', [
            'classroom' => null,
            'schedule' => null,
            'teachers' => Teacher::with('user')->where('status', 'active')->orderBy('id')->get(),
            'subjects' => Subject::orderBy('name')->get(),
        ]);
    }

    public function store(StoreClassroomRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $teacher = Teacher::findOrFail($data['teacher_id']);

        if (! empty($data['subject_id'])) {
            $subject = Subject::find($data['subject_id']);
            $data['subject'] = $subject?->name ?? $teacher->subject;
        } else {
            $data['subject'] = $teacher->subject;
        }

        $classroom = Classroom::create([
            'teacher_id' => $data['teacher_id'],
            'subject_id' => $data['subject_id'] ?? null,
            'name' => $data['name'],
            'subject' => $data['subject'],
            'grade_level' => $data['grade_level'],
            'section' => $data['section'] ?? null,
            'online_meeting_url' => $data['online_meeting_url'] ?? null,
        ]);

        if (! empty($data['day_of_week']) && ! empty($data['start_time']) && ! empty($data['end_time'])) {
            Schedule::create([
                'classroom_id' => $classroom->id,
                'teacher_id' => $classroom->teacher_id,
                'subject_id' => $classroom->subject_id,
                'day_of_week' => $data['day_of_week'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'online_meeting_url' => $data['online_meeting_url'] ?? null,
            ]);
        }

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function show(Classroom $classroom): View
    {
        return view('modulAdmin.classroomShow', ['classroom' => $classroom->load(['teacher.user', 'students.user', 'schedules', 'subjectRelation'])]);
    }

    public function edit(Classroom $classroom): View
    {
        return view('modulAdmin.createKelas', [
            'classroom' => $classroom->load('schedules'),
            'schedule' => $classroom->schedules->first(),
            'teachers' => Teacher::with('user')->where('status', 'active')->orderBy('id')->get(),
            'subjects' => Subject::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        $data = $request->validated();
        $teacher = Teacher::findOrFail($data['teacher_id']);

        if (! empty($data['subject_id'])) {
            $subject = Subject::find($data['subject_id']);
            $data['subject'] = $subject?->name ?? $teacher->subject;
        } else {
            $data['subject'] = $teacher->subject;
        }

        $classroom->update([
            'teacher_id' => $data['teacher_id'],
            'subject_id' => $data['subject_id'] ?? null,
            'name' => $data['name'],
            'subject' => $data['subject'],
            'grade_level' => $data['grade_level'],
            'section' => $data['section'] ?? null,
            'online_meeting_url' => $data['online_meeting_url'] ?? null,
        ]);

        if (! empty($data['day_of_week']) && ! empty($data['start_time']) && ! empty($data['end_time'])) {
            $schedule = $classroom->schedules()->first();
            if ($schedule) {
                $schedule->update([
                    'teacher_id' => $classroom->teacher_id,
                    'subject_id' => $classroom->subject_id,
                    'day_of_week' => $data['day_of_week'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'online_meeting_url' => $data['online_meeting_url'] ?? null,
                ]);
            } else {
                Schedule::create([
                    'classroom_id' => $classroom->id,
                    'teacher_id' => $classroom->teacher_id,
                    'subject_id' => $classroom->subject_id,
                    'day_of_week' => $data['day_of_week'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'online_meeting_url' => $data['online_meeting_url'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Classroom $classroom): RedirectResponse
    {
        $classroom->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
