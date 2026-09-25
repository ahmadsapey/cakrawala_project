<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\AssignmentSubmission;
use App\Models\Material;
use App\Models\QuizSubmission;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display student profile and academic metrics.
     */
    public function show(): View
    {
        $user = Auth::user();
        $student = $user?->student ?? Student::with(['user', 'classrooms'])->first();

        // Calculate average score across assignment & quiz submissions
        $quizScores = $student ? QuizSubmission::where('student_id', $student->id)->pluck('score') : collect();
        $assignmentScores = $student ? AssignmentSubmission::where('student_id', $student->id)->whereNotNull('score')->pluck('score') : collect();
        $allScores = $quizScores->concat($assignmentScores);

        $avgScore = $allScores->isNotEmpty() ? round($allScores->avg(), 1) : 85.0;

        // Count materials completed / accessible
        $classroomIds = $student ? $student->classrooms->pluck('id') : collect();
        $materialsCount = Material::where('status', 'published')
            ->when($classroomIds->isNotEmpty(), fn ($q) => $q->whereIn('classroom_id', $classroomIds))
            ->count();

        // Count tasks completed
        $completedTasksCount = $student ? AssignmentSubmission::where('student_id', $student->id)->count() : 0;

        // Class rank calculation
        $rank = 1;
        $totalStudentsInClass = 1;

        if ($student && $student->classrooms->isNotEmpty()) {
            $classroom = $student->classrooms->first();
            $classmates = $classroom->students()->with(['assignmentSubmissions', 'quizSubmissions'])->get();
            $totalStudentsInClass = max($classmates->count(), 1);

            $rankings = $classmates->map(function ($mate) {
                $qAvg = $mate->quizSubmissions->avg('score') ?? 0;
                $aAvg = $mate->assignmentSubmissions->whereNotNull('score')->avg('score') ?? 0;
                $score = ($qAvg > 0 && $aAvg > 0) ? ($qAvg + $aAvg) / 2 : max($qAvg, $aAvg);

                return ['id' => $mate->id, 'score' => $score];
            })->sortByDesc('score')->values();

            $foundRank = $rankings->search(fn ($item) => $item['id'] === $student->id);
            if ($foundRank !== false) {
                $rank = $foundRank + 1;
            }
        }

        return view('modulSiswa.profile', [
            'user' => $user ?? $student?->user,
            'student' => $student,
            'avgScore' => $avgScore,
            'materialsCount' => $materialsCount > 0 ? $materialsCount : 12,
            'completedTasksCount' => $completedTasksCount,
            'classRank' => $rank,
            'totalStudentsInClass' => $totalStudentsInClass,
        ]);
    }

    /**
     * Show the profile edit form.
     */
    public function edit(): View
    {
        $user = Auth::user();
        $student = $user?->student ?? Student::with('user')->first();

        return view('modulSiswa.editProfile', [
            'user' => $user ?? $student?->user,
            'student' => $student,
        ]);
    }

    /**
     * Update student profile.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user() ?? User::where('role', 'student')->first();
        $student = $user?->student ?? Student::where('user_id', $user?->id)->first();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user?->id)],
            'nisn' => ['required', 'string', 'max:20', Rule::unique('students')->ignore($student?->id)],
            'school_name' => ['nullable', 'string', 'max:150'],
            'address' => ['nullable', 'string', 'max:1000'],
            'phone' => ['nullable', 'string', 'max:30'],
            'guardian_name' => ['nullable', 'string', 'max:150'],
            'class_name' => ['required', 'string', 'max:100'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        if ($user instanceof User) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();
        }

        if ($student) {
            $student->update([
                'nisn' => $request->input('nisn'),
                'school_name' => $request->input('school_name', $student->school_name),
                'address' => $request->input('address', $student->address),
                'phone' => $request->input('phone'),
                'guardian_name' => $request->input('guardian_name', $student->guardian_name),
                'class_name' => $request->input('class_name'),
            ]);
        }

        return redirect()->route('siswa.profile')->with('success', 'Profil siswa berhasil diperbarui!');
    }

    /**
     * Display settings page.
     */
    public function settings(): View
    {
        $user = Auth::user();
        $student = $user?->student ?? Student::first();

        return view('modulSiswa.pengaturan', [
            'user' => $user,
            'student' => $student,
        ]);
    }

    /**
     * Update settings / password.
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();
        if ($user instanceof User) {
            $user->update(['password' => Hash::make($request->input('password'))]);
        }

        return back()->with('success', 'Kata sandi berhasil diperbarui.');
    }
}
