<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeacherRequest;
use App\Http\Requests\Admin\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Teacher::with('user');

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('nip', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status') && in_array($request->status, ['active', 'inactive'])) {
            $query->where('status', $request->status);
        }

        return view('modulAdmin.manageGuru', [
            'teachers' => $query->latest()->paginate(12)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('modulAdmin.teacherForm', ['teacher' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request): RedirectResponse
    {
        $teacher = DB::transaction(function () use ($request): Teacher {
            $data = $request->validated();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'teacher',
            ]);

            return $user->teacher()->create([
                'nip' => $data['nip'],
                'subject' => $data['subject'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'],
            ]);
        });

        return redirect()->route('admin.guru.index')->with('success', "Guru {$teacher->user->name} berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher): View
    {
        return view('modulAdmin.teacherShow', ['teacher' => $teacher->load('user')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher): View
    {
        return view('modulAdmin.teacherForm', ['teacher' => $teacher->load('user')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher): RedirectResponse
    {
        DB::transaction(function () use ($request, $teacher): void {
            $data = $request->validated();
            $teacher->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ] + (! empty($data['password']) ? ['password' => $data['password']] : []));
            $teacher->update([
                'nip' => $data['nip'],
                'subject' => $data['subject'],
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'],
            ]);
        });

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher): RedirectResponse
    {
        $teacher->user->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
