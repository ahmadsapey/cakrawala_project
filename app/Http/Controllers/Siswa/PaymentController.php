<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\StorePaymentRequest;
use App\Models\LandingContent;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function create(): View
    {
        $student = Auth::user()?->student ?? (session('student_id') ? Student::find(session('student_id')) : Student::first());
        $studentId = $student?->id;

        $packages = Schema::hasTable('landing_contents')
            ? LandingContent::where('type', 'package')->where('is_active', true)->orderBy('sort_order')->get()
            : collect();

        return view('modulSiswa.payment', [
            'payments' => $studentId ? Payment::where('student_id', $studentId)->latest()->get() : collect(),
            'packages' => $packages,
            'student' => $student,
        ]);
    }

    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $student = Auth::user()?->student ?? (session('student_id') ? Student::find(session('student_id')) : Student::first());

        if (! $student) {
            return back()->withErrors(['amount' => 'Profil siswa tidak ditemukan.']);
        }

        $payment = Payment::create([
            ...$request->validated(),
            'student_id' => $student->id,
            'invoice_number' => 'INV-'.now()->format('YmdHis').'-'.Str::upper(Str::random(4)),
        ]);

        return redirect()->route('siswa.payment.create')->with('success', "Pembayaran {$payment->invoice_number} berhasil diajukan dan menunggu konfirmasi admin.");
    }
}
