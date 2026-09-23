<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\StorePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function create(): View
    {
        return view('modulSiswa.payment', [
            'payments' => Payment::where('student_id', session('student_id'))->latest()->get(),
        ]);
    }

    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $payment = Payment::create([
            ...$request->validated(),
            'student_id' => session('student_id'),
            'invoice_number' => 'INV-'.now()->format('YmdHis').'-'.Str::upper(Str::random(4)),
        ]);

        return redirect()->route('siswa.payment.create')->with('success', "Pembayaran {$payment->invoice_number} menunggu konfirmasi admin.");
    }
}
