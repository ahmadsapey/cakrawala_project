<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClassroomCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_create_edit_and_delete_a_classroom(): void
    {
        $teacherUser = User::factory()->create(['role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        $this->actingAs($teacherUser);

        $this->get(route('guru.kelas'))
            ->assertOk()
            ->assertSee('Belum ada kelas yang diinput');

        $this->post(route('guru.kelas.store'), [
            'name' => 'Fisika XI - IPA 2',
            'subject' => 'Fisika',
            'grade_level' => 'Kelas XI',
            'section' => 'IPA 2',
            'description' => 'Kelas eksperimen fisika.',
        ])->assertRedirect(route('guru.kelas'));

        $classroom = Classroom::where('teacher_id', $teacher->id)->firstOrFail();
        $this->assertDatabaseHas('classrooms', [
            'id' => $classroom->id,
            'name' => 'Fisika XI - IPA 2',
        ]);

        $this->get(route('guru.kelas.edit', $classroom))
            ->assertOk()
            ->assertSee('Fisika XI - IPA 2');

        $this->put(route('guru.kelas.update', $classroom), [
            'name' => 'Fisika XII - IPA 1',
            'subject' => 'Fisika Modern',
            'grade_level' => 'Kelas XII',
            'section' => 'IPA 1',
            'description' => 'Kelas lanjutan.',
        ])->assertRedirect(route('guru.kelas'));

        $this->assertDatabaseHas('classrooms', [
            'id' => $classroom->id,
            'name' => 'Fisika XII - IPA 1',
        ]);

        $this->delete(route('guru.kelas.destroy', $classroom))
            ->assertRedirect(route('guru.kelas'));

        $this->assertDatabaseMissing('classrooms', ['id' => $classroom->id]);
    }
}
