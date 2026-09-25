<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Manajemen Kelas | Cakrawala Educentre</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
@include('components.headerAdmin')
<main class="mx-auto max-w-6xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
    <div class="flex flex-col justify-between gap-4 rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm sm:flex-row sm:items-end sm:p-8"><div><p class="text-xs font-black uppercase tracking-wider text-indigo-700">Modul Admin</p><h1 class="mt-2 text-2xl font-black text-slate-900">Manajemen Kelas</h1><p class="mt-1 text-sm font-semibold text-slate-500">Kelola kelas dan guru pengampu.</p></div><a href="{{ route('admin.kelas.create') }}" class="rounded-xl bg-indigo-600 px-5 py-3 text-xs font-black text-white hover:bg-indigo-700">+ Tambah Kelas</a></div>
    @if (session('success'))<div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-800">{{ session('success') }}</div>@endif
    <div class="grid gap-4 md:grid-cols-2">
        @forelse ($classrooms as $classroom)
            <article class="flex flex-col justify-between rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm"><div><div class="flex items-start justify-between gap-3"><div><p class="text-xs font-black uppercase tracking-wider text-indigo-600">{{ $classroom->subject }}</p><h2 class="mt-2 text-lg font-black text-slate-900">{{ $classroom->name }}</h2></div><span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-bold">{{ $classroom->grade_level }}</span></div><p class="mt-3 text-sm font-semibold text-slate-500">Guru: {{ $classroom->teacher?->user?->name ?? '-' }} · {{ $classroom->students_count }} siswa</p>@if ($classroom->section)<p class="mt-1 text-xs font-semibold text-slate-400">{{ $classroom->section }}</p>@endif</div><div class="mt-5 flex gap-2 border-t border-slate-100 pt-4"><a href="{{ route('admin.kelas.show', $classroom) }}" class="flex-1 rounded-xl border border-indigo-200 px-3 py-2.5 text-center text-xs font-black text-indigo-700 hover:bg-indigo-50">Detail</a><a href="{{ route('admin.kelas.edit', $classroom) }}" class="flex-1 rounded-xl bg-indigo-50 px-3 py-2.5 text-center text-xs font-black text-indigo-700 hover:bg-indigo-100">Edit</a><form class="flex-1" method="POST" action="{{ route('admin.kelas.destroy', $classroom) }}" onsubmit="return confirm('Hapus kelas ini?')">@csrf @method('DELETE')<button class="w-full rounded-xl bg-rose-50 px-3 py-2.5 text-xs font-black text-rose-700 hover:bg-rose-100">Hapus</button></form></div></article>
        @empty
            <div class="rounded-3xl border-2 border-dashed border-slate-300 bg-white p-12 text-center text-sm font-bold text-slate-500 md:col-span-2">Belum ada kelas.</div>
        @endforelse
    </div>
    {{ $classrooms->links() }}
</main>
@include('components.footerMobile_admin')
</body></html>
