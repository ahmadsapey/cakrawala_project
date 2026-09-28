<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAssignmentCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_and_teacher_can_access_create_assignment_for_classroom(): void
    {
        $teacherUser = User::create([
            'name' => 'Naufal Guru',
            'email' => 'naufal@cakrawala.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = Teacher::create([
            'user_id' => $teacherUser->id,
            'nip' => '12345678',
            'subject' => 'Bahasa Indonesia',
            'status' => 'active',
        ]);
        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Bahasa Indonesia',
            'subject' => 'Bahasa Indonesia Khusus Queen',
            'grade_level' => '7A',
        ]);

        // 1. Admin visits /guru/tugas/create?classroom_id=...
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@cakrawala.test',
            'password' => 'password123',
            'role' => 'admin',
        ]);
        $responseAdmin = $this->actingAs($admin)->get("/guru/tugas/create?classroom_id={$classroom->id}");
        $responseAdmin->assertOk()->assertSee('Tambah Tugas Baru');

        // 2. Admin visits /guru/tugas/tambah?classroom_id=...
        $responseAdminTambah = $this->actingAs($admin)->get("/guru/tugas/tambah?classroom_id={$classroom->id}");
        $responseAdminTambah->assertOk()->assertSee('Tambah Tugas Baru');

        // 3. Teacher visits /guru/tugas/create?classroom_id=...
        $responseTeacher = $this->actingAs($teacherUser)->get("/guru/tugas/create?classroom_id={$classroom->id}");
        $responseTeacher->assertOk()->assertSee('Tambah Tugas Baru');

        // 4. Teacher visits /guru/tugas/tambah?classroom_id=...
        $responseTeacherTambah = $this->actingAs($teacherUser)->get("/guru/tugas/tambah?classroom_id={$classroom->id}");
        $responseTeacherTambah->assertOk()->assertSee('Tambah Tugas Baru');

        // 5. Admin POST to /guru/tugas/tambah
        $adminPost = $this->actingAs($admin)->post('/guru/tugas/tambah', [
            'classroom_id' => $classroom->id,
            'title' => 'Praktikum Admin',
            'instructions' => 'Kerjakan sesuai urutan',
            'points' => 100,
            'due_at' => '2026-09-29T17:05',
            'status' => 'published',
        ]);
        $adminPost->assertRedirect(route('guru.tugas.tambah'));
        $this->assertDatabaseHas('assignments', ['title' => 'Praktikum Admin']);

        // 6. Teacher POST to /guru/tugas/tambah
        $teacherPost = $this->actingAs($teacherUser)->post('/guru/tugas/tambah', [
            'classroom_id' => $classroom->id,
            'title' => 'Praktikum Guru',
            'instructions' => 'Kerjakan modul 1',
            'points' => 100,
            'due_at' => '2026-09-29T17:05',
            'status' => 'published',
        ]);
        $teacherPost->assertRedirect(route('guru.tugas.tambah'));
        $this->assertDatabaseHas('assignments', ['title' => 'Praktikum Guru']);

        // 7. Student POST to /guru/tugas/tambah
        $studentUser = User::create([
            'name' => 'Ahmad Shafey Student',
            'email' => 'shafey@cakrawala.test',
            'password' => 'password123',
            'role' => 'student',
        ]);
        $studentPost = $this->actingAs($studentUser)->post('/guru/tugas/tambah', [
            'classroom_id' => $classroom->id,
            'title' => 'Praktikum Siswa',
            'instructions' => 'Pengerjaan siswa',
            'points' => 100,
            'due_at' => '2026-09-29T17:05',
            'status' => 'published',
        ]);
        $studentPost->assertRedirect(route('guru.tugas.tambah'));
        $this->assertDatabaseHas('assignments', ['title' => 'Praktikum Siswa']);
    }
}
