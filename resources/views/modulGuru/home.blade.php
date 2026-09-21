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
                        primary: '#4F46E5',
                        branddark: '#0B0F19',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <div
        class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Profil Guru -->
        <div class="flex items-center justify-between pt-2">
            <div class="flex items-center space-x-3.5">
                <div
                    class="w-12 h-12 rounded-full bg-indigo-100 border-2 border-indigo-600 text-indigo-700 flex items-center justify-center font-extrabold text-base shadow-sm">
                    {{ strtoupper(substr($teacherName, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center space-x-2">
                        <h1 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">Halo,
                            {{ $teacherName }}!</h1>
                        <span class="text-xs" title="Tutor Utama">👨‍🏫</span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 font-semibold">Tutor Utama + Bidang
                        {{ $teacherSubject }}</p>
                </div>
            </div>
            <a href="{{ route('guru.kelas.create') }}"
                class="hidden sm:inline-flex items-center gap-1.5 rounded-xl bg-indigo-600 px-4 py-2 text-xs font-extrabold text-white shadow-md hover:bg-indigo-700 transition">
                <span>+</span> Buat Kelas Baru
            </a>
        </div>

        <!-- Kartu Ringkasan Mengajar Pekan Ini -->
        <div class="bg-indigo-600 border-2 border-indigo-700 rounded-2xl p-6 text-white shadow-md space-y-4">
            <div class="flex items-center justify-between relative z-10">
                <span class="text-xs font-extrabold uppercase tracking-wider text-indigo-100">Ringkasan Mengajar Pekan
                    Ini</span>
                <span
                    class="text-xs font-extrabold bg-white/20 px-3 py-1 rounded-lg text-white border border-white/30">Semester
                    Aktif</span>
            </div>

            <!-- Statistik Grid -->
            <div class="grid grid-cols-3 pt-4 border-t-2 border-indigo-400/50 relative z-10 text-center">
                <div class="border-r-2 border-indigo-400/50 pr-2">
                    <div class="text-xl sm:text-2xl font-extrabold text-white">{{ $studentCount }}</div>
                    <div class="text-xs text-indigo-100 font-extrabold truncate">Siswa Aktif</div>
                </div>
                <div class="px-2">
                    <div class="text-xl sm:text-2xl font-extrabold text-amber-300">
                        {{ sprintf('%02d', $pendingTasksCount) }}
                    </div>
                    <div class="text-xs text-indigo-100 font-extrabold truncate">Tugas & Kuis</div>
                </div>
                <div class="border-l-2 border-indigo-400/50 pl-2">
                    <div class="text-xl sm:text-2xl font-extrabold text-emerald-300">{{ $classrooms->count() }}</div>
                    <div class="text-xs text-indigo-100 font-extrabold truncate">Kelas Aktif</div>
                </div>
            </div>
        </div>

        <!-- Section: Kelas yang Diampu -->
        <div class="space-y-3">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Kelas yang Diampu</h3>
                <a href="{{ route('guru.kelas') }}"
                    class="text-xs font-extrabold text-indigo-600 hover:underline">Kelola Semua Kelas &rarr;</a>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                @forelse ($classrooms as $classroom)
                    <a href="{{ route('guru.kelas.learning', $classroom) }}"
                        class="bg-white rounded-2xl border-2 border-slate-300 p-5 shadow-sm space-y-3 hover:border-indigo-600 transition-all block group">
                        <div class="flex items-center justify-between">
                            <span
                                class="rounded-lg bg-indigo-100 border border-indigo-300 px-3 py-1 text-xs font-extrabold uppercase tracking-wider text-indigo-800">
                                {{ $classroom->subject ?? $teacherSubject }}
                            </span>
                            <span
                                class="text-xs font-bold text-slate-600 bg-slate-100 border border-slate-300 px-2.5 py-1 rounded-lg">
                                {{ $classroom->students_count ?? 0 }} Siswa
                            </span>
                        </div>
                        <div>
                            <h4
                                class="text-base font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                {{ $classroom->name }}
                            </h4>
                            <p class="text-xs font-semibold text-slate-500 mt-1">
                                {{ $classroom->grade_level ?? 'Umum' }}
                                {{ $classroom->section ? '• ' . $classroom->section : '' }} •
                                {{ $classroom->assignments_count ?? 0 }} Tugas • {{ $classroom->quizzes_count ?? 0 }} Kuis
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-300 bg-white p-8 text-center">
                        <p class="text-xs font-semibold text-slate-500">Belum ada kelas yang dibuat.</p>
                        <a href="{{ route('guru.kelas.create') }}"
                            class="mt-3 inline-block rounded-xl bg-indigo-600 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-indigo-700 transition">Buat
                            Kelas Sekarang</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Section: Tugas & Kuis Aktif -->
        <div class="space-y-3">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Tugas & Kuis Aktif</h3>
                <div class="flex gap-2 text-xs font-bold text-indigo-600">
                    <a href="{{ route('guru.tugas.tambah') }}" class="hover:underline">+ Tugas</a>
                    <span>•</span>
                    <a href="{{ route('guru.kuis.tambah') }}" class="hover:underline">+ Kuis</a>
                </div>
            </div>

            <div class="space-y-3">
                @forelse ($assignments as $assignment)
                    <div
                        class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-4.5 flex items-center justify-between hover:border-indigo-600 transition-all">
                        <div class="flex items-center space-x-3.5">
                            <div
                                class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 border-2 border-indigo-200 font-extrabold text-sm flex items-center justify-center flex-shrink-0">
                                📝
                            </div>
                            <div class="space-y-0.5">
                                <h5 class="text-xs sm:text-sm font-extrabold text-slate-900">{{ $assignment->title }}</h5>
                                <p class="text-xs font-semibold text-slate-600">
                                    {{ $assignment->classroom?->name ?? 'Kelas' }} • Batas:
                                    {{ $assignment->due_at ? $assignment->due_at->format('d M Y') : 'Tanpa batas' }}
                                </p>
                            </div>
                        </div>
                        <span
                            class="text-xs font-extrabold bg-indigo-50 text-indigo-700 border border-indigo-200 px-3 py-1 rounded-lg flex-shrink-0">Tugas
                            ({{ $assignment->points ?? 100 }} Poin)</span>
                    </div>
                @empty
                    @if ($quizzes->isEmpty())
                        <div
                            class="rounded-2xl border-2 border-dashed border-slate-300 bg-white p-6 text-center text-xs font-semibold text-slate-400">
                            Belum ada tugas atau kuis yang dibuat.
                        </div>
                    @endif
                @endforelse

                @foreach ($quizzes as $quiz)
                    <div
                        class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-4.5 flex items-center justify-between hover:border-indigo-600 transition-all">
                        <div class="flex items-center space-x-3.5">
                            <div
                                class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 border-2 border-amber-200 font-extrabold text-sm flex items-center justify-center flex-shrink-0">
                                ⏱️
                            </div>
                            <div class="space-y-0.5">
                                <h5 class="text-xs sm:text-sm font-extrabold text-slate-900">{{ $quiz->title }}</h5>
                                <p class="text-xs font-semibold text-slate-600">
                                    {{ $quiz->classroom?->name ?? 'Kelas' }} • {{ $quiz->duration_minutes ?? 30 }} Menit •
                                    KKM: {{ $quiz->passing_score ?? 75 }}
                                </p>
                            </div>
                        </div>
                        <span
                            class="text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-lg flex-shrink-0">Kuis
                            ({{ $quiz->question_count ?? 10 }} Soal)</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</body>
@include('components.footerGuru')
@include('components.footerGuru_mobile')

</html>