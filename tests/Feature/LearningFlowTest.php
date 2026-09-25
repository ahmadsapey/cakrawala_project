<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Material;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LearningFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_create_published_material_and_student_can_receive_it(): void
    {
        Storage::fake('public');

        $teacherUser = User::factory()->create(['role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Matematika XII',
            'subject' => 'Matematika',
            'grade_level' => 'Kelas XII',
        ]);
        $studentUser = User::factory()->create(['role' => 'student']);
        Student::factory()->create(['user_id' => $studentUser->id]);

        $this->post(route('guru.login.submit'), [
            'email' => $teacherUser->email,
            'password' => 'password',
        ])->assertRedirect(route('guru.home'));

        $this->get(route('guru.login'))
            ->assertOk()
            ->assertSee('action="'.route('guru.login.submit').'"', false)
            ->assertSee('type="submit"', false);

        $this->get(route('guru.kelas'))
            ->assertOk()
            ->assertSee(route('guru.material.create'));

        $this->get(route('guru.material.create'))
            ->assertSee('name="video_url"', false)
            ->assertSee('name="status" value="published"', false)
            ->assertSee('name="status" value="draft"', false)
            ->assertOk()
            ->assertSee(route('guru.tugas.tambah'));

        $response = $this->post(route('guru.material.store'), [
            'subject' => 'Matematika',
            'classroom_id' => $classroom->id,
            'title' => 'Persamaan Kuadrat',
            'summary' => 'Materi persamaan kuadrat untuk kelas XII.',
            'video_url' => 'https://example.com/video-persamaan-kuadrat',
            'attachment' => UploadedFile::fake()->create('modul-persamaan-kuadrat.pdf', 1200, 'application/pdf'),
            'status' => 'published',
        ]);

        $response->assertRedirect(route('siswa.home'));
        $this->assertDatabaseHas('materials', [
            'teacher_id' => $teacher->id,
            'title' => 'Persamaan Kuadrat',
            'status' => 'published',
        ]);
        $material = Material::where('title', 'Persamaan Kuadrat')->firstOrFail();
        Storage::disk('public')->assertExists($material->attachment_path);

        session()->forget('teacher_id');
        $this->actingAs($teacherUser);

        $this->post(route('guru.material.store'), [
            'subject' => 'Fisika',
            'classroom_id' => $classroom->id,
            'title' => 'Draft Efek Fotolistrik',
            'summary' => 'Materi yang belum diterbitkan.',
            'status' => 'draft',
        ])->assertRedirect(route('guru.material.create'));

        $this->assertDatabaseHas('materials', [
            'teacher_id' => $teacher->id,
            'title' => 'Draft Efek Fotolistrik',
            'status' => 'draft',
            'published_at' => null,
        ]);

        $this->post(route('guru.kelas.rekomendasi.store'), [
            'subject' => 'Matematika',
            'title' => 'Latihan Persamaan Kuadrat',
            'summary' => 'Kerjakan latihan ini setelah membaca materi.',
            'resource_url' => 'https://example.com/latihan',
            'status' => 'published',
        ])->assertRedirect(route('guru.kelas'));

        $this->assertDatabaseHas('learning_recommendations', [
            'teacher_id' => $teacher->id,
            'title' => 'Latihan Persamaan Kuadrat',
            'status' => 'published',
        ]);

        $this->post(route('siswa.login.submit'), [
            'email' => $studentUser->email,
            'password' => 'password',
        ])->assertRedirect(route('siswa.home'));

        $response = $this->get(route('siswa.materi'));

        $response->assertOk()->assertSee('Persamaan Kuadrat')->assertSee('Matematika')->assertSee('Unduh Modul');
        $this->get(route('siswa.materi', ['subject' => 'Matematika']))
            ->assertOk()
            ->assertSee('Persamaan Kuadrat');
        $this->get(route('siswa.home'))
            ->assertOk()
            ->assertSee('Matematika')
            ->assertSee('1 Materi')
            ->assertSee('Latihan Persamaan Kuadrat')
            ->assertSee('Tonton video')
            ->assertSee('https://example.com/video-persamaan-kuadrat');
        $this->assertTrue(Material::where('title', 'Persamaan Kuadrat')->where('teacher_id', $teacher->id)->exists());
    }
}
