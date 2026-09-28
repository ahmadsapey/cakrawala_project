<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa {{ $classroom?->name }} | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        branddark: '#0B0F19',
                    }
                }
            }
        }
    </script>
    @include('components.fonts')
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24 md:pb-0">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto min-h-screen w-full max-w-7xl space-y-6 px-4 py-6 sm:px-6 md:space-y-8 md:px-8 lg:px-12">
        <section class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-xs font-bold text-indigo-600">
                    <a href="{{ route('guru.home') }}" class="hover:text-indigo-700">Beranda</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-400">Daftar Siswa</span>
                </div>
                <h1 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">Daftar Siswa Kelas</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola absensi dan nilai siswa dalam satu halaman.</p>
            </div>
            <a href="{{ route('guru.kelas') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-slate-300 bg-white px-4 py-2.5 text-xs font-extrabold text-slate-700 shadow-sm transition-colors hover:border-indigo-600 hover:text-indigo-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Kelas
            </a>
        </section>

        <!-- Banner Kelas -->
        <section class="rounded-2xl border-2 border-indigo-700 bg-indigo-600 p-5 text-white shadow-md sm:p-6">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <div class="mb-2 flex flex-wrap items-center gap-2">
                        <span class="rounded-lg bg-white/20 border border-white/30 px-3 py-1 text-[10px] font-extrabold uppercase tracking-wider text-white">Kurikulum Merdeka</span>
                        <span class="rounded-lg bg-emerald-400/30 border border-emerald-300/40 px-3 py-1 text-[10px] font-extrabold uppercase tracking-wider text-emerald-100">Aktif</span>
                    </div>
                    <h2 class="text-lg font-extrabold sm:text-xl">{{ $classroom?->name ?? 'Kelas Binaan' }}: {{ $classroom?->subject ?? 'Mata Pelajaran' }}</h2>
                    <p class="mt-1 text-xs font-semibold text-indigo-100">Tahun Ajaran 2026/2027 • Semester Ganjil</p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-6 lg:min-w-[360px]">
                    <div class="border-r-2 border-indigo-400/50 pr-3">
                        <p class="text-2xl font-extrabold">{{ $students->count() }}</p>
                        <p class="text-xs text-indigo-100 font-semibold">Total siswa</p>
                    </div>
                    <div class="border-r-2 border-indigo-400/50 pr-3">
                        <p class="text-2xl font-extrabold text-emerald-300">{{ $students->count() }}</p>
                        <p class="text-xs text-indigo-100 font-semibold">Terdaftar</p>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-amber-300">0</p>
                        <p class="text-xs text-indigo-100 font-semibold">Terkendala</p>
                    </div>
                </div>
            </div>
        </section>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-2 border-emerald-300 text-emerald-800 rounded-2xl text-xs sm:text-sm font-bold flex items-center space-x-2 shadow-sm">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Daftar Siswa Table -->
        <form method="POST" action="{{ route('guru.kelas.absensi', $classroom) }}" class="overflow-hidden rounded-2xl border-2 border-slate-300 bg-white shadow-sm">
            @csrf
            <div class="flex flex-col gap-4 border-b-2 border-slate-300 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6 bg-slate-50">
                <div>
                    <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-wider">Semua Siswa Terdaftar</h2>
                    <p class="mt-1 text-xs font-semibold text-slate-600">Pilih status kehadiran dan kelola nilai setiap siswa.</p>
                </div>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <button type="submit" class="rounded-xl bg-indigo-600 border border-indigo-700 px-5 py-2.5 text-xs font-extrabold text-white shadow-md transition hover:bg-indigo-700">Simpan Absensi</button>
                </div>
            </div>

            <!-- Desktop View -->
            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[760px] text-left border-collapse border-2 border-slate-300">
                    <thead class="bg-slate-100 text-xs font-extrabold uppercase tracking-wider text-slate-800 border-b-2 border-slate-300">
                        <tr>
                            <th class="px-6 py-4 border-r border-slate-200">Siswa</th>
                            <th class="px-4 py-4 border-r border-slate-200">Status Absensi</th>
                            <th class="px-4 py-4 border-r border-slate-200">Nilai Terakhir</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-slate-200 bg-white">
                        @forelse ($students as $student)
                            @php
                                $lastScore = $student->assignmentSubmissions->first()?->score ?? $student->quizSubmissions->first()?->score;
                                $submissionToGrade = $student->assignmentSubmissions->first();
                            @endphp
                            <tr class="transition-colors hover:bg-slate-50">
                                <td class="px-6 py-4 border-r border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 text-xs font-extrabold shrink-0">
                                            {{ strtoupper(substr($student->user?->name ?? 'S', 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-extrabold text-slate-900">{{ $student->user?->name ?? 'Siswa' }}</p>
                                            <p class="text-xs font-medium text-slate-500">NISN: {{ $student->nisn ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 border-r border-slate-200">
                                    <select name="attendance[{{ $student->id }}]" class="rounded-xl border-2 border-slate-300 bg-white px-3 py-2 text-xs font-bold text-slate-900 outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20">
                                        <option value="Hadir" selected>Hadir</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Alpa">Alpa</option>
                                    </select>
                                </td>
                                <td class="px-4 py-4 border-r border-slate-200">
                                    <span class="text-sm font-extrabold {{ $lastScore === null ? 'text-slate-400' : 'text-indigo-700' }}">
                                        {{ $lastScore !== null ? number_format($lastScore, 0) : '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end">
                                        @if($submissionToGrade)
                                            <a href="{{ route('guru.input-nilai', $submissionToGrade) }}" class="inline-flex items-center gap-2 rounded-xl border-2 border-indigo-200 bg-indigo-50 px-3.5 py-2 text-xs font-extrabold text-indigo-700 transition hover:bg-indigo-600 hover:text-white">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-1-1v2m-4.5 5.5 8-8a2.121 2.121 0 0 1 3 3l-8 8L7 15l.5-3.5Z"/></svg>
                                                {{ $submissionToGrade->status === 'graded' ? 'Edit Nilai' : 'Input Nilai' }}
                                            </a>
                                        @else
                                            <a href="{{ route('guru.koreksi.tugas') }}" class="inline-flex items-center gap-2 rounded-xl border-2 border-slate-200 bg-slate-50 px-3.5 py-2 text-xs font-extrabold text-slate-600 transition hover:bg-indigo-600 hover:text-white">
                                                Lihat Tugas
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-xs font-bold text-slate-500">
                                    Belum ada siswa yang terdaftar di kelas ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile View -->
            <div class="space-y-3 p-4 md:hidden">
                @forelse ($students as $student)
                    @php
                        $lastScore = $student->assignmentSubmissions->first()?->score ?? $student->quizSubmissions->first()?->score;
                        $submissionToGrade = $student->assignmentSubmissions->first();
                    @endphp
                    <article class="rounded-2xl border-2 border-slate-300 p-4 shadow-sm bg-white space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 border border-indigo-300 text-xs font-extrabold text-indigo-700">
                                    {{ strtoupper(substr($student->user?->name ?? 'S', 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="text-sm font-extrabold text-slate-900">{{ $student->user?->name ?? 'Siswa' }}</h3>
                                    <p class="text-xs font-medium text-slate-500">NISN: {{ $student->nisn ?? '-' }}</p>
                                </div>
                            </div>
                            <span class="text-sm font-extrabold text-indigo-600">{{ $lastScore !== null ? number_format($lastScore, 0) : '-' }}</span>
                        </div>
                        <div class="mt-4 flex items-center gap-2">
                            <select name="attendance_mobile[{{ $student->id }}]" class="min-w-0 flex-1 rounded-xl border-2 border-slate-300 bg-white px-3 py-2 text-xs font-bold text-slate-900 outline-none">
                                <option value="Hadir" selected>Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Alpa">Alpa</option>
                            </select>
                            @if($submissionToGrade)
                                <a href="{{ route('guru.input-nilai', $submissionToGrade) }}" class="rounded-xl bg-indigo-600 border border-indigo-700 px-4 py-2 text-xs font-extrabold text-white">Input Nilai</a>
                            @else
                                <a href="{{ route('guru.koreksi.tugas') }}" class="rounded-xl bg-slate-200 px-4 py-2 text-xs font-extrabold text-slate-700">Lihat Tugas</a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="p-6 text-center text-xs font-bold text-slate-500">
                        Belum ada siswa yang terdaftar di kelas ini.
                    </div>
                @endforelse
            </div>
        </form>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>
