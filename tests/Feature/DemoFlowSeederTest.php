<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\Material;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Database\Seeders\DemoFlowSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemoFlowSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_flow_seeder_creates_complete_educational_ecosystem(): void
    {
        $this->seed(DemoFlowSeeder::class);
        // Verify Users & Roles
        $this->assertDatabaseHas('users', ['email' => 'admin.demo@cakrawala.test', 'role' => 'admin']);
        $this->assertDatabaseHas('users', ['email' => 'guru.demo@cakrawala.test', 'role' => 'teacher']);
        $this->assertDatabaseHas('users', ['email' => 'siswa.demo@cakrawala.test', 'role' => 'student']);
        $this->assertDatabaseHas('users', ['email' => 'budi.siswa@cakrawala.test', 'role' => 'student']);

        // Verify Student and Teacher profiles
        $this->assertEquals(2, Student::count());
        $this->assertEquals(1, Teacher::count());

        // Verify Classroom and membership
        $classroom = Classroom::first();
        $this->assertNotNull($classroom);
        $this->assertEquals('Fisika Modern & Praktikum', $classroom->name);
        $this->assertCount(2, $classroom->students);

        // Verify Payments
        $this->assertEquals(2, Payment::count());
        $this->assertDatabaseHas('payments', ['invoice_number' => 'INV-DEMO-0001', 'status' => 'confirmed']);
        $this->assertDatabaseHas('payments', ['invoice_number' => 'INV-DEMO-0002', 'status' => 'pending']);

        // Verify Material
        $this->assertEquals(1, Material::count());
        $this->assertDatabaseHas('materials', ['title' => 'Gerak Lurus & Dinamika', 'status' => 'published']);

        // Verify Assignment and Submissions
        $assignment = Assignment::first();
        $this->assertNotNull($assignment);
        $this->assertEquals(2, AssignmentSubmission::count());
        $this->assertDatabaseHas('assignment_submissions', [
            'assignment_id' => $assignment->id,
            'status' => 'graded',
            'score' => 95.00,
        ]);
        $this->assertDatabaseHas('assignment_submissions', [
            'assignment_id' => $assignment->id,
            'status' => 'submitted',
            'score' => null,
        ]);
    }

    public function test_seeded_users_can_authenticate(): void
    {
        $this->seed(DemoFlowSeeder::class);

        $admin = User::where('email', 'admin.demo@cakrawala.test')->first();
        $teacher = User::where('email', 'guru.demo@cakrawala.test')->first();
        $student = User::where('email', 'siswa.demo@cakrawala.test')->first();

        $this->actingAs($admin)->get(route('admin.home'))->assertOk();
        $this->actingAs($teacher)->get(route('guru.home'))->assertOk();
        $this->actingAs($student)->get(route('siswa.home'))->assertOk();
    }
}
