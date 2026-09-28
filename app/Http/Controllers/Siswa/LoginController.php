<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $name = trim((string) ($request->input('name') ?? $request->input('username')));
        $identifier = trim((string) ($request->input('nisn') ?? $request->input('email') ?? $request->input('login_key')));
        $password = $request->input('password');

        if ($request->filled('email') && $request->filled('password')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ]);

            if (Auth::attempt([...$credentials, 'role' => 'student'])) {
                $student = Auth::user()?->student;
                $request->session()->regenerate();
                if ($student) {
                    $request->session()->put('student_id', $student->id);
                }

                return redirect()->route('siswa.home');
            }
        }

        if (empty($name) && empty($identifier)) {
            return back()->withErrors([
                'name' => 'Nama Siswa dan NISN/Email harus diisi.',
                'email' => 'Nama Siswa dan NISN/Email harus diisi.',
                'login' => 'Nama Siswa dan NISN/Email harus diisi.',
            ])->withInput();
        }

        $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL) !== false;

        $student = Student::with('user')
            ->where('status', 'active')
            ->where(function ($query) use ($identifier, $isEmail): void {
                if ($isEmail) {
                    $query->whereHas('user', fn ($uQuery) => $uQuery->where('email', $identifier)->where('role', 'student'));
                } else {
                    $query->where('nisn', $identifier)
                        ->orWhereHas('user', fn ($uQuery) => $uQuery->where('email', $identifier)->where('role', 'student'));
                }
            })
            ->first();

        if (! $student && ! empty($name)) {
            $student = Student::with('user')
                ->where('status', 'active')
                ->whereHas('user', function ($uQuery) use ($name, $identifier, $isEmail): void {
                    $uQuery->where('role', 'student')
                        ->where('name', $name);
                    if ($isEmail) {
                        $uQuery->where('email', $identifier);
                    }
                })
                ->first();
        }

        if (! $student || ! $student->user) {
            return back()->withErrors([
                'name' => 'Nama atau NISN/Email siswa tidak sesuai, atau akun tidak aktif.',
                'email' => 'Nama atau NISN/Email siswa tidak sesuai, atau akun tidak aktif.',
                'login' => 'Nama atau NISN/Email siswa tidak sesuai, atau akun tidak aktif.',
            ])->withInput();
        }

        $user = $student->user;

        $isNameMatch = empty($name) || (mb_strtolower(trim($user->name)) === mb_strtolower($name));
        $isPasswordMatch = ! empty($password) && Hash::check($password, $user->password);

        if (! $isNameMatch && ! $isPasswordMatch) {
            return back()->withErrors([
                'name' => 'Nama atau NISN/Email siswa tidak sesuai.',
                'email' => 'Nama atau NISN/Email siswa tidak sesuai.',
                'login' => 'Nama atau NISN/Email siswa tidak sesuai.',
            ])->withInput();
        }

        Auth::login($user);
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
