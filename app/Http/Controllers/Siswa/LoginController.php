<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt([...$credentials, 'role' => 'student'])) {
            return back()->withErrors(['email' => 'Email atau kata sandi siswa tidak sesuai.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('student_id', Auth::user()->student->id);

        return redirect()->route('siswa.home');
    }
}
