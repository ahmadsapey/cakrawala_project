<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardAndSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_home_renders_metrics(): void
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@cakrawala.test',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.home'));
        $response->assertOk()
            ->assertSee('Ikhtisar Cakrawala')
            ->assertSee('Aktivitas Terbaru');
    }

    public function test_guru_home_renders_classes_and_tasks(): void
    {
        $teacherUser = User::create([
            'name' => 'Pak Joko Fisika',
            'email' => 'joko@example.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = $teacherUser->teacher()->create([
            'nip' => '19850101202601',
            'subject' => 'Fisika',
            'status' => 'active',
        ]);

        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Fisika Kuantum XII',
            'subject' => 'Fisika',
            'grade_level' => 'Kelas 12',
            'section' => 'A',
            'description' => 'Kelas Fisika Lanjutan',
        ]);

        $assignment = Assignment::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Tugas Efek Compton',
            'instructions' => 'Pelajari materi dan selesaikan latihan.',
            'points' => 100,
            'status' => 'published',
        ]);

        $response = $this->actingAs($teacherUser)->get(route('guru.home'));
        $response->assertOk()
            ->assertSee('Halo,')
            ->assertSee('Pak Joko Fisika')
            ->assertSee('Fisika Kuantum XII')
            ->assertSee('Tugas Efek Compton');
    }

    public function test_siswa_classroom_search_and_subject_filter(): void
    {
        $teacherUser = User::create([
            'name' => 'Bu Guru Maya',
            'email' => 'maya@example.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = $teacherUser->teacher()->create([
            'nip' => '19870101202601',
            'subject' => 'Matematika',
            'status' => 'active',
        ]);

        $classMath = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Kalkulus Lanjut',
            'subject' => 'Matematika',
            'grade_level' => 'Kelas 12',
        ]);

        $classBio = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Genetika Dasar',
            'subject' => 'Biologi',
            'grade_level' => 'Kelas 11',
        ]);

        $studentUser = User::create([
            'name' => 'Siswa Search',
            'email' => 'siswa.search@example.test',
            'password' => 'password123',
            'role' => 'student',
        ]);
        $student = Student::create([
            'user_id' => $studentUser->id,
            'nisn' => '1122334455',
            'class_name' => 'Kelas 12',
            'status' => 'active',
        ]);

        // Subject filter
        $this->actingAs($studentUser)->withSession(['student_id' => $student->id])
            ->get(route('siswa.kelas', ['subject' => 'Matematika']))
            ->assertOk()
            ->assertSee('Kalkulus Lanjut')
            ->assertDontSee('Genetika Dasar');

        // Search query
        $this->actingAs($studentUser)->withSession(['student_id' => $student->id])
            ->get(route('siswa.kelas', ['search' => 'Genetika']))
            ->assertOk()
            ->assertSee('Genetika Dasar')
            ->assertDontSee('Kalkulus Lanjut');
    }

    public function test_siswa_tugas_page_renders_assignments_and_quizzes(): void
    {
        $teacherUser = User::create([
            'name' => 'Tutor Kimia',
            'email' => 'kimia@example.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = $teacherUser->teacher()->create([
            'nip' => '19900101202601',
            'subject' => 'Kimia',
            'status' => 'active',
        ]);

        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Kimia Karbon X',
            'subject' => 'Kimia',
            'grade_level' => 'Kelas 10',
        ]);

        Assignment::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Struktur Hidrokarbon',
            'instructions' => 'Gambarkan 5 isomer alkana.',
            'points' => 90,
            'status' => 'published',
        ]);

        Quiz::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Kuis Reaksi Redoks',
            'duration_minutes' => 20,
            'passing_score' => 70,
            'question_count' => 15,
            'status' => 'published',
        ]);

        $studentUser = User::create([
            'name' => 'Siswa Tugas',
            'email' => 'siswa.tugas@example.test',
            'password' => 'password123',
            'role' => 'student',
        ]);
        $student = Student::create([
            'user_id' => $studentUser->id,
            'nisn' => '5544332211',
            'class_name' => 'Kelas 10',
            'status' => 'active',
        ]);

        $this->actingAs($studentUser)->withSession(['student_id' => $student->id])
            ->get(route('siswa.tugas'))
            ->assertOk()
            ->assertSee('Struktur Hidrokarbon')
            ->assertDontSee('Kuis Reaksi Redoks')
            ->assertSee('Kimia Karbon X');
    }
}
