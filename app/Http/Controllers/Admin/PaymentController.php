<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Payment::with('student.user');

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();
            $query->where(function ($subQuery) use ($search): void {
                $subQuery->where('invoice_number', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('student.user', function ($userQuery) use ($search): void {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $payments = $query->latest()->paginate(10)->withQueryString();

        return view('modulAdmin.managePembayaran', compact('payments'));
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
