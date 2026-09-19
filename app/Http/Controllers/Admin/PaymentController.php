<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('modulAdmin.payments.index', [
            'payments' => Payment::with('student.user')->latest()->paginate(10),
        ]);
    }

    public function confirm(Payment $payment): RedirectResponse
    {
        $payment->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', "Pembayaran {$payment->invoice_number} dikonfirmasi.");
    }

    public function reject(Payment $payment): RedirectResponse
    {
        $payment->update([
            'status' => 'rejected',
            'confirmed_at' => null,
        ]);

        return back()->with('success', "Pembayaran {$payment->invoice_number} ditolak.");
    }
}
