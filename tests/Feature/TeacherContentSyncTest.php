<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherContentSyncTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_teacher_tasks_and_quizzes_appear_for_students(): void
    {
        $teacherUser = User::factory()->create(['role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Fisika XI IPA 2',
            'subject' => 'Fisika',
            'grade_level' => 'Kelas XI',
        ]);
        $this->actingAs($teacherUser);

        $this->get(route('guru.kelas'))
            ->assertOk()
            ->assertSee(route('guru.kelas.learning', $classroom));

        $this->get(route('guru.kelas.learning', $classroom))
            ->assertOk()
            ->assertSee('Tambah Materi')
            ->assertSee('Tambah Tugas')
            ->assertSee('Tambah Kuis');

        $this->get(route('guru.material.create', ['classroom_id' => $classroom->id]))
            ->assertOk()
            ->assertSee('name="classroom_id"', false)
            ->assertSee('value="'.$classroom->id.'"', false);

        $this->get(route('guru.tugas.tambah'))->assertOk()->assertSee('name="classroom_id"', false);
        $this->post(route('guru.tugas.store'), [
            'classroom_id' => $classroom->id,
            'title' => 'Laporan Efek Fotolistrik',
            'instructions' => 'Kirim laporan dalam format PDF.',
            'points' => 100,
            'status' => 'published',
        ])->assertRedirect(route('guru.tugas.tambah'));

        $this->post(route('guru.kuis.store'), [
            'classroom_id' => $classroom->id,
            'title' => 'Kuis Fotolistrik',
            'duration_minutes' => 30,
            'passing_score' => 75,
            'question_count' => 10,
            'status' => 'published',
        ])->assertRedirect(route('guru.kuis.tambah'));

        $this->assertDatabaseHas('assignments', ['title' => 'Laporan Efek Fotolistrik', 'status' => 'published']);
        $this->assertDatabaseHas('quizzes', ['title' => 'Kuis Fotolistrik', 'status' => 'published']);

        $this->get(route('siswa.tugas'))
            ->assertOk()
            ->assertSee('Laporan Efek Fotolistrik')
            ->assertSee('Kuis Fotolistrik')
            ->assertSee('Fisika XI IPA 2');

        $this->get(route('siswa.materi'))
            ->assertOk()
            ->assertSee('Tugas dari guru')
            ->assertSee('Laporan Efek Fotolistrik')
            ->assertSee('Kuis dari guru')
            ->assertSee('Kuis Fotolistrik');

        $this->get(route('siswa.kelas.show', $classroom))
            ->assertOk()
            ->assertSee('Laporan Efek Fotolistrik')
            ->assertSee('Kuis Fotolistrik')
            ->assertSee('Fisika XI IPA 2');

        $this->assertTrue(Assignment::where('classroom_id', $classroom->id)->exists());
        $this->assertTrue(Quiz::where('classroom_id', $classroom->id)->exists());
    }
}
