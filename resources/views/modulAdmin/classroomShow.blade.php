<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $classroom->name }} | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('components.fonts')
</head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
    @include('components.headerAdmin')

    <main class="mx-auto max-w-4xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <div class="flex items-center justify-between rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm">
            <div>
                <span class="rounded-lg bg-indigo-50 border border-indigo-100 px-2.5 py-1 text-[11px] font-black uppercase tracking-wider text-indigo-700">
                    {{ $classroom->subject }}
                </span>
                <h1 class="mt-2 text-2xl font-black text-slate-900">{{ $classroom->name }}</h1>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.kelas.index') }}" class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-100 transition">Kembali</a>
                <a href="{{ route('admin.kelas.edit', $classroom) }}" class="rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-black text-white hover:bg-indigo-700 transition">Edit</a>
            </div>
        </div>

        @php
            $schedule = $classroom->schedules->first();
        @endphp

        <div class="rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm sm:p-8">
            <h2 class="text-xs font-black uppercase tracking-wider text-indigo-700 mb-4">Informasi Kelas & Jadwal</h2>
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold text-slate-400">Wali Kelas / Guru Pengampu</p>
                    <p class="mt-1 font-bold text-slate-900 text-sm">{{ $classroom->teacher?->user?->name ?? '-' }}</p>
                    <p class="text-xs text-slate-500 font-semibold">{{ $classroom->teacher?->subject ?? '' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold text-slate-400">Tingkat / Jenjang</p>
                    <p class="mt-1 font-bold text-slate-900 text-sm">Tingkat {{ $classroom->grade_level }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold text-slate-400">Ruang / Sesi</p>
                    <p class="mt-1 font-bold text-slate-900 text-sm">{{ $classroom->section ?: 'Ruang Reguler' }}</p>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold text-slate-400">Jadwal Pembelajaran</p>
                    @if ($schedule && $schedule->day_of_week)
                        <p class="mt-1 font-bold text-indigo-700 text-sm">{{ $schedule->day_of_week }}</p>
                        <p class="text-xs text-slate-600 font-semibold">{{ $schedule->start_time }} - {{ $schedule->end_time }} WIB</p>
                    @else
                        <p class="mt-1 text-xs italic text-slate-400">Belum diatur</p>
                    @endif
                </div>

                <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold text-slate-400">Jumlah Siswa Terdaftar</p>
                    <p class="mt-1 font-bold text-slate-900 text-sm">{{ $classroom->students->count() }} Siswa</p>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                    <p class="text-xs font-bold text-slate-400">Kelas Online / Meeting</p>
                    @if ($classroom->online_meeting_url ?? $schedule?->online_meeting_url)
                        <a href="{{ $classroom->online_meeting_url ?? $schedule?->online_meeting_url }}" target="_blank" rel="noopener noreferrer" class="mt-1 block truncate text-xs font-bold text-indigo-600 hover:underline">
                            Buka Link Meeting &rarr;
                        </a>
                    @else
                        <p class="mt-1 text-xs text-slate-400 italic">Tatap Muka (Offline)</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm sm:p-8">
            <h2 class="text-lg font-black text-slate-900">Siswa Terdaftar ({{ $classroom->students->count() }})</h2>
            <div class="mt-4 divide-y divide-slate-100">
                @forelse ($classroom->students as $student)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ $student->user?->name }}</p>
                            <p class="text-xs text-slate-400 font-semibold">NISN: {{ $student->nisn }}</p>
                        </div>
                        <span class="rounded-lg bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-bold border border-emerald-100">Aktif</span>
                    </div>
                @empty
                    <p class="py-4 text-xs text-slate-400 italic text-center">Belum ada siswa yang didaftarkan ke kelas ini.</p>
                @endforelse
            </div>
        </div>
    </main>

    @include('components.footerMobile_admin')
</body>
</html>