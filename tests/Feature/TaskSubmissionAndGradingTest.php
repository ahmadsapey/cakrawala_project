<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TaskSubmissionAndGradingTest extends TestCase
{
    use RefreshDatabase;

    private function createTeacherAndClassroom(): array
    {
        $teacherUser = User::create([
            'name' => 'Bu Ratna Matematika',
            'email' => 'ratna@cakrawala.test',
            'password' => 'password123',
            'role' => 'teacher',
        ]);
        $teacher = Teacher::create([
            'user_id' => $teacherUser->id,
            'nip' => '19870202202601',
            'subject' => 'Matematika',
            'status' => 'active',
        ]);

        $classroom = Classroom::create([
            'teacher_id' => $teacher->id,
            'name' => 'Matematika XI MIPA 1',
            'subject' => 'Matematika',
            'grade_level' => 'Kelas 11',
            'section' => 'MIPA 1',
        ]);

        return [$teacherUser, $teacher, $classroom];
    }

    private function createStudent(Classroom $classroom): array
    {
        $studentUser = User::create([
            'name' => 'Bintang Pratama',
            'email' => 'bintang@cakrawala.test',
            'password' => 'password123',
            'role' => 'student',
        ]);
        $student = Student::create([
            'user_id' => $studentUser->id,
            'nisn' => '0089128391',
            'class_name' => 'XI MIPA 1',
            'status' => 'active',
        ]);

        $classroom->students()->attach($student->id);

        return [$studentUser, $student];
    }

    public function test_student_can_view_tasks_and_submit_assignment(): void
    {
        Storage::fake('public');

        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        $assignment = Assignment::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Tugas Matriks Determinan',
            'instructions' => 'Selesaikan soal determinan ordo 2x2 dan 3x3 di kertas lalu unggah.',
            'points' => 100,
            'status' => 'published',
            'due_date' => now()->addDays(3),
        ]);

        // Student visits task page
        $viewResponse = $this->actingAs($studentUser)->get(route('siswa.tugas'));
        $viewResponse->assertOk()
            ->assertSee('Tugas Matriks Determinan');

        // Student submits assignment with file and text
        $fakeFile = UploadedFile::fake()->create('jawaban_matriks.pdf', 300, 'application/pdf');

        $submitResponse = $this->actingAs($studentUser)->post(route('siswa.tugas.submit', $assignment), [
            'submission_text' => 'Berikut hasil kerja determinan saya, Pak.',
            'file' => $fakeFile,
        ]);

        $submitResponse->assertRedirect(route('siswa.tugas'));
        $submitResponse->assertSessionHas('success');

        $this->assertDatabaseHas('assignment_submissions', [
            'assignment_id' => $assignment->id,
            'student_id' => $student->id,
            'submission_text' => 'Berikut hasil kerja determinan saya, Pak.',
            'status' => 'submitted',
        ]);

        $submission = AssignmentSubmission::where('assignment_id', $assignment->id)->first();
        $this->assertNotNull($submission->file_path);
        Storage::disk('public')->assertExists($submission->file_path);
    }

    public function test_teacher_can_view_submissions_and_grade_student(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        $assignment = Assignment::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Tugas Praktikum Mandiri',
            'instructions' => 'Selesaikan praktikum.',
            'points' => 100,
            'status' => 'published',
        ]);

        $submission = AssignmentSubmission::create([
            'assignment_id' => $assignment->id,
            'student_id' => $student->id,
            'submission_text' => 'Laporan lengkap sudah saya buat.',
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        // Teacher visits task correction dashboard
        $response = $this->actingAs($teacherUser)->get(route('guru.koreksi.tugas'));
        $response->assertOk()
            ->assertSee('Daftar Pengumpulan Tugas')
            ->assertSee('Bintang Pratama');

        // Teacher visits grading page for submission
        $gradingPageResponse = $this->actingAs($teacherUser)->get(route('guru.input-nilai', $submission));
        $gradingPageResponse->assertOk()
            ->assertSee('Input Nilai Siswa')
            ->assertSee('Bintang Pratama')
            ->assertSee('Laporan lengkap sudah saya buat.');

        // Teacher submits score and feedback
        $storeGradeResponse = $this->actingAs($teacherUser)->post(route('guru.input-nilai.store', $submission), [
            'score' => 95,
            'feedback' => 'Hasil pekerjaan sangat rapi dan perhitungan benar semua.',
        ]);

        $storeGradeResponse->assertRedirect(route('guru.koreksi.tugas'));
        $storeGradeResponse->assertSessionHas('success');

        $this->assertDatabaseHas('assignment_submissions', [
            'id' => $submission->id,
            'score' => 95,
            'status' => 'graded',
            'feedback' => 'Hasil pekerjaan sangat rapi dan perhitungan benar semua.',
        ]);
    }

    public function test_teacher_can_view_classroom_students_list(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        $response = $this->actingAs($teacherUser)->get(route('guru.siswa', $classroom));
        $response->assertOk()
            ->assertSee('Daftar Siswa Kelas')
            ->assertSee('Bintang Pratama')
            ->assertSee('0089128391');
    }
}
