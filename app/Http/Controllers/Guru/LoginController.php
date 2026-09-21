<?php

namespace App\Http\Controllers\Guru;

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

        if (! Auth::attempt([...$credentials, 'role' => 'teacher'])) {
            return back()->withErrors(['email' => 'Email atau kata sandi guru tidak sesuai.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('teacher_id', Auth::user()->teacher->id);

        return redirect()->route('guru.home');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guru.login');
    }
}
