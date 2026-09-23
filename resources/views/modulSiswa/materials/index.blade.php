<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Belajar & Bank Soal | Cakrawala Educentre</title>
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

<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2 border-b border-slate-200 pb-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-bold mb-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                    Bank Materi & Soal Terintegrasi
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                    <span>Modul Belajar & Bank Soal</span>
                    <span>📖</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 font-medium mt-1">
                    Pelajari materi kurikulum terpadu, video pembahasan tutor, dan latihan soal persiapan ujian sekolah serta SNBT.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('siswa.tryout') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-600/20 transition-all">
                    <span>Buka Tryout CBT</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <!-- Section 1: Modul & Bahan Ajar Digital -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <span>Modul Pembelajaran & Video Tutor</span>
                </h2>
                <span class="text-xs font-semibold text-slate-500">{{ $materials->count() }} Modul Tersedia</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @forelse ($materials as $material)
                    <div class="bg-white rounded-2xl border-2 border-slate-200 p-6 flex flex-col justify-between hover:border-indigo-600 hover:shadow-md transition-all space-y-4">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-black border border-indigo-200 uppercase">
                                    {{ $material->subject }}
                                </span>
                                <span class="text-xs font-semibold text-slate-400">
                                    {{ $material->published_at?->format('d M Y') ?? 'Terbit' }}
                                </span>
                            </div>

                            <h3 class="text-base font-extrabold text-slate-900 leading-snug">
                                {{ $material->title }}
                            </h3>

                            <p class="text-xs text-slate-600 leading-relaxed">
                                {{ $material->summary ?: 'Ringkasan materi lengkap telah disediakan oleh pengajar.' }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-xs">
                            <span class="text-slate-500 font-semibold">Tutor: <strong class="text-slate-700">{{ $material->teacher->user->name }}</strong></span>
                            <div class="flex items-center gap-2">
                                @if ($material->video_url)
                                    <a href="{{ $material->video_url }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Video</span>
                                    </a>
                                @endif
                                @if ($material->attachment_path)
                                    <a href="{{ Storage::disk('public')->url($material->attachment_path) }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        <span>Unduh modul</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 rounded-2xl border-2 border-dashed border-slate-300 bg-white p-10 text-center text-xs font-semibold text-slate-500">
                        Belum ada modul yang diterbitkan saat ini.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Section 2: Bank Soal & Tugas Latihan Mandiri -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Tugas Latihan -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <span>Tugas dari guru</span>
                    </h2>
                    <a href="{{ route('siswa.tugas') }}#tugas" class="text-xs font-bold text-indigo-600 hover:underline">Kerjakan</a>
                </div>

                <div class="space-y-3">
                    @forelse ($assignments as $assignment)
                        <div class="bg-white rounded-2xl border-2 border-slate-200 p-5 space-y-2 hover:border-indigo-600 transition-all">
                            <div class="flex items-center justify-between">
                                <span class="px-2 py-0.5 rounded text-[10px] font-black bg-amber-50 text-amber-800 border border-amber-200">
                                    {{ $assignment->classroom->name }}
                                </span>
                                <span class="text-xs font-bold text-slate-400">Poin: {{ $assignment->points }}</span>
                            </div>
                            <h3 class="text-sm font-extrabold text-slate-900">{{ $assignment->title }}</h3>
                            <p class="text-xs text-slate-500 line-clamp-2">{{ $assignment->instructions }}</p>
                            <div class="pt-2 flex items-center justify-between text-xs">
                                <span class="text-slate-400">Tenggat: {{ $assignment->due_at ? $assignment->due_at->format('d M, H:i') : 'Fleksibel' }}</span>
                                <a href="{{ route('siswa.tugas') }}" class="font-bold text-indigo-600 hover:text-indigo-800">Detail & Kumpul &rarr;</a>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-white p-6 text-center text-xs text-slate-400">
                            Tidak ada penugasan aktif.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Kuis Evaluasi Singkat -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <span>Kuis dari guru</span>
                    </h2>
                    <a href="{{ route('siswa.tugas') }}#kuis" class="text-xs font-bold text-indigo-600 hover:underline">Semua</a>
                </div>

                <div class="space-y-3">
                    @forelse ($quizzes as $quiz)
                        <div class="bg-white rounded-2xl border-2 border-slate-200 p-5 space-y-2 hover:border-indigo-600 transition-all">
                            <div class="flex items-center justify-between">
                                <span class="px-2 py-0.5 rounded text-[10px] font-black bg-sky-50 text-sky-800 border border-sky-200">
                                    {{ $quiz->classroom->name }}
                                </span>
                                <span class="text-xs font-bold text-slate-500">{{ $quiz->duration_minutes }} Menit</span>
                            </div>
                            <h3 class="text-sm font-extrabold text-slate-900">{{ $quiz->title }}</h3>
                            <p class="text-xs text-slate-500">{{ $quiz->question_count }} Soal Pilihan Ganda · Passing Score {{ $quiz->passing_score }}</p>
                            <div class="pt-2 flex items-center justify-between text-xs">
                                <span class="text-emerald-700 font-bold">Auto Grading</span>
                                <a href="{{ route('siswa.pengerjaan', $quiz) }}" class="font-bold text-indigo-600 hover:text-indigo-800">Mulai Kuis &rarr;</a>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-white p-6 text-center text-xs text-slate-400">
                            Tidak ada kuis aktif saat ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>

</html>
