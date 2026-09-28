<?php

namespace Tests\Feature;

use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClassroomDisplayTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_home_displays_total_classrooms_and_active_classes(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $teacherUser = User::factory()->create(['name' => 'Budi Santoso', 'role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id, 'subject' => 'Matematika']);

        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Matematika Peminatan',
            'subject' => 'Matematika',
            'grade_level' => '10',
        ]);

        Schedule::create([
            'classroom_id' => $classroom->id,
            'teacher_id' => $teacher->id,
            'day_of_week' => 'Rabu',
            'start_time' => '10:00',
            'end_time' => '11:30',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.home'));

        $response->assertOk()
            ->assertSee('Total Kelas')
            ->assertSee('Matematika Peminatan')
            ->assertSee('Budi Santoso')
            ->assertSee('Rabu, 10:00 - 11:30 WIB');
    }

    public function test_admin_can_preview_guru_classes_and_learning_view(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $teacherUser = User::factory()->create(['name' => 'Siti Nurhaliza', 'role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id, 'subject' => 'Bahasa Inggris']);

        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'English Conversation',
            'subject' => 'Bahasa Inggris',
            'grade_level' => '8',
        ]);

        Schedule::create([
            'classroom_id' => $classroom->id,
            'teacher_id' => $teacher->id,
            'day_of_week' => 'Selasa',
            'start_time' => '13:00',
            'end_time' => '14:30',
        ]);

        // When logged in as admin, visiting /guru/kelas should not show empty state
        $response = $this->actingAs($admin)->get(route('guru.kelas'));

        $response->assertOk()
            ->assertDontSee('Belum ada kelas yang ditugaskan oleh Admin kepada Anda.')
            ->assertSee('English Conversation')
            ->assertSee('Siti Nurhaliza')
            ->assertSee('Selasa, 13:00 - 14:30 WIB');

        // Admin can enter learning view without 404
        $learningResponse = $this->actingAs($admin)->get(route('guru.kelas.learning', $classroom));
        $learningResponse->assertOk()
            ->assertSee('English Conversation');
    }

    public function test_teacher_sees_assigned_classes_on_guru_portal(): void
    {
        $teacherUser = User::factory()->create(['name' => 'Ahmad Dahlan', 'role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id, 'subject' => 'Biologi']);

        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Biologi Sel',
            'subject' => 'Biologi',
            'grade_level' => '11',
        ]);

        Schedule::create([
            'classroom_id' => $classroom->id,
            'teacher_id' => $teacher->id,
            'day_of_week' => 'Kamis',
            'start_time' => '07:30',
            'end_time' => '09:00',
        ]);

        $response = $this->actingAs($teacherUser)->get(route('guru.kelas'));
        $response->assertOk()
            ->assertSee('Biologi Sel')
            ->assertSee('Ahmad Dahlan')
            ->assertSee('Kamis, 07:30 - 09:00 WIB');

        $homeResponse = $this->actingAs($teacherUser)->get(route('guru.home'));
        $homeResponse->assertOk()
            ->assertSee('Biologi Sel');
    }

    public function test_student_home_displays_classrooms(): void
    {
        $studentUser = User::factory()->create(['role' => 'student']);
        $student = Student::factory()->create(['user_id' => $studentUser->id]);

        $teacherUser = User::factory()->create(['name' => 'Dr. Habibie', 'role' => 'teacher']);
        $teacher = Teacher::factory()->create(['user_id' => $teacherUser->id, 'subject' => 'Fisika']);

        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Fisika Dasar',
            'subject' => 'Fisika',
            'grade_level' => '10',
        ]);

        Schedule::create([
            'classroom_id' => $classroom->id,
            'teacher_id' => $teacher->id,
            'day_of_week' => 'Jumat',
            'start_time' => '08:00',
            'end_time' => '09:30',
        ]);

        $student->classrooms()->attach($classroom->id);

        $response = $this->actingAs($studentUser)
            ->withSession(['student_id' => $student->id])
            ->get(route('siswa.home'));

        $response->assertOk()
            ->assertSee('Kelas Pembelajaran')
            ->assertSee('Fisika Dasar')
            ->assertSee('Dr. Habibie')
            ->assertSee('Jumat, 08:00 - 09:30 WIB');
    }
}
