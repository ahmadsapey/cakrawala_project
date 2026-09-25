<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizSubmission;
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

    public function test_student_can_take_quiz_and_receive_automated_score(): void
    {
        [$teacherUser, $teacher, $classroom] = $this->createTeacherAndClassroom();
        [$studentUser, $student] = $this->createStudent($classroom);

        $quiz = Quiz::create([
            'teacher_id' => $teacher->id,
            'classroom_id' => $classroom->id,
            'title' => 'Kuis Matriks Dasar',
            'description' => 'Evaluasi konsep dasar matriks',
            'duration_minutes' => 15,
            'passing_score' => 70,
            'status' => 'published',
        ]);

        $q1 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Nilai determinan matriks identitas 2x2 adalah...',
            'options' => ['A' => '0', 'B' => '1', 'C' => '2', 'D' => '-1'],
            'correct_answer' => 'B',
            'sort_order' => 1,
        ]);

        $q2 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Jika A berordo 2x3 dan B berordo 3x2, ordo AB adalah...',
            'options' => ['A' => '2x2', 'B' => '3x3', 'C' => '2x3', 'D' => '3x2'],
            'correct_answer' => 'A',
            'sort_order' => 2,
        ]);

        // Student opens quiz page
        $quizPageResponse = $this->actingAs($studentUser)->get(route('siswa.pengerjaan', $quiz));
        $quizPageResponse->assertOk()
            ->assertSee('Kuis Matriks Dasar')
            ->assertSee('Nilai determinan matriks identitas 2x2 adalah...');

        // Student answers: Q1 correct (B), Q2 incorrect (C)
        $submitQuizResponse = $this->actingAs($studentUser)->post(route('siswa.pengerjaan.submit', $quiz), [
            'answers' => [
                $q1->id => 'B',
                $q2->id => 'C',
            ],
            'duration_seconds' => 320,
        ]);

        $submission = QuizSubmission::where('quiz_id', $quiz->id)->where('student_id', $student->id)->first();
        $this->assertNotNull($submission);
        $this->assertEquals(50.0, (float) $submission->score); // 1 out of 2 = 50%
        $this->assertEquals(1, $submission->correct_count);
        $this->assertEquals(1, $submission->incorrect_count);

        $submitQuizResponse->assertRedirect(route('siswa.evaluasi', $submission));

        // Evaluation page displays score and status
        $evalResponse = $this->actingAs($studentUser)->get(route('siswa.evaluasi', $submission));
        $evalResponse->assertOk()
            ->assertSee('Hasil Evaluasi Pengerjaan')
            ->assertSee('50')
            ->assertSee('Belum Mencapai KKM'); // passing score is 70, score is 50
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
