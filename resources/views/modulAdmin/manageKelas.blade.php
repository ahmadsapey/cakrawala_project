<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Manajemen Kelas | Cakrawala Educentre</title><script src="https://cdn.tailwindcss.com"></script>    @include('components.fonts')
</head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
@include('components.headerAdmin')
<main class="mx-auto max-w-6xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
    <div class="flex flex-col justify-between gap-4 rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm sm:flex-row sm:items-end sm:p-8"><div><p class="text-xs font-black uppercase tracking-wider text-indigo-700">Modul Admin</p><h1 class="mt-2 text-2xl font-black text-slate-900">Manajemen Kelas</h1><p class="mt-1 text-sm font-semibold text-slate-500">Kelola kelas dan wali kelas.</p></div><a href="{{ route('admin.kelas.create') }}" class="rounded-xl bg-indigo-600 px-5 py-3 text-xs font-black text-white hover:bg-indigo-700">+ Tambah Kelas</a></div>
    @if (session('success'))<div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-800">{{ session('success') }}</div>@endif
    <div class="grid gap-4 md:grid-cols-2">
        @forelse ($classrooms as $classroom)
            @php
                $schedule = $classroom->schedules->first();
            @endphp
            <article class="flex flex-col justify-between rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm hover:shadow-md transition-all">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <span class="rounded-lg bg-indigo-50 border border-indigo-100 px-2.5 py-1 text-[11px] font-black uppercase tracking-wider text-indigo-700">
                                {{ $classroom->subject }}
                            </span>
                            <h2 class="mt-2 text-lg font-black text-slate-900">{{ $classroom->name }}</h2>
                        </div>
                        <span class="rounded-xl bg-slate-100 border border-slate-200 px-2.5 py-1 text-xs font-bold text-slate-600">
                            Tingkat {{ $classroom->grade_level }}
                        </span>
                    </div>

                    <div class="space-y-1.5 text-xs text-slate-600">
                        <p class="font-semibold text-slate-700">
                            <span class="text-slate-400 font-normal">Wali Kelas:</span> {{ $classroom->teacher?->user?->name ?? '-' }} · <span class="font-bold text-indigo-600">{{ $classroom->students_count }} siswa</span>
                        </p>
                        @if ($schedule && $schedule->day_of_week)
                            <p class="flex items-center gap-1.5 font-bold text-indigo-700">
                                <svg class="h-3.5 w-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ $schedule->day_of_week }} · {{ $schedule->start_time }} - {{ $schedule->end_time }} WIB</span>
                            </p>
                        @endif
                        @if ($classroom->section)
                            <p class="text-slate-500 font-semibold"><span class="text-slate-400 font-normal">Ruang:</span> {{ $classroom->section }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-5 flex gap-2 border-t border-slate-100 pt-4">
                    <a href="{{ route('admin.kelas.show', $classroom) }}" class="flex-1 rounded-xl border border-indigo-200 px-3 py-2.5 text-center text-xs font-black text-indigo-700 hover:bg-indigo-50 transition">Detail</a>
                    <a href="{{ route('admin.kelas.edit', $classroom) }}" class="flex-1 rounded-xl bg-indigo-50 px-3 py-2.5 text-center text-xs font-black text-indigo-700 hover:bg-indigo-100 transition">Edit</a>
                    <form class="flex-1" method="POST" action="{{ route('admin.kelas.destroy', $classroom) }}" onsubmit="return confirm('Hapus kelas ini?')">
                        @csrf @method('DELETE')
                        <button class="w-full rounded-xl bg-rose-50 px-3 py-2.5 text-xs font-black text-rose-700 hover:bg-rose-100 transition">Hapus</button>
                    </form>
                </div>
            </article>
        @empty
            <div class="rounded-3xl border-2 border-dashed border-slate-300 bg-white p-12 text-center text-sm font-bold text-slate-500 md:col-span-2">Belum ada kelas.</div>
        @endforelse
    </div>
    {{ $classrooms->links() }}
</main>
@include('components.footerMobile_admin')
</body></html>
