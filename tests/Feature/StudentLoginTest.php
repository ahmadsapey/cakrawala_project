<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Tests\TestCase;

class StudentLoginTest extends TestCase
{
    public function test_student_can_login_again_after_being_reactivated(): void
    {
        $studentUser = User::factory()->create([
            'name' => 'Siswa Reaktif',
            'role' => 'student',
        ]);
        $student = Student::factory()->create([
            'user_id' => $studentUser->id,
            'nisn' => '1234567890',
            'status' => 'inactive',
        ]);

        $this->post(route('siswa.login.submit'), [
            'name' => 'Siswa Reaktif',
            'nisn' => '1234567890',
        ])->assertSessionHasErrors('name');

        $student->update(['status' => 'active']);

        $this->post(route('siswa.login.submit'), [
            'name' => 'Siswa Reaktif',
            'nisn' => '1234567890',
        ])->assertRedirect(route('siswa.home'));

        $this->assertAuthenticatedAs($studentUser);
    }
}
