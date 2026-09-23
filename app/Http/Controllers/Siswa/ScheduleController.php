<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function index(): View
    {
        $student = Auth::user()?->student ?? Student::first();

        // Enrolled classrooms
        $classrooms = $student
            ? $student->classrooms()->with('teacher.user')->get()
            : Classroom::with('teacher.user')->get();

        // Upcoming quizzes/tryouts
        $tryouts = Quiz::with('classroom')
            ->where('status', 'published')
            ->orderBy('due_at')
            ->get();

        // Upcoming assignments
        $assignments = Assignment::with('classroom')
            ->where('status', 'published')
            ->orderBy('due_at')
            ->get();

        // Weekly schedule mock/curated items enriched with real classrooms
        $schedules = collect([
            [
                'id' => 1,
                'title' => 'Sesi Privat: Fisika Mekanika & Termodinamika',
                'category' => 'privat',
                'category_label' => 'Sesi Privat (1-on-1)',
                'tutor' => 'Dr. Hendra Wijaya, M.Pd',
                'day' => 'Senin',
                'time' => '16:00 - 17:30 WIB',
                'location' => 'Online Google Meet / Ruang Belajar 1',
                'type' => 'Privat Online',
                'status' => 'Mendatang',
                'badge_color' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            ],
            [
                'id' => 2,
                'title' => 'Bimbel Intensif: TPA & Penalaran Matematika MAN IC',
                'category' => 'bimbel',
                'category_label' => 'Kelas Bimbel Terpadu',
                'tutor' => 'Nurul Aini, S.Si',
                'day' => 'Rabu',
                'time' => '18:30 - 20:00 WIB',
                'location' => 'Lab Komputer & LMS Cakrawala',
                'type' => 'Mitra MAN Insan Cendikia',
                'status' => 'Mendatang',
                'badge_color' => 'bg-amber-50 text-amber-800 border-amber-200',
            ],
            [
                'id' => 3,
                'title' => 'Simulasi Tryout CBT: Skolastik & Literasi Nasional',
                'category' => 'tryout',
                'category_label' => 'Tryout CBT',
                'tutor' => 'Tim Akademik Cakrawala',
                'day' => 'Sabtu',
                'time' => '08:00 - 11:30 WIB',
                'location' => 'Portal CBT Cakrawala Educentre',
                'type' => 'Ujian Mandiri Berwaktu',
                'status' => 'Terbuka',
                'badge_color' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            ],
            [
                'id' => 4,
                'title' => 'Sesi Privat: Bahasa Inggris & Literasi Sains',
                'category' => 'privat',
                'category_label' => 'Sesi Privat (1-on-1)',
                'tutor' => 'Sarah Kusuma, S.Pd',
                'day' => 'Kamis',
                'time' => '15:30 - 17:00 WIB',
                'location' => 'Offline / Home Visit',
                'type' => 'Privat Guru Datang',
                'status' => 'Mendatang',
                'badge_color' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            ],
            [
                'id' => 5,
                'title' => 'Pendalaman Materi: Calistung & Konsep Dasar Sains',
                'category' => 'bimbel',
                'category_label' => 'Kelas Bimbel Terpadu',
                'tutor' => 'Ahmad Fauzi, S.Pd',
                'day' => 'Jumat',
                'time' => '14:00 - 15:30 WIB',
                'location' => 'Ruang Kelas Terpadu Cakrawala',
                'type' => 'Bimbel Reguler',
                'status' => 'Mendatang',
                'badge_color' => 'bg-blue-50 text-blue-700 border-blue-200',
            ],
        ]);

        return view('modulSiswa.jadwal', [
            'student' => $student,
            'classrooms' => $classrooms,
            'tryouts' => $tryouts,
            'assignments' => $assignments,
            'schedules' => $schedules,
        ]);
    }
}
