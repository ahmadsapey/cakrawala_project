<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\Material;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => Hash::make('admin123'), 'role' => 'admin'],
        );

        User::updateOrCreate(
            ['email' => 'admin.demo@cakrawala.test'],
            ['name' => 'Admin Demo', 'password' => Hash::make('password123'), 'role' => 'admin'],
        );

        $fisikaSubject = Subject::updateOrCreate(
            ['code' => 'FIS'],
            ['name' => 'Fisika', 'description' => 'Mata pelajaran Fisika SMA'],
        );
        Subject::updateOrCreate(
            ['code' => 'MAT'],
            ['name' => 'Matematika', 'description' => 'Mata pelajaran Matematika SMA'],
        );
        Subject::updateOrCreate(
            ['code' => 'KIM'],
            ['name' => 'Kimia', 'description' => 'Mata pelajaran Kimia SMA'],
        );
        Subject::updateOrCreate(
            ['code' => 'BIO'],
            ['name' => 'Biologi', 'description' => 'Mata pelajaran Biologi SMA'],
        );

        $studentUser = User::updateOrCreate(
            ['email' => 'siswa.demo@cakrawala.test'],
            ['name' => 'Siswa Demo', 'password' => Hash::make('password123'), 'role' => 'student'],
        );
        $student = Student::updateOrCreate(
            ['user_id' => $studentUser->id],
            ['nisn' => '2026000001', 'class_name' => 'XII IPA 1', 'status' => 'active'],
        );

        $studentUser2 = User::updateOrCreate(
            ['email' => 'budi.siswa@cakrawala.test'],
            ['name' => 'Budi Santoso', 'password' => Hash::make('password123'), 'role' => 'student'],
        );
        $student2 = Student::updateOrCreate(
            ['user_id' => $studentUser2->id],
            ['nisn' => '2026000002', 'class_name' => 'XII IPA 1', 'status' => 'active'],
        );

        $teacherUser = User::updateOrCreate(
            ['email' => 'guru.demo@cakrawala.test'],
            ['name' => 'Guru Demo', 'password' => Hash::make('password123'), 'role' => 'teacher'],
        );
        $teacher = Teacher::updateOrCreate(
            ['user_id' => $teacherUser->id],
            ['nip' => '2026000001', 'subject' => 'Fisika', 'status' => 'active'],
        );

        $classroom = Classroom::updateOrCreate(
            ['teacher_id' => $teacher->id, 'name' => 'Fisika Modern & Praktikum'],
            [
                'subject' => 'Fisika',
                'subject_id' => $fisikaSubject->id,
                'online_meeting_url' => 'https://meet.google.com/abc-demo-xyz',
                'grade_level' => 'Kelas 12',
                'section' => 'XII IPA 1',
                'description' => 'Mempelajari hukum fisika modern, termodinamika, dan gelombang elektromagnetik.',
            ],
        );
        $classroom->students()->syncWithoutDetaching([$student->id, $student2->id]);

        Schedule::updateOrCreate(
            ['classroom_id' => $classroom->id, 'day_of_week' => 'Senin'],
            [
                'teacher_id' => $teacher->id,
                'subject_id' => $fisikaSubject->id,
                'start_time' => '08:00:00',
                'end_time' => '09:30:00',
                'online_meeting_url' => 'https://meet.google.com/abc-demo-xyz',
            ],
        );

        TeacherAttendance::firstOrCreate([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'attendance_date' => now()->toDateString(),
        ], [
            'session_started_at' => now(),
            'status' => 'hadir',
        ]);

        Payment::updateOrCreate(
            ['invoice_number' => 'INV-DEMO-0001'],
            [
                'student_id' => $student->id,
                'amount' => 1500000,
                'description' => 'SPP Semester 1',
                'status' => 'confirmed',
                'confirmed_at' => now(),
            ],
        );

        Payment::updateOrCreate(
            ['invoice_number' => 'INV-DEMO-0002'],
            [
                'student_id' => $student2->id,
                'amount' => 500000,
                'description' => 'Uang Praktikum Laboratorium',
                'status' => 'pending',
            ],
        );

        Material::updateOrCreate(
            ['teacher_id' => $teacher->id, 'title' => 'Gerak Lurus & Dinamika'],
            [
                'classroom_id' => $classroom->id,
                'subject' => 'Fisika',
                'summary' => 'Konsep dasar gerak lurus dan hukum Newton dalam kehidupan sehari-hari.',
                'video_url' => 'https://www.youtube.com/watch?v=demo',
                'status' => 'published',
                'published_at' => now(),
            ],
        );

        $assignment = Assignment::updateOrCreate(
            ['teacher_id' => $teacher->id, 'classroom_id' => $classroom->id, 'title' => 'Laporan Praktikum Efek Fotolistrik'],
            [
                'instructions' => 'Susun laporan praktikum bab efek fotolistrik sesuai format lab.',
                'points' => 100,
                'due_at' => now()->addDays(5),
                'status' => 'published',
            ],
        );

        AssignmentSubmission::updateOrCreate(
            ['assignment_id' => $assignment->id, 'student_id' => $student->id],
            [
                'submission_text' => 'Laporan praktikum lengkap efek fotolistrik telah disusun bersama analisis grafik frekuensi ambang.',
                'file_name' => 'Laporan_Fotolistrik_SiswaDemo.pdf',
                'score' => 95.00,
                'feedback' => 'Analisis data dan kesimpulan sangat lengkap dan terstruktur rapi. Pertahankan!',
                'status' => 'graded',
                'submitted_at' => now()->subDays(1),
                'graded_at' => now()->subHours(2),
            ],
        );

        AssignmentSubmission::updateOrCreate(
            ['assignment_id' => $assignment->id, 'student_id' => $student2->id],
            [
                'submission_text' => 'Berikut draf awal laporan praktikum efek fotolistrik kami untuk direview Bapak Guru.',
                'file_name' => 'Laporan_Fotolistrik_Budi.pdf',
                'score' => null,
                'feedback' => null,
                'status' => 'submitted',
                'submitted_at' => now()->subHours(3),
                'graded_at' => null,
            ],
        );
    }
}
