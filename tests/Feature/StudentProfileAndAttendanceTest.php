<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\Material;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StudentProfileAndAttendanceTest extends TestCase
{
    use RefreshDatabase;

    private function createTeacherAndClassroom(): array
    {
        $teacherUser = User::create([
            'name' => 'Pak Joko Fisika',
            'email' => 'joko@cakrawala.test',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
        ]);
        $teacher = Teacher::create([
            'user_id' => $teacherUser->id,
            'nip' => '19850101202601',
            'subject' => 'Fisika',
            'status' => 'active',
        ]);

        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Fisika Kuantum XI',
            'subject' => 'Fisika',
            'grade_level' => 'Kelas 11',
            'section' => 'IPA 1',
            'description' => 'Kelas Fisika Modern',
        ]);

        return [$teacherUser, $teacher, $classroom];
    }

    private function createStudent(Classroom $classroom): array
    {
        $studentUser = User::create([
            'name' => 'Bintang Pratama',
            'email' => 'bintang@cakrawala.test',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);
        $student = Student::create([
            'user_id' => $studentUser->id,
            'nisn' => '0089128391',
            'class_name' => 'XI IPA 1',
            'phone' => '081234567890',
            'status' => 'active',
        ]);

        $classroom->students()->attach($student->id);

        return [$studentUser, $student];
    }

    public function test_student_can_view_profile_and_stats(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        // Create published material
        Material::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Pengantar Fisika Inti',
            'subject' => 'Fisika',
            'summary' => 'Konsep dasar fisika inti.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        // Create assignment submission
        $assignment = Assignment::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Tugas Mandiri 1',
            'instructions' => 'Selesaikan latihan.',
            'points' => 100,
            'status' => 'published',
        ]);

        AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'student_id' => $student->id,
            'submission_text' => 'Sudah selesai.',
            'score' => 90,
            'status' => 'graded',
            'submitted_at' => now(),
        ]);

        $response = $this->actingAs($studentUser)->get(route('siswa.profile'));
        $response->assertOk()
            ->assertSee('Profil Saya')
            ->assertSee('Bintang Pratama')
            ->assertSee('0089128391')
            ->assertSee('XI IPA 1')
            ->assertSee('90.0'); // avg score
    }

    public function test_student_can_view_and_update_profile_info(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        // Visit edit profile
        $editResponse = $this->actingAs($studentUser)->get(route('siswa.profile.edit'));
        $editResponse->assertOk()
            ->assertSee('Edit Profil Siswa')
            ->assertSee('Bintang Pratama');

        // Submit profile update
        $updateResponse = $this->actingAs($studentUser)->put(route('siswa.profile.update'), [
            'name' => 'Bintang Cakrawala Pratama',
            'email' => 'bintang.new@cakrawala.test',
            'nisn' => '0089128399',
            'phone' => '08987654321',
            'class_name' => 'XI MIPA Unggulan',
        ]);

        $updateResponse->assertRedirect(route('siswa.profile'));
        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $studentUser->id,
            'name' => 'Bintang Cakrawala Pratama',
            'email' => 'bintang.new@cakrawala.test',
        ]);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'nisn' => '0089128399',
            'phone' => '08987654321',
            'class_name' => 'XI MIPA Unggulan',
        ]);
    }

    public function test_student_can_update_password_in_settings(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        $settingsResponse = $this->actingAs($studentUser)->get(route('siswa.pengaturan'));
        $settingsResponse->assertOk()
            ->assertSee('Pengaturan')
            ->assertSee('Keamanan');

        $updatePasswordResponse = $this->actingAs($studentUser)->put(route('siswa.pengaturan.update'), [
            'password' => 'newsecretpassword',
            'password_confirmation' => 'newsecretpassword',
        ]);

        $updatePasswordResponse->assertSessionHas('success');

        $studentUser->refresh();
        $this->assertTrue(Hash::check('newsecretpassword', $studentUser->password));
    }

    public function test_student_can_logout(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        $response = $this->actingAs($studentUser)->post(route('siswa.logout'));
        $response->assertRedirect(route('siswa.login'));
        $this->assertGuest();
    }

    public function test_teacher_can_view_classroom_detail(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        Material::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Bab 1 Radiasi Benda Hitam',
            'subject' => 'Fisika',
            'summary' => 'Penjelasan spektrum radiasi.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->actingAs($teacherUser)->get(route('guru.kelas.detail', $classroom));
        $response->assertOk()
            ->assertSee('Detail Kelas')
            ->assertSee('Progres')
            ->assertSee('Fisika Kuantum XI')
            ->assertSee('Bab 1 Radiasi Benda Hitam')
            ->assertSee('Bintang Pratama');
    }

    public function test_teacher_can_save_classroom_attendance(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        $response = $this->actingAs($teacherUser)->post(route('guru.kelas.absensi', $classroom), [
            'attendances' => [
                $student->id => 'Hadir',
            ],
        ]);

        $response->assertSessionHas('success');
    }

    public function test_teacher_can_logout(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();

        $response = $this->actingAs($teacherUser)->post(route('guru.logout'));
        $response->assertRedirect(route('guru.login'));
        $this->assertGuest();
    }
}
