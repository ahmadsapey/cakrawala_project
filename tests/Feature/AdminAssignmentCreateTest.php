<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
    }

    public function test_teacher_can_create_assignment_with_pdf_attachment_and_student_can_download_it(): void
    {
        Storage::fake('public');

        $teacherUser = User::create([
            'name' => 'Pak Guru Budi',
            'email' => 'budi@cakrawala.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = Teacher::create([
            'user_id' => $teacherUser->id,
            'nip' => '99887766',
            'subject' => 'Fisika',
            'status' => 'active',
        ]);
        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Fisika XII IPA',
            'subject' => 'Fisika Modern',
            'grade_level' => '12',
        ]);

        $pdfFile = UploadedFile::fake()->create('soal_kuantum.pdf', 500, 'application/pdf');

        $storeResponse = $this->actingAs($teacherUser)->post(route('guru.tugas.store'), [
            'classroom_id' => $classroom->id,
            'title' => 'Tugas Fisika Kuantum Soal PDF',
            'instructions' => 'Pelajari soal dalam lampiran PDF dan kerjakan.',
            'points' => 100,
            'status' => 'published',
            'attachment' => $pdfFile,
        ]);

        $storeResponse->assertRedirect(route('guru.tugas.tambah'));
        $storeResponse->assertSessionHas('success');

        $assignment = Assignment::where('title', 'Tugas Fisika Kuantum Soal PDF')->first();
        $this->assertNotNull($assignment);
        $this->assertNotNull($assignment->attachment_path);
        Storage::disk('public')->assertExists($assignment->attachment_path);

        // Student visits tugas page and sees download link
        $studentUser = User::create([
            'name' => 'Ahmad Siswa',
            'email' => 'ahmad@cakrawala.test',
            'password' => 'password123',
            'role' => 'student',
        ]);
        $student = Student::create([
            'user_id' => $studentUser->id,
            'nisn' => '1234567890',
            'class_name' => '12',
            'status' => 'active',
        ]);
        $classroom->students()->attach($student->id);

        $studentResponse = $this->actingAs($studentUser)->get(route('siswa.tugas'));
        $studentResponse->assertOk()
            ->assertSee('Tugas Fisika Kuantum Soal PDF')
            ->assertSee('Unduh Berkas Soal Tugas (PDF)');
    }
}
