<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Evaluasi : {{ $quiz->title }} | Cakrawala Educentre</title>
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
    @include('components.fonts')
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2 flex items-center justify-between">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">{{ $quiz->classroom?->name ?? 'Evaluasi Kuis' }}</p>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Hasil Evaluasi Pengerjaan</h1>
            </div>
            <a href="{{ route('siswa.tugas') }}" class="px-4 py-2 bg-white border-2 border-slate-300 rounded-xl text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">
                Daftar Tugas
            </a>
        </div>

        @php
            $isPassed = $submission->score >= ($quiz->passing_score ?? 75);
            $durationMinutes = floor(($submission->duration_seconds ?? 0) / 60);
            $durationSeconds = ($submission->duration_seconds ?? 0) % 60;
        @endphp

        <!-- Kartu Utama Skor & Status Kelulusan -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl border-2 border-slate-200 shadow-sm flex flex-col items-center text-center space-y-5 relative overflow-hidden">
            <!-- Badge Status -->
            @if($isPassed)
                <span class="px-3.5 py-1.5 bg-emerald-100 border border-emerald-300 text-emerald-800 font-extrabold text-xs tracking-wider uppercase rounded-full">
                    Lulus Evaluasi
                </span>
            @else
                <span class="px-3.5 py-1.5 bg-rose-100 border border-rose-300 text-rose-800 font-extrabold text-xs tracking-wider uppercase rounded-full">
                    Belum Mencapai KKM
                </span>
            @endif

            <!-- Lingkaran Skor Akhir -->
            <div class="w-32 h-32 rounded-full {{ $isPassed ? 'bg-indigo-50 border-indigo-600 text-indigo-700' : 'bg-rose-50 border-rose-500 text-rose-700' }} border-4 flex flex-col items-center justify-center shadow-md">
                <span class="text-4xl font-extrabold tracking-tight">{{ number_format($submission->score, 0) }}</span>
                <span class="text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mt-0.5">Skor Akhir</span>
            </div>

            <!-- Ucapan Motivasi -->
            <p class="text-sm sm:text-base font-extrabold text-slate-800 max-w-md leading-relaxed">
                @if($isPassed)
                    Selamat {{ $student?->user?->name ?? 'Siswa' }}, kamu telah berhasil menyelesaikan kuis ini di atas standar KKM!
                @else
                    Semangat {{ $student?->user?->name ?? 'Siswa' }}, pelajari kembali materi terkait untuk memperdalam pemahamanmu.
                @endif
            </p>

            <!-- Statistik Singkat (Benar, Salah, Kecepatan) -->
            <div class="w-full grid grid-cols-3 gap-2 pt-5 border-t-2 border-slate-200">
                <div class="flex flex-col items-center">
                    <span class="text-xs font-extrabold text-slate-500 uppercase">Benar</span>
                    <span class="text-base font-extrabold text-emerald-700 mt-1">{{ $submission->correct_count }} Soal</span>
                </div>
                <div class="flex flex-col items-center border-x-2 border-slate-200">
                    <span class="text-xs font-extrabold text-slate-500 uppercase">Salah</span>
                    <span class="text-base font-extrabold text-rose-600 mt-1">{{ $submission->incorrect_count }} Soal</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-xs font-extrabold text-slate-500 uppercase">Waktu Tempuh</span>
                    <span class="text-base font-extrabold text-slate-800 mt-1">{{ $durationMinutes }}m {{ $durationSeconds }}s</span>
                </div>
            </div>
        </div>

        <!-- Detail Informasi Pelajaran -->
        <div class="bg-white p-5 rounded-2xl border-2 border-slate-200 shadow-sm space-y-3">
            <div class="flex items-center justify-between text-xs sm:text-sm">
                <span class="font-bold text-slate-600">Topik Pelajaran</span>
                <span class="font-extrabold text-slate-900">{{ $quiz->title }}</span>
            </div>
            <div class="flex items-center justify-between text-xs sm:text-sm">
                <span class="font-bold text-slate-600">Nama Siswa</span>
                <span class="font-extrabold text-slate-900">{{ $student?->user?->name ?? 'Siswa Cakrawala' }} (NISN: {{ $student?->nisn ?? '-' }})</span>
            </div>
            <div class="flex items-center justify-between text-xs sm:text-sm pt-2 border-t-2 border-slate-200">
                <span class="font-bold text-slate-600">Batas KKM Minimum</span>
                <span class="font-extrabold text-indigo-700">{{ $quiz->passing_score ?? 75 }} Poin</span>
            </div>
        </div>

        <!-- Bagian Review Jawaban -->
        <div class="space-y-3">
            <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider px-1">Review Jawaban Soal</h3>

            @forelse ($questions as $index => $question)
                @php
                    $myChoice = $studentAnswers[$question->id] ?? '-';
                    $correctChoice = $question->correct_answer;
                    $isCorrect = strtoupper((string) $myChoice) === strtoupper((string) $correctChoice);
                @endphp

                <div class="bg-white p-5 rounded-2xl border-2 {{ $isCorrect ? 'border-emerald-300' : 'border-rose-300' }} shadow-sm space-y-3">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-xl {{ $isCorrect ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : 'bg-rose-100 text-rose-800 border-rose-300' }} border flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5">
                                {{ $index + 1 }}
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 leading-snug">
                                    {{ $question->question_text }}
                                </h4>
                                <p class="text-xs font-bold {{ $isCorrect ? 'text-emerald-700' : 'text-rose-700' }}">
                                    {{ $isCorrect ? 'Benar' : 'Salah' }} • Pilihanmu: {{ $myChoice }} (Kunci Jawaban: {{ $correctChoice }})
                                </p>
                            </div>
                        </div>
                        <div class="w-7 h-7 rounded-full {{ $isCorrect ? 'bg-emerald-100 text-emerald-700 border-emerald-300' : 'bg-rose-100 text-rose-700 border-rose-300' }} border flex items-center justify-center shrink-0">
                            @if($isCorrect)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                            @endif
                        </div>
                    </div>

                    @if($question->explanation)
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 font-semibold space-y-0.5">
                            <span class="font-extrabold text-indigo-700 uppercase tracking-wider text-[10px]">Pembahasan:</span>
                            <p>{{ $question->explanation }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="bg-white p-6 rounded-2xl border-2 border-slate-300 text-center text-slate-500 font-bold text-xs">
                    Tidak ada butir soal untuk direview.
                </div>
            @endforelse
        </div>

        <!-- Tombol Aksi Bawah -->
        <div class="space-y-2.5 pt-2">
            <a href="{{ route('siswa.tugas') }}" class="block w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all text-center">
                Kembali ke Modul Tugas
            </a>
            <a href="{{ route('siswa.pengerjaan', $quiz) }}" class="block w-full py-3.5 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-xs rounded-2xl shadow-sm transition-all text-center">
                Ulangi Pengerjaan Kuis
            </a>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>