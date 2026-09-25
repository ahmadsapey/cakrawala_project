<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();

        $monthConfirmed = Payment::where('status', 'confirmed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $totalConfirmed = Payment::where('status', 'confirmed')->sum('amount');
        $paidAmount = $monthConfirmed > 0 ? $monthConfirmed : $totalConfirmed;

        $totalPending = Payment::where('status', 'pending')->sum('amount');

        $recentStudents = Student::with('user')->latest()->take(3)->get()->map(function (Student $student): array {
            return [
                'type' => 'student',
                'title' => 'siswa baru terdaftar',
                'subtitle' => ($student->user?->name ?? 'siswa').' - '.($student->class_name ?? 'Kelas'),
                'time' => $student->created_at?->diffForHumans() ?? 'Baru saja',
                'raw_time' => $student->created_at,
            ];
        });

        $recentPayments = Payment::with('student.user')->latest()->take(3)->get()->map(function (Payment $payment): array {
            return [
                'type' => 'payment',
                'title' => 'Pembayaran '.($payment->status === 'confirmed' ? 'diterima' : ($payment->status === 'pending' ? 'menunggu' : 'ditolak')),
                'subtitle' => ($payment->invoice_number).' - '.($payment->student?->user?->name ?? 'Siswa'),
                'time' => $payment->created_at?->diffForHumans() ?? 'Baru saja',
                'raw_time' => $payment->created_at,
            ];
        });

        $recentTeachers = Teacher::with('user')->latest()->take(3)->get()->map(function (Teacher $teacher): array {
            return [
                'type' => 'teacher',
                'title' => 'Guru baru ditambahkan',
                'subtitle' => ($teacher->user?->name ?? 'Guru').' - '.($teacher->subject ?? 'Mata Pelajaran'),
                'time' => $teacher->created_at?->diffForHumans() ?? 'Baru saja',
                'raw_time' => $teacher->created_at,
            ];
        });

        /** @var Collection<int, array{type: string, title: string, subtitle: string, time: string, raw_time: mixed}> $recentActivities */
        $recentActivities = collect()
            ->concat($recentStudents)
            ->concat($recentPayments)
            ->concat($recentTeachers)
            ->sortByDesc('raw_time')
            ->take(5)
            ->values();

        return view('modulAdmin.home', [
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'paidAmount' => $paidAmount,
            'totalPending' => $totalPending,
            'currentMonthName' => now()->locale('id')->isoFormat('MMMM'),
            'recentActivities' => $recentActivities,
        ]);
    }
}
