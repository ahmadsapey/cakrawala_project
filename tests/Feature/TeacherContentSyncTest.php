<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Material;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TeacherContentSyncTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_teacher_tasks_and_materials_appear_for_students(): void
    {
        $teacherUser = User::factory()->create(['role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Fisika XI IPA 2',
            'subject' => 'Fisika',
            'grade_level' => 'Kelas XI',
            'online_meeting_url' => 'https://meet.google.com/abc-defg-hij',
        ]);

        $this->actingAs($teacherUser);

        // Teacher cannot create class directly
        $this->post(route('guru.kelas.store'), [
            'name' => 'Forbidden Class',
            'grade_level' => '10',
        ])->assertForbidden();

        $this->get(route('guru.home'))
            ->assertOk()
            ->assertDontSee('Tambah Materi');

        $this->get(route('guru.kelas'))
            ->assertOk()
            ->assertDontSee('Upload Bahan Ajar')
            ->assertSee(route('guru.kelas.learning', $classroom));

        $this->get(route('guru.koreksi.tugas'))
            ->assertOk()
            ->assertDontSee('Buat Tugas Baru');

        // When teacher visits learning room, auto-records attendance
        $this->get(route('guru.kelas.learning', $classroom))
            ->assertOk()
            ->assertSee('Tambah Materi')
            ->assertSee('Tambah Tugas')
            ->assertDontSee('Tambah Kuis');

        $this->assertDatabaseHas('teacher_attendances', [
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'status' => 'hadir',
        ]);

        // Upload Material
        $this->get(route('guru.material.create', ['classroom_id' => $classroom->id]))
            ->assertOk()
            ->assertSee('name="classroom_id"', false)
            ->assertSee('value="'.$classroom->id.'"', false);

        Material::create([
            'classroom_id' => $classroom->id,
            'teacher_id' => $teacher->id,
            'title' => 'Modul Termodinamika',
            'subject' => 'Fisika',
            'grade_level' => 'Kelas XI',
            'summary' => 'Hukum Termodinamika 1 dan 2',
            'status' => 'published',
            'published_at' => now(),
        ]);

        // Create Assignment
        $this->get(route('guru.tugas.tambah'))->assertOk()->assertSee('name="classroom_id"', false);
        $this->post(route('guru.tugas.store'), [
            'classroom_id' => $classroom->id,
            'title' => 'Laporan Efek Fotolistrik',
            'instructions' => 'Kirim laporan dalam format PDF.',
            'points' => 100,
            'status' => 'published',
        ])->assertRedirect(route('guru.tugas.tambah'));

        $this->assertDatabaseHas('assignments', ['title' => 'Laporan Efek Fotolistrik', 'status' => 'published']);

        // Student Access
        $studentUser = User::create([
            'name' => 'Bintang Pratama',
            'email' => 'bintang@cakrawala.test',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);
        $student = Student::create([
            'user_id' => $studentUser->id,
            'nisn' => '0089128391',
            'class_name' => 'XI IPA 2',
            'status' => 'active',
        ]);
        $classroom->students()->attach($student->id);

        $this->actingAs($studentUser)->withSession(['student_id' => $student->id]);

        $this->get(route('siswa.tugas'))
            ->assertOk()
            ->assertSee('Laporan Efek Fotolistrik')
            ->assertSee('Fisika XI IPA 2');

        $this->get(route('siswa.materi'))
            ->assertOk()
            ->assertSee('Modul Termodinamika');

        $this->get(route('siswa.kelas.show', $classroom))
            ->assertOk()
            ->assertSee('Laporan Efek Fotolistrik')
            ->assertSee('Modul Termodinamika')
            ->assertSee('Gabung Sesi Online')
            ->assertDontSee('Kuis');

        $this->assertTrue(Assignment::where('classroom_id', $classroom->id)->exists());
    }
}
