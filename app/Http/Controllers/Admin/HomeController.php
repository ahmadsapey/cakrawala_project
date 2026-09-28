<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalClassrooms = Classroom::count();

        $monthConfirmed = Payment::where('status', 'confirmed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $totalConfirmed = Payment::where('status', 'confirmed')->sum('amount');
        $paidAmount = $monthConfirmed > 0 ? $monthConfirmed : $totalConfirmed;

        $totalPending = Payment::where('status', 'pending')->sum('amount');

        $recentClassrooms = Classroom::with(['teacher.user', 'schedules'])
            ->withCount('students')
            ->latest()
            ->take(4)
            ->get();

        $recentStudents = Student::with('user')->latest()->take(3)->get()->map(function (Student $student): array {
            $studentName = $student->user?->name ? Str::title($student->user->name) : 'Siswa';
            $className = $student->class_name ? Str::title($student->class_name) : 'Kelas';

            return [
                'type' => 'student',
                'title' => 'Siswa Baru Terdaftar',
                'subtitle' => $studentName.' - '.$className,
                'time' => $student->created_at?->locale('id')->diffForHumans() ?? 'Baru saja',
                'raw_time' => $student->created_at,
            ];
        });

        $recentPayments = Payment::with('student.user')->latest()->take(3)->get()->map(function (Payment $payment): array {
            $studentName = $payment->student?->user?->name ? Str::title($payment->student->user->name) : 'Siswa';
            $statusLabel = match ($payment->status) {
                'confirmed' => 'Diterima',
                'pending' => 'Menunggu Konfirmasi',
                default => 'Ditolak',
            };

            return [
                'type' => 'payment',
                'title' => 'Pembayaran '.$statusLabel,
                'subtitle' => $payment->invoice_number.' - '.$studentName,
                'time' => $payment->created_at?->locale('id')->diffForHumans() ?? 'Baru saja',
                'raw_time' => $payment->created_at,
            ];
        });

        $recentTeachers = Teacher::with('user')->latest()->take(3)->get()->map(function (Teacher $teacher): array {
            $teacherName = $teacher->user?->name ? Str::title($teacher->user->name) : 'Guru';
            $subjectName = $teacher->subject ? Str::title($teacher->subject) : 'Mata Pelajaran';

            return [
                'type' => 'teacher',
                'title' => 'Guru Baru Ditambahkan',
                'subtitle' => $teacherName.' - '.$subjectName,
                'time' => $teacher->created_at?->locale('id')->diffForHumans() ?? 'Baru saja',
                'raw_time' => $teacher->created_at,
            ];
        });

        $recentClassroomActivities = Classroom::with('teacher.user')->latest()->take(3)->get()->map(function (Classroom $classroom): array {
            $teacherName = $classroom->teacher?->user?->name ? Str::title($classroom->teacher->user->name) : 'Belum Ditentukan';
            $subjectName = $classroom->subject ? Str::title($classroom->subject) : 'Mata Pelajaran';

            return [
                'type' => 'classroom',
                'title' => 'Kelas Baru Dibuat: '.Str::title($classroom->name),
                'subtitle' => $subjectName.' • Guru: '.$teacherName,
                'time' => $classroom->created_at?->locale('id')->diffForHumans() ?? 'Baru saja',
                'raw_time' => $classroom->created_at,
            ];
        });

        /** @var Collection<int, array{type: string, title: string, subtitle: string, time: string, raw_time: mixed}> $recentActivities */
        $recentActivities = collect()
            ->concat($recentStudents)
            ->concat($recentPayments)
            ->concat($recentTeachers)
            ->concat($recentClassroomActivities)
            ->sortByDesc('raw_time')
            ->take(5)
            ->values();

        return view('modulAdmin.home', [
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'totalClassrooms' => $totalClassrooms,
            'recentClassrooms' => $recentClassrooms,
            'paidAmount' => $paidAmount,
            'totalPending' => $totalPending,
            'currentMonthName' => now()->locale('id')->isoFormat('MMMM'),
            'recentActivities' => $recentActivities,
        ]);
    }
}
