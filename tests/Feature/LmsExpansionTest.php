<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Database\Seeders\DemoFlowSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LmsExpansionTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_and_tentang_render_with_company_profile_and_four_pillars(): void
    {
        $response = $this->get(route('landing.page'));
        $response->assertOk();
        $response->assertSee('PT Indo Prestasi Utama', false);
        $response->assertSee('4 Pilar Layanan', false);
        $response->assertSee('Les Privat', false);
        $response->assertSee('Bimbel Terpadu', false);
        $response->assertSee('MAN Insan Cendikia', false);
        $response->assertSee('Calistung', false);

        $responseTentang = $this->get(route('landing.tentang'));
        $responseTentang->assertOk();
        $responseTentang->assertSee('PT INDO PRESTASI UTAMA', false);
        $responseTentang->assertSee('Startup Jasa Layanan Pendidikan Terintegrasi', false);
        $responseTentang->assertSee('4 Pilar Utama Layanan Cakrawala', false);
        $responseTentang->assertSee('MAN Insan Cendikia', false);
    }

    public function test_student_can_view_jadwal_page_with_schedules_and_agenda(): void
    {
        $studentUser = User::factory()->create(['role' => 'student']);
        $student = Student::factory()->create(['user_id' => $studentUser->id]);

        $this->actingAs($studentUser);

        $response = $this->get(route('siswa.jadwal'));
        $response->assertOk();
        $response->assertSee('Jadwal Bimbel & Sesi Belajar', false);
        $response->assertSee('Sesi Privat (1-on-1)', false);
        $response->assertSee('Kelas Bimbel & MAN IC', false);
        $response->assertSee('Tryout CBT Akbar', false);
    }

    public function test_student_can_view_tryout_cbt_portal_and_man_ic_simulation(): void
    {
        $teacherUser = User::factory()->create(['role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);

        $studentUser = User::factory()->create(['role' => 'student']);
        $student = Student::factory()->create(['user_id' => $studentUser->id]);

        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Event Akbar MAN Insan Cendikia',
            'subject' => 'Skolastik & TPA',
            'grade_level' => 'Persiapan Seleksi',
        ]);

        $tryout = Quiz::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Tryout Akbar MAN Insan Cendikia 2026',
            'duration_minutes' => 60,
            'passing_score' => 70,
            'question_count' => 1,
            'status' => 'published',
        ]);

        Question::create([
            'quiz_id' => $tryout->id,
            'sort_order' => 1,
            'question_text' => 'Soal simulasi MAN IC 1',
            'options' => ['A' => 'Jawaban A', 'B' => 'Jawaban B'],
            'correct_answer' => 'A',
        ]);

        $this->actingAs($studentUser);

        $response = $this->get(route('siswa.tryout'));
        $response->assertOk();
        $response->assertSee('Simulasi Tryout CBT & Seleksi Masuk', false);
        $response->assertSee('Tryout Akbar MAN Insan Cendikia 2026', false);
        $response->assertSee('EVENT MITRA MAN IC', false);
        $response->assertSee(route('siswa.pengerjaan', $tryout));
    }

    public function test_student_can_view_payment_catalog_and_submit_invoice(): void
    {
        $studentUser = User::factory()->create(['role' => 'student']);
        $student = Student::factory()->create(['user_id' => $studentUser->id]);

        $this->actingAs($studentUser);
        session(['student_id' => $student->id]);

        $response = $this->get(route('siswa.payment.create'));
        $response->assertOk();
        $response->assertSee('PT INDO PRESTASI UTAMA', false);
        $response->assertSee('8290-123-456', false);
        $response->assertSee('LES PRIVAT', false);
        $response->assertSee('BIMBEL TERPADU', false);
        $response->assertSee('MAN IC & UTBK', false);

        $submitResponse = $this->post(route('siswa.payment.store'), [
            'description' => 'Tryout Akbar CBT MAN IC & UTBK',
            'amount' => 50000,
        ]);

        $submitResponse->assertRedirect(route('siswa.payment.create'));
        $this->assertDatabaseHas('payments', [
            'student_id' => $student->id,
            'description' => 'Tryout Akbar CBT MAN IC & UTBK',
            'amount' => 50000,
            'status' => 'pending',
        ]);
    }

    public function test_student_materials_page_shows_modul_and_bank_soal(): void
    {
        $studentUser = User::factory()->create(['role' => 'student']);
        Student::factory()->create(['user_id' => $studentUser->id]);

        $this->actingAs($studentUser);

        $response = $this->get(route('siswa.materi'));
        $response->assertOk();
        $response->assertSee('Modul Belajar & Bank Soal', false);
        $response->assertSee('Buka Tryout CBT', false);
    }

    public function test_demo_flow_seeder_seeds_man_ic_tryout_and_four_pillars_packages(): void
    {
        $this->seed(DemoFlowSeeder::class);

        $this->assertDatabaseHas('quizzes', [
            'title' => 'Tryout Akbar MAN Insan Cendikia 2026: TPA & Literasi Skolastik',
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('landing_contents', [
            'title' => 'Vendor Acara & Tryout CBT MAN Insan Cendikia',
            'type' => 'package',
        ]);

        $this->assertDatabaseHas('landing_contents', [
            'title' => 'Bimbingan Belajar (Bimbel Terpadu)',
            'type' => 'package',
        ]);
    }
}
