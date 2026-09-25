<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:20'],
        ]);

        $student = Student::with('user')
            ->where('nisn', $credentials['nisn'])
            ->where('status', 'active')
            ->whereHas('user', fn ($query) => $query->where('name', $credentials['name'])->where('role', 'student'))
            ->first();

        if (! $student?->user) {
            return back()->withErrors(['name' => 'Nama atau NISN siswa tidak sesuai, atau akun tidak aktif.'])->withInput();
        }

        Auth::login($student->user);
        $request->session()->regenerate();
        $request->session()->put('student_id', $student->id);

        return redirect()->route('siswa.home');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('siswa.login');
    }
}
