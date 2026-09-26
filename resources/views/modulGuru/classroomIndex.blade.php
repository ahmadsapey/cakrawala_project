<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Guru | Cakrawala Educentre</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0D9488',
                        branddark: '#0F172A',
                    }
                }
            }
        }
    </script>
    @include('components.fonts')
</head>
<body class="min-h-screen bg-gradient-to-br from-teal-50/50 via-slate-50 to-emerald-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-teal-500 selection:text-white">
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        
        <!-- Header Halaman -->
        <div class="sticky top-16 z-40 flex flex-col justify-between gap-4 rounded-3xl border border-teal-100 bg-white/95 p-6 shadow-md shadow-slate-200/60 backdrop-blur-md sm:flex-row sm:items-end sm:p-7">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-teal-700 bg-teal-50 border border-teal-100 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Modul Guru</span>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Kelas yang Anda Ajar</h1>
                <p class="mt-1.5 text-xs sm:text-sm font-bold text-slate-500">Daftar kelas yang ditugaskan oleh Admin untuk Anda ampu.</p>
            </div>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-xs font-bold text-emerald-800 shadow-xs">
                {{ session('success') }}
            </div>
        @endif

        <!-- Daftar Kelas Grid -->
        <section class="rounded-3xl border border-teal-100 bg-white/60 p-2 shadow-xs sm:p-3">
            <div class="grid max-h-[calc(100vh-18rem)] min-h-[18rem] gap-5 overflow-y-auto pr-1 sm:max-h-[calc(100vh-16rem)] md:grid-cols-2 lg:grid-cols-3">
                @forelse ($classrooms as $classroom)
                    @php
                        $schedule = $classroom->schedules->first();
                    @endphp
                    <article class="flex flex-col justify-between overflow-hidden rounded-3xl border border-teal-100 bg-white shadow-xs transition-all hover:border-teal-500 hover:shadow-lg">
                        <!-- Header Kartu: Mata Pelajaran & Jadwal Waktu -->
                        <div class="bg-gradient-to-r from-teal-600 via-teal-700 to-emerald-700 p-5 text-white">
                            <div class="flex items-start justify-between gap-3">
                                <span class="inline-block rounded-lg bg-white/20 px-2.5 py-0.5 text-[10px] font-black uppercase tracking-wider text-teal-100 backdrop-blur-xs">
                                    {{ $classroom->subject }}
                                </span>
                                <span class="rounded-lg bg-teal-900/60 px-2.5 py-0.5 text-[11px] font-bold text-teal-100">
                                    Tingkat {{ $classroom->grade_level }}
                                </span>
                            </div>
                            <h2 class="mt-2 text-base sm:text-lg font-black tracking-tight text-white leading-snug">
                                {{ $classroom->name }}
                            </h2>
                            <div class="mt-2.5 flex items-center gap-1.5 text-xs font-semibold text-teal-100">
                                <svg class="h-4 w-4 shrink-0 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @if ($schedule && $schedule->day_of_week)
                                    <span>{{ $schedule->day_of_week }} · {{ $schedule->start_time }} - {{ $schedule->end_time }} WIB</span>
                                @else
                                    <span class="italic text-teal-200/80">Jadwal belum ditentukan</span>
                                @endif
                            </div>
                        </div>

                        <!-- Body Kartu: Informasi Lengkap Guru, Ruang, dan Siswa -->
                        <div class="p-5 space-y-3.5 text-xs flex-1">
                            <dl class="space-y-3 text-slate-600 divide-y divide-slate-100">
                                <div class="flex items-center justify-between gap-2 pt-1">
                                    <dt class="flex items-center gap-2 font-semibold text-slate-500">
                                        <svg class="h-4 w-4 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="7" r="3" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 21v-1.5a7 7 0 0 1 14 0V21m-7-5v5"/></svg>
                                        <span>Guru Pengampu</span>
                                    </dt>
                                    <dd class="font-bold text-slate-800 text-right truncate max-w-[160px]">
                                        {{ $classroom->teacher?->user?->name ?? 'Belum Ditentukan' }}
                                    </dd>
                                </div>

                                <div class="flex items-center justify-between gap-2 pt-2.5">
                                    <dt class="flex items-center gap-2 font-semibold text-slate-500">
                                        <svg class="h-4 w-4 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        <span>No. Ruang / Sesi</span>
                                    </dt>
                                    <dd class="font-bold text-slate-800 text-right truncate max-w-[160px]">
                                        {{ $classroom->section ?: 'Ruang Kelas' }}
                                    </dd>
                                </div>

                                <div class="flex items-center justify-between gap-2 pt-2.5">
                                    <dt class="flex items-center gap-2 font-semibold text-slate-500">
                                        <svg class="h-4 w-4 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        <span>Jumlah Siswa</span>
                                    </dt>
                                    <dd class="font-bold text-slate-800">
                                        {{ $classroom->students_count ?? $classroom->students->count() }} Siswa
                                    </dd>
                                </div>

                                <div class="flex items-center justify-between gap-2 pt-2.5">
                                    <dt class="flex items-center gap-2 font-semibold text-slate-500">
                                        <svg class="h-4 w-4 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        <span>Materi & Tugas</span>
                                    </dt>
                                    <dd class="font-bold text-slate-800">
                                        {{ $classroom->materials_count ?? $classroom->materials->count() }} Materi · {{ $classroom->assignments_count ?? $classroom->assignments->count() }} Tugas
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        
                        <!-- Footer Tombol Aksi -->
                        <div class="border-t border-slate-100 bg-slate-50/70 p-4 flex gap-2">
                            <a href="{{ route('guru.kelas.learning', $classroom) }}" class="flex-1 rounded-2xl bg-teal-600 border border-teal-700 px-4 py-2.5 text-center text-xs font-black text-white shadow-2xs transition-all hover:bg-teal-700">
                                Masuk Pembelajaran
                            </a>
                            @if ($classroom->online_meeting_url ?? $schedule?->online_meeting_url)
                                <a href="{{ $classroom->online_meeting_url ?? $schedule?->online_meeting_url }}" target="_blank" rel="noopener noreferrer" title="Buka Kelas Online" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-2xl border border-teal-200 bg-white text-teal-700 shadow-2xs hover:bg-teal-50 transition">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-white/80 px-5 py-12 text-center text-xs font-bold text-slate-400 md:col-span-2 lg:col-span-3">
                        Belum ada kelas yang ditugaskan oleh Admin kepada Anda.
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>