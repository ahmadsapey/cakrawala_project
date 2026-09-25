<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\RegisterStudentRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function store(RegisterStudentRequest $request): RedirectResponse
    {
        [$user, $student] = DB::transaction(function () use ($request) {
            $data = $request->validated();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'student',
            ]);

            $student = $user->student()->create([
                'nisn' => $data['nisn'],
                'class_name' => $data['class_name'],
                'status' => 'active',
            ]);

            return [$user, $student];
        });

        Auth::login($user);
        session(['student_id' => $student->id]);

        return redirect()->route('siswa.payment.create')->with('success', 'Akun berhasil dibuat. Silakan kirim pembayaran.');
    }
}
