<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\Material;
use App\Models\Payment;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\Student;
use App\Models\Teacher;
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
            ['email' => 'admin.demo@cakrawala.test'],
            ['name' => 'Admin Demo', 'password' => Hash::make('password123'), 'role' => 'admin'],
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
                'grade_level' => 'Kelas 12',
                'section' => 'XII IPA 1',
                'description' => 'Mempelajari hukum fisika modern, termodinamika, dan gelombang elektromagnetik.',
            ],
        );
        $classroom->students()->syncWithoutDetaching([$student->id, $student2->id]);

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

        $quiz = Quiz::updateOrCreate(
            ['teacher_id' => $teacher->id, 'classroom_id' => $classroom->id, 'title' => 'Kuis Termodinamika'],
            [
                'duration_minutes' => 30,
                'passing_score' => 75,
                'question_count' => 3,
                'due_at' => now()->addDays(3),
                'status' => 'published',
            ],
        );

        $q1 = Question::updateOrCreate(
            ['quiz_id' => $quiz->id, 'sort_order' => 1],
            [
                'question_text' => 'Hukum I Termodinamika pada dasarnya merupakan pernyataan dari hukum kekekalan apa?',
                'options' => [
                    'A' => 'Massa',
                    'B' => 'Energi',
                    'C' => 'Momentum',
                    'D' => 'Muatan listrik',
                ],
                'correct_answer' => 'B',
                'explanation' => 'Hukum I Termodinamika menyatakan bahwa kalor yang diterima sistem digunakan untuk menambah energi dalam dan melakukan usaha luar (dQ = dU + dW), yang merupakan wujud kekekalan energi.',
            ],
        );

        $q2 = Question::updateOrCreate(
            ['quiz_id' => $quiz->id, 'sort_order' => 2],
            [
                'question_text' => 'Proses termodinamika di mana sistem tidak mengalami perubahan volume (volume konstan) disebut proses...',
                'options' => [
                    'A' => 'Isotermal',
                    'B' => 'Isobarik',
                    'C' => 'Isokhorik',
                    'D' => 'Adiabatik',
                ],
                'correct_answer' => 'C',
                'explanation' => 'Proses isokhorik (atau isovolumetrik) adalah proses termodinamika pada volume konstan (dV = 0), sehingga usaha luar W = 0.',
            ],
        );

        $q3 = Question::updateOrCreate(
            ['quiz_id' => $quiz->id, 'sort_order' => 3],
            [
                'question_text' => 'Siklus mesin kalor ideal Carnot bekerja di antara dua reservoir kalor dan tersusun dari urutan proses...',
                'options' => [
                    'A' => 'Dua isotermal dan dua adiabatik',
                    'B' => 'Dua isobarik dan dua isokhorik',
                    'C' => 'Empat proses isotermal berturut-turut',
                    'D' => 'Empat proses adiabatik reversible',
                ],
                'correct_answer' => 'A',
                'explanation' => 'Siklus Carnot terdiri dari empat proses reversibel: dua proses isotermal dan dua proses adiabatik.',
            ],
        );

        QuizSubmission::updateOrCreate(
            ['quiz_id' => $quiz->id, 'student_id' => $student->id],
            [
                'answers' => [
                    (string) $q1->id => 'B',
                    (string) $q2->id => 'C',
                    (string) $q3->id => 'A',
                ],
                'score' => 100.00,
                'correct_count' => 3,
                'incorrect_count' => 0,
                'duration_seconds' => 450,
                'status' => 'completed',
                'started_at' => now()->subHours(4),
                'submitted_at' => now()->subHours(3)->subMinutes(52),
            ],
        );

        QuizSubmission::updateOrCreate(
            ['quiz_id' => $quiz->id, 'student_id' => $student2->id],
            [
                'answers' => [
                    (string) $q1->id => 'B',
                    (string) $q2->id => 'A',
                    (string) $q3->id => 'A',
                ],
                'score' => 66.67,
                'correct_count' => 2,
                'incorrect_count' => 1,
                'duration_seconds' => 720,
                'status' => 'completed',
                'started_at' => now()->subHours(2),
                'submitted_at' => now()->subHours(1)->subMinutes(48),
            ],
        );
    }
}
