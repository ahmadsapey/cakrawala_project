<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\LandingContent;
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
use Illuminate\Support\Facades\Schema;

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

        // Tryout Akbar MAN Insan Cendikia 2026
        $manIcClassroom = Classroom::updateOrCreate(
            ['teacher_id' => $teacher->id, 'name' => 'Event Akbar MAN Insan Cendikia'],
            [
                'subject' => 'Skolastik & TPA',
                'grade_level' => 'Persiapan Seleksi & SNBT',
                'section' => 'MAN IC Mitra',
                'description' => 'Simulasi Computer Based Test resmi kolaborasi Cakrawala Educentre dan mitra madrasah unggulan MAN Insan Cendikia.',
            ],
        );
        $manIcClassroom->students()->syncWithoutDetaching([$student->id, $student2->id]);

        $tryoutManIc = Quiz::updateOrCreate(
            ['teacher_id' => $teacher->id, 'classroom_id' => $manIcClassroom->id, 'title' => 'Tryout Akbar MAN Insan Cendikia 2026: TPA & Literasi Skolastik'],
            [
                'duration_minutes' => 60,
                'passing_score' => 70,
                'question_count' => 3,
                'due_at' => now()->addDays(7),
                'status' => 'published',
            ],
        );

        $mq1 = Question::updateOrCreate(
            ['quiz_id' => $tryoutManIc->id, 'sort_order' => 1],
            [
                'question_text' => 'Jika premis "Semua siswa MAN Insan Cendikia memiliki integritas tinggi" dan "Sebagian siswa berprestasi adalah siswa MAN Insan Cendikia", maka simpulan yang paling valid adalah...',
                'options' => [
                    'A' => 'Semua siswa berprestasi memiliki integritas tinggi',
                    'B' => 'Sebagian siswa berprestasi memiliki integritas tinggi',
                    'C' => 'Semua yang berintegritas tinggi adalah siswa MAN Insan Cendikia',
                    'D' => 'Tidak ada siswa berprestasi yang tidak berintegritas',
                ],
                'correct_answer' => 'B',
                'explanation' => 'Silogisme partikular: Sebagian siswa berprestasi merupakan bagian dari kelompok siswa MAN IC yang seluruhnya berintegritas tinggi, sehingga sebagian siswa berprestasi pasti berintegritas tinggi.',
            ],
        );

        $mq2 = Question::updateOrCreate(
            ['quiz_id' => $tryoutManIc->id, 'sort_order' => 2],
            [
                'question_text' => 'Diberikan pola deret bilangan: 3, 5, 9, 17, 33, ... Angka berikutnya pada deret tersebut adalah...',
                'options' => [
                    'A' => '49',
                    'B' => '57',
                    'C' => '65',
                    'D' => '71',
                ],
                'correct_answer' => 'C',
                'explanation' => 'Selisih antar suku berturut-turut adalah +2, +4, +8, +16, sehingga selisih berikutnya adalah +32. Maka 33 + 32 = 65.',
            ],
        );

        $mq3 = Question::updateOrCreate(
            ['quiz_id' => $tryoutManIc->id, 'sort_order' => 3],
            [
                'question_text' => 'Dalam metode ilmiah fisika terapan, variabel yang sengaja diubah oleh peneliti untuk mengamati dampaknya terhadap hasil eksperimen disebut...',
                'options' => [
                    'A' => 'Variabel Bebas (Independen)',
                    'B' => 'Variabel Terikat (Dependen)',
                    'C' => 'Variabel Kontrol',
                    'D' => 'Variabel Pengganggu',
                ],
                'correct_answer' => 'A',
                'explanation' => 'Variabel bebas adalah variabel yang sengaja dimanipulasi atau diubah peneliti untuk mengetahui pengaruhnya terhadap variabel terikat.',
            ],
        );

        // Update 4 Pilar Landing Packages
        if (Schema::hasTable('landing_contents')) {
            LandingContent::updateOrCreate(
                ['type' => 'package', 'title' => 'Les Privat 1-on-1 (Guru Datang / Online)'],
                [
                    'badge' => 'PILAR 1',
                    'description' => 'Pendampingan privat intensif personal sesuai kebutuhan siswa di rumah maupun video call.',
                    'price' => 'Rp 99.000',
                    'price_suffix' => '/sesi',
                    'features' => ['Tutor master datang ke rumah / Zoom', 'Modul eksklusif & konsultasi PR', 'Jadwal belajar fleksibel'],
                    'cta_label' => 'Daftar Privat',
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => 1,
                ],
            );

            LandingContent::updateOrCreate(
                ['type' => 'package', 'title' => 'Bimbingan Belajar (Bimbel Terpadu)'],
                [
                    'badge' => 'PILAR 2 - FAVORIT',
                    'description' => 'Kelas kelompok intensif SD, SMP, SMA untuk pemahaman konsep dan kenaikan peringkat kelas.',
                    'price' => 'Rp 149.000',
                    'price_suffix' => '/bln',
                    'features' => ['Kelas interaktif mingguan', 'Bank soal & pembahasan tuntas', 'Akses LMS Cakrawala 24/7'],
                    'cta_label' => 'Ikuti Bimbel',
                    'is_featured' => true,
                    'is_active' => true,
                    'sort_order' => 2,
                ],
            );

            LandingContent::updateOrCreate(
                ['type' => 'package', 'title' => 'Vendor Acara & Tryout CBT MAN Insan Cendikia'],
                [
                    'badge' => 'PILAR 3 - MITRA RESMI',
                    'description' => 'Simulasi ujian seleksi madrasah unggulan dan SNBT dengan sistem Computer Based Test.',
                    'price' => 'Rp 50.000',
                    'price_suffix' => '/event',
                    'features' => ['Simulasi CBT dengan timer live', 'Penilaian otomatis sistem IRT', 'Ranking akbar & modul pembahasan'],
                    'cta_label' => 'Daftar Tryout CBT',
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => 3,
                ],
            );

            LandingContent::updateOrCreate(
                ['type' => 'package', 'title' => 'Calistung & Pendalaman Materi Dasar'],
                [
                    'badge' => 'PILAR 4',
                    'description' => 'Metode ramah anak membaca, menulis, berhitung dan dasar logika sains sejak usia dini.',
                    'price' => 'Rp 85.000',
                    'price_suffix' => '/sesi',
                    'features' => ['Metode fonik interaktif & sabar', 'LKS warna & modul stimulasi otak', 'Laporan perkembangan berkala'],
                    'cta_label' => 'Pilih Calistung',
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => 4,
                ],
            );
        }
    }
}
