<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Guru | Cakrawala Educentre</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0D9488', // Diubah dari Indigo ke Teal/Emerald
                        branddark: '#0F172A',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-teal-50/50 via-slate-50 to-emerald-50/40 text-slate-800 font-sans antialiased selection:bg-teal-500 selection:text-white pb-28">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Profil Guru -->
        <div class="flex items-center justify-between pt-2">
            <div class="flex items-center space-x-3.5">
                <div class="w-12 h-12 rounded-2xl bg-teal-100 border-2 border-teal-600 text-teal-800 flex items-center justify-center font-black text-base shadow-xs">
                    {{ strtoupper(substr($teacherName, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center space-x-2">
                        <h1 class="text-lg sm:text-xl font-black text-slate-900 tracking-tight">Halo, {{ $teacherName }}!</h1>
                        <span class="text-xs" title="Tutor Utama">👨‍🏫</span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 font-bold">Tutor Utama • Bidang {{ $teacherSubject }}</p>
                </div>
            </div>
            <a href="{{ route('guru.material.create') }}" class="hidden sm:inline-flex items-center gap-1.5 rounded-xl bg-teal-600 px-4 py-2.5 text-xs font-black text-white shadow-md hover:bg-teal-700 transition">
                <span>+</span> Tambah Materi
            </a>
        </div>

        <!-- Kartu Ringkasan Mengajar Pekan Ini -->
        <div class="bg-gradient-to-r from-teal-700 to-emerald-800 border border-teal-600 rounded-3xl p-6 text-white shadow-lg space-y-4">
            <div class="flex items-center justify-between relative z-10">
                <span class="text-xs font-black uppercase tracking-wider text-teal-100">Ringkasan Mengajar Pekan Ini</span>
                <span class="text-xs font-black bg-white/25 px-3 py-1 rounded-xl text-white border border-white/30 backdrop-blur-xs">Semester Aktif</span>
            </div>

            <!-- Statistik Grid -->
            <div class="grid grid-cols-3 pt-4 border-t border-teal-500/50 relative z-10 text-center">
                <div class="border-r border-teal-500/50 pr-2">
                    <div class="text-xl sm:text-2xl font-black text-white">{{ $studentCount }}</div>
                    <div class="text-xs text-teal-100 font-bold truncate">Siswa Aktif</div>
                </div>
                <div class="px-2">
                    <div class="text-xl sm:text-2xl font-black text-amber-300">
                        {{ sprintf('%02d', $pendingTasksCount) }}
                    </div>
                    <div class="text-xs text-teal-100 font-bold truncate">Tugas & Kuis</div>
                </div>
                <div class="border-l border-teal-500/50 pl-2">
                    <div class="text-xl sm:text-2xl font-black text-emerald-300">{{ $classrooms->count() }}</div>
                    <div class="text-xs text-teal-100 font-bold truncate">Kelas Aktif</div>
                </div>
            </div>
        </div>

        <!-- Section: Kelas yang Diampu -->
        <div class="space-y-3">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-700">Kelas yang Diampu</h3>
                <a href="{{ route('guru.kelas') }}" class="text-xs font-black text-teal-700 hover:underline">Kelola Semua Kelas &rarr;</a>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                @forelse ($classrooms as $classroom)
                    <a href="{{ route('guru.kelas.learning', $classroom) }}" class="bg-white/85 backdrop-blur-md rounded-2xl border border-teal-100 p-5 shadow-xs space-y-3 hover:border-teal-600 hover:shadow-md transition-all block group">
                        <div class="flex items-center justify-between">
                            <span class="rounded-xl bg-teal-50 border border-teal-200 px-3 py-1 text-xs font-black uppercase tracking-wider text-teal-800">
                                {{ $classroom->subject ?? $teacherSubject }}
                            </span>
                            <span class="text-xs font-bold text-slate-600 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-xl">
                                {{ $classroom->students_count ?? 0 }} Siswa
                            </span>
                        </div>
                        <div>
                            <h4 class="text-base font-black text-slate-900 group-hover:text-teal-700 transition-colors">
                                {{ $classroom->name }}
                            </h4>
                            <p class="text-xs font-bold text-slate-500 mt-1">
                                {{ $classroom->grade_level ?? 'Umum' }}
                                {{ $classroom->section ? '• ' . $classroom->section : '' }} •
                                {{ $classroom->assignments_count ?? 0 }} Tugas • {{ $classroom->quizzes_count ?? 0 }} Kuis
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-300 bg-white/80 p-8 text-center">
                        <p class="text-xs font-bold text-slate-500">Belum ada kelas yang ditugaskan oleh Admin.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Section: Tugas yang Diterbitkan -->
        <div class="space-y-3">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-700">Tugas Terkini</h3>
                <a href="{{ route('guru.koreksi.tugas') }}" class="text-xs font-black text-teal-700 hover:underline">Kelola Tugas &rarr;</a>
            </div>

            <div class="grid gap-3">
                @forelse ($assignments as $assignment)
                    <div class="flex items-center justify-between rounded-2xl border border-teal-100 bg-white/85 p-4 shadow-xs">
                        <div>
                            <h4 class="text-sm font-black text-slate-900">{{ $assignment->title }}</h4>
                            <p class="mt-0.5 text-xs text-slate-500">{{ $assignment->classroom?->name }} • {{ $assignment->points }} Poin</p>
                        </div>
                        <a href="{{ route('guru.koreksi.tugas') }}" class="rounded-xl bg-teal-50 px-3 py-1.5 text-xs font-black text-teal-800 hover:bg-teal-100 transition">Koreksi</a>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white/60 p-6 text-center text-xs text-slate-400">
                        Belum ada tugas yang diterbitkan.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>