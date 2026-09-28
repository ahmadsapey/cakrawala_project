<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentLoginTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_student_can_login_using_email_and_password(): void
    {
        $studentUser = User::factory()->create([
            'name' => 'Siswa Email',
            'email' => 'siswa.email@cakrawala.test',
            'password' => bcrypt('password123'),
            'role' => 'student',
        ]);
        Student::factory()->create([
            'user_id' => $studentUser->id,
            'nisn' => '9988776655',
            'status' => 'active',
        ]);

        $response = $this->post(route('siswa.login.submit'), [
            'login_key' => 'siswa.email@cakrawala.test',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('siswa.home'));
        $this->assertAuthenticatedAs($studentUser);
    }

    public function test_student_can_login_using_name_and_email_in_nisn_field(): void
    {
        $studentUser = User::factory()->create([
            'name' => 'Rayyan Pratama',
            'email' => 'rayyan@cakrawala.test',
            'role' => 'student',
        ]);
        Student::factory()->create([
            'user_id' => $studentUser->id,
            'nisn' => '1234567890',
            'status' => 'active',
        ]);

        $response = $this->post(route('siswa.login.submit'), [
            'name' => 'Rayyan Pratama',
            'nisn' => 'rayyan@cakrawala.test',
        ]);

        $response->assertRedirect(route('siswa.home'));
        $this->assertAuthenticatedAs($studentUser);
    }
}
