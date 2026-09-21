<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreStudentRequest;
use App\Http\Requests\Admin\UpdateStudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Student::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();
            $query->where(function ($subQuery) use ($search): void {
                $subQuery->where('nisn', 'like', "%{$search}%")
                    ->orWhere('class_name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search): void {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        return view('modulAdmin.manageSiswa', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modulAdmin.studentForm', ['student' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $student = DB::transaction(function () use ($request): Student {
            $data = $request->validated();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'student',
            ]);

            return $user->student()->create([
                'nisn' => $data['nisn'],
                'class_name' => $data['class_name'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'],
            ]);
        });

        return redirect()->route('admin.siswa.index')->with('success', "Mahasiswa {$student->user->name} berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        return view('modulAdmin.studentShow', ['student' => $student->load('user')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        return view('modulAdmin.studentForm', ['student' => $student->load('user')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        DB::transaction(function () use ($request, $student): void {
            $data = $request->validated();
            $student->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ] + (! empty($data['password']) ? ['password' => $data['password']] : []));
            $student->update([
                'nisn' => $data['nisn'],
                'class_name' => $data['class_name'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'],
            ]);
        });

        return redirect()->route('admin.siswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student): RedirectResponse
    {
        $student->user->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
