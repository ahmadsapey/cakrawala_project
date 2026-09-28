<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QuizTakingController extends Controller
{
    /**
     * Display the quiz taking page.
     */
    public function show(Request $request, ?Quiz $quiz = null): View|RedirectResponse
    {
        if (! $quiz || ! $quiz->exists) {
            $quizId = $request->query('quiz');
            $quiz = $quizId ? Quiz::find($quizId) : Quiz::where('status', 'published')->first();
        }

        if (! $quiz) {
            return redirect()->route('siswa.tugas')->with('error', 'Belum ada kuis yang tersedia untuk dikerjakan.');
        }

        // If quiz has no questions yet, create demo questions so it is interactive
        if ($quiz->questions()->count() === 0) {
            $this->seedDefaultQuestions($quiz);
        }

        $questions = $quiz->questions()->orderBy('sort_order')->get();

        return view('modulSiswa.pengerjaan', [
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }

    /**
     * Submit quiz answers and calculate score.
     */
    public function submit(Request $request, Quiz $quiz): RedirectResponse
    {
        $submittedAnswers = $request->input('answers', []);
        $questions = $quiz->questions()->orderBy('sort_order')->get();

        $totalQuestions = $questions->count();
        $correctCount = 0;

        foreach ($questions as $question) {
            $studentChoice = $submittedAnswers[$question->id] ?? null;
            if ($studentChoice && strtoupper((string) $studentChoice) === strtoupper($question->correct_answer)) {
                $correctCount++;
            }
        }

        $incorrectCount = $totalQuestions - $correctCount;
        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 0;

        $student = Auth::user()?->student;
        if (! $student) {
            $student = Student::first();
        }

        $submission = QuizSubmission::create([
            'quiz_id' => $quiz->id,
            'student_id' => $student->id,
            'answers' => $submittedAnswers,
            'score' => $score,
            'correct_count' => $correctCount,
            'incorrect_count' => $incorrectCount,
            'duration_seconds' => $request->integer('duration_seconds', 450),
            'status' => 'completed',
            'started_at' => now()->subSeconds($request->integer('duration_seconds', 450)),
            'submitted_at' => now(),
        ]);

        return redirect()->route('siswa.evaluasi', $submission);
    }

    /**
     * Display evaluation page for a submission.
     */
    public function evaluation(Request $request, ?QuizSubmission $submission = null): View|RedirectResponse
    {
        if (! $submission || ! $submission->exists) {
            $submissionId = $request->query('submission');
            $submission = $submissionId ? QuizSubmission::find($submissionId) : QuizSubmission::latest()->first();
        }

        if (! $submission) {
            return redirect()->route('siswa.tugas')->with('error', 'Belum ada data evaluasi pengerjaan.');
        }

        $quiz = $submission->quiz()->with('classroom')->first();
        $questions = $quiz ? $quiz->questions()->orderBy('sort_order')->get() : collect();
        $student = $submission->student()->with('user')->first();

        return view('modulSiswa.evaluasiPengerjaan', [
            'submission' => $submission,
            'quiz' => $quiz,
            'questions' => $questions,
            'student' => $student,
            'studentAnswers' => $submission->answers ?? [],
        ]);
    }

    /**
     * Seed realistic sample questions if quiz has none.
     */
    private function seedDefaultQuestions(Quiz $quiz): void
    {
        $defaultQuestions = [
            [
                'question_text' => 'Jika sebuah matriks berordo 2x2 memiliki nilai determinan sebesar 5, maka determinan dari matriks hasil operasi 2A adalah...',
                'options' => ['A' => '10', 'B' => '20', 'C' => '5', 'D' => '15', 'E' => '25'],
                'correct_answer' => 'B',
                'explanation' => 'Untuk matriks A berordo n x n, det(kA) = k^n * det(A). Dengan n=2 dan k=2, det(2A) = 2^2 * 5 = 20.',
                'sort_order' => 1,
            ],
            [
                'question_text' => 'Manakah di bawah ini yang merupakan sifat dari matriks identitas I terhadap perkalian matriks A?',
                'options' => ['A' => 'A * I = I', 'B' => 'A * I = 0', 'C' => 'A * I = A', 'D' => 'A * I = -A', 'E' => 'A * I = A^2'],
                'correct_answer' => 'C',
                'explanation' => 'Matriks identitas berperilaku seperti angka 1 pada perkalian bilangan riil, sehingga A * I = I * A = A.',
                'sort_order' => 2,
            ],
            [
                'question_text' => 'Jika matriks A memiliki invers, maka nilai determinan dari matriks A adalah...',
                'options' => ['A' => 'Harus sama dengan 0', 'B' => 'Tidak boleh sama dengan 0', 'C' => 'Harus bilangan negatif', 'D' => 'Harus bilangan ganjil', 'E' => 'Selalu bernilai 1'],
                'correct_answer' => 'B',
                'explanation' => 'Matriks memiliki invers (non-singular) jika dan hanya jika determinannya tidak sama dengan nol (det(A) != 0).',
                'sort_order' => 3,
            ],
            [
                'question_text' => 'Suatu sistem persamaan linear dua variabel memiliki solusi tunggal apabila nilai determinan matriks koefisiennya adalah...',
                'options' => ['A' => 'Sama dengan 0', 'B' => 'Bukan nol (det != 0)', 'C' => 'Bernilai tak terhingga', 'D' => 'Berupa matriks nol', 'E' => 'Bernilai imajiner'],
                'correct_answer' => 'B',
                'explanation' => 'Menggunakan aturan Cramer, SPLDV memiliki solusi unik jika determinan matriks utama bukan nol.',
                'sort_order' => 4,
            ],
        ];

        foreach ($defaultQuestions as $q) {
            Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $q['question_text'],
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'explanation' => $q['explanation'],
                'sort_order' => $q['sort_order'],
            ]);
        }

        $quiz->update(['question_count' => count($defaultQuestions)]);
    }
}
