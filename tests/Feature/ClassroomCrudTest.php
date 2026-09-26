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

    public function test_teacher_cannot_create_or_modify_a_classroom(): void
    {
        $teacherUser = User::factory()->create(['role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id]);
        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Fisika Eksperimen',
            'subject' => 'Fisika',
            'grade_level' => 'Kelas XI',
        ]);

        $this->actingAs($teacherUser);

        // Teacher cannot create
        $this->post(route('guru.kelas.store'), [
            'name' => 'Fisika XI - IPA 2',
            'subject' => 'Fisika',
            'grade_level' => 'Kelas XI',
        ])->assertForbidden();

        // Teacher cannot edit
        $this->get(route('guru.kelas.edit', $classroom))
            ->assertForbidden();

        // Teacher cannot update
        $this->put(route('guru.kelas.update', $classroom), [
            'name' => 'Fisika Update', 'grade_level' => 'Kelas XII', 'subject' => 'Fisika',
        ])->assertForbidden();

        // Teacher cannot delete
        $this->delete(route('guru.kelas.destroy', $classroom))
            ->assertForbidden();
    }

    public function test_admin_can_create_edit_and_delete_a_classroom(): void
    {
        $admin = User::create([
            'name' => 'Admin Kelas',
            'email' => 'admin.kelas@cakrawala.test',
            'password' => 'secret123',
            'role' => 'admin',
        ]);
        $teacherUser = User::factory()->create(['role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id, 'subject' => 'Fisika']);

        $this->actingAs($admin);

        $this->post(route('admin.kelas.store'), [
            'teacher_id' => $teacher->id,
            'name' => 'Fisika XI - IPA 2',
            'grade_level' => 'Kelas XI',
            'section' => 'IPA 2',
            'day_of_week' => 'Senin',
            'start_time' => '08:00',
            'end_time' => '09:30',
        ])->assertRedirect(route('admin.kelas.index'));

        $classroom = Classroom::where('teacher_id', $teacher->id)->firstOrFail();
        $this->assertDatabaseHas('classrooms', [
            'id' => $classroom->id,
            'name' => 'Fisika XI - IPA 2',
            'section' => 'IPA 2',
        ]);
        $this->assertDatabaseHas('schedules', [
            'classroom_id' => $classroom->id,
            'day_of_week' => 'Senin',
            'start_time' => '08:00',
            'end_time' => '09:30',
        ]);

        $this->get(route('admin.kelas.edit', $classroom))
            ->assertOk()
            ->assertSee('Fisika XI - IPA 2');

        $this->put(route('admin.kelas.update', $classroom), [
            'teacher_id' => $teacher->id,
            'name' => 'Fisika XII - IPA 1',
            'grade_level' => 'Kelas XII',
            'section' => 'IPA 1',
        ])->assertRedirect(route('admin.kelas.index'));

        $this->assertDatabaseHas('classrooms', [
            'id' => $classroom->id,
            'name' => 'Fisika XII - IPA 1',
        ]);

        $this->delete(route('admin.kelas.destroy', $classroom))
            ->assertRedirect(route('admin.kelas.index'));

        $this->assertDatabaseMissing('classrooms', ['id' => $classroom->id]);
    }
}
