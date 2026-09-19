<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_and_delete_teacher_with_related_user(): void
    {
        $user = User::create([
            'name' => 'Budi Guru',
            'email' => 'budi@example.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = $user->teacher()->create([
            'nip' => '19800101202601',
            'subject' => 'Matematika',
            'status' => 'active',
        ]);

        $response = $this->put(route('admin.guru.update', $teacher), [
            'name' => 'Budi Guru Updated',
            'email' => 'budi.updated@example.test',
            'password' => '',
            'password_confirmation' => '',
            'nip' => '19800101202601',
            'subject' => 'Fisika',
            'status' => 'inactive',
        ]);

        $response->assertRedirect(route('admin.guru.index'));
        $this->assertDatabaseHas('teachers', ['id' => $teacher->id, 'subject' => 'Fisika', 'status' => 'inactive']);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Budi Guru Updated']);

        $this->delete(route('admin.guru.destroy', $teacher))->assertRedirect(route('admin.guru.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('teachers', ['id' => $teacher->id]);
    }
}
