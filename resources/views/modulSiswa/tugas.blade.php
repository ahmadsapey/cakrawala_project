<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas | Cakrawala Educentre</title>
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
    <div
        class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2 space-y-1">
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Tugas & Evaluasi</h1>
            <p class="text-xs text-slate-600 font-semibold">Kerjakan tugas tepat waktu dan evaluasi hasil belajarmu.</p>
        </div>

        @if (session('success'))
            <div
                class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-bold text-emerald-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tab Navigasi (Tugas Aktif / Kuis Evaluasi) -->
        <div class="bg-slate-200 p-1.5 rounded-2xl flex items-center space-x-1 border-2 border-slate-300">
            <a href="#tugas"
                class="flex-1 py-2.5 bg-white text-indigo-700 font-extrabold text-xs rounded-xl shadow-sm border border-slate-200 transition-all text-center">Tugas
                Aktif</a>
            <a href="#kuis"
                class="flex-1 py-2.5 text-slate-600 font-bold text-xs rounded-xl hover:bg-white/50 transition-all text-center">Kuis
                Evaluasi</a>
        </div>

        <!-- Statistik Kartu Ringkasan -->
        <div class="grid grid-cols-2 gap-4">
            <div
                class="bg-white p-5 rounded-2xl border-2 border-slate-200 shadow-sm flex flex-col justify-between space-y-2">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Tugas Aktif</span>
                <div class="flex items-baseline space-x-2">
                    <span
                        class="text-3xl font-extrabold text-slate-900">{{ sprintf('%02d', $assignments->count()) }}</span>
                    <span
                        class="px-2.5 py-1 bg-amber-100 border border-amber-300 text-amber-800 font-bold text-xs rounded-md">Tugas</span>
                </div>
            </div>
            <div
                class="bg-white p-5 rounded-2xl border-2 border-slate-200 shadow-sm flex flex-col justify-between space-y-2">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Kuis Aktif</span>
                <div class="flex items-baseline space-x-2">
                    <span class="text-3xl font-extrabold text-slate-900">{{ sprintf('%02d', $quizzes->count()) }}</span>
                    <span
                        class="px-2.5 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 font-bold text-xs rounded-md">Kuis</span>
                </div>
            </div>
        </div>

        <!-- Bagian Daftar Tugasmu -->
        <div id="tugas" class="space-y-4 scroll-mt-24">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Daftar Tugasmu</h3>
            </div>

            @forelse ($assignments as $assignment)
                @php
                    $submission = $assignmentSubmissions[$assignment->id] ?? null;
                @endphp
                <div
                    class="bg-white p-5 sm:p-6 rounded-2xl border-2 border-slate-200 shadow-sm space-y-4 hover:border-indigo-600 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <span
                            class="px-3 py-1 bg-indigo-100 border border-indigo-300 text-indigo-700 font-extrabold text-xs rounded-lg">
                            {{ $assignment->classroom?->name ?? 'Kelas' }}
                        </span>
                        <div class="flex items-center gap-2">
                            @if ($submission && $submission->status === 'graded')
                                <span
                                    class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 font-extrabold text-xs rounded-lg">
                                    Nilai: {{ $submission->score }}/{{ $assignment->points }}
                                </span>
                            @elseif ($submission)
                                <span
                                    class="px-3 py-1 bg-amber-100 border border-amber-300 text-amber-800 font-extrabold text-xs rounded-lg">
                                    Menunggu Koreksi
                                </span>
                            @else
                                <span
                                    class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-700 font-extrabold text-xs rounded-lg">
                                    {{ $assignment->due_at ? 'Tenggat: ' . $assignment->due_at->format('d M Y') : 'Tanpa tenggat' }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-1">
                        <h4 class="text-sm sm:text-base font-extrabold text-slate-900">{{ $assignment->title }}</h4>
                        <p class="text-xs text-slate-600 font-medium leading-relaxed">{{ $assignment->instructions }}</p>
                        @if ($submission && $submission->feedback)
                            <div class="mt-2 rounded-xl bg-indigo-50/70 border border-indigo-100 p-3 text-xs text-indigo-900">
                                <span class="font-extrabold">Catatan Guru:</span> {{ $submission->feedback }}
                            </div>
                        @endif
                    </div>

                    <!-- Accordion Form Pengumpulan Tugas -->
                    <details class="group rounded-xl border border-slate-200 bg-slate-50/50 p-3 transition">
                        <summary
                            class="flex cursor-pointer items-center justify-between text-xs font-extrabold text-indigo-600 list-none">
                            <span>{{ $submission ? 'Perbarui Pengumpulan Tugas' : 'Kumpulkan Tugas Ini' }}</span>
                            <span class="transition-transform group-open:rotate-180">&darr;</span>
                        </summary>
                        <form method="POST" action="{{ route('siswa.tugas.submit', $assignment) }}"
                            enctype="multipart/form-data" class="mt-3 space-y-3 pt-3 border-t border-slate-200">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold text-slate-700">Catatan / Jawaban Teks:</label>
                                <textarea name="submission_text" rows="2" placeholder="Tulis catatan pengerjaan di sini..."
                                    class="mt-1 w-full rounded-xl border border-slate-300 p-2.5 text-xs font-medium text-slate-800 focus:border-indigo-600 focus:outline-none">{{ old('submission_text', $submission?->submission_text) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700">Unggah Berkas (PDF, DOCX, Gambar max
                                    10MB):</label>
                                <input type="file" name="file"
                                    class="mt-1 block w-full text-xs text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-3 file:py-1.5 file:text-xs file:font-extrabold file:text-indigo-700 hover:file:bg-indigo-100">
                                @if ($submission && $submission->file_name)
                                    <p class="mt-1 text-[11px] font-semibold text-emerald-600">Berkas terunggah:
                                        {{ $submission->file_name }}
                                    </p>
                                @endif
                            </div>
                            <button type="submit"
                                class="w-full rounded-xl bg-indigo-600 px-4 py-2 text-xs font-extrabold text-white shadow-md hover:bg-indigo-700 transition">
                                {{ $submission ? 'Simpan Perubahan' : 'Kirim Tugas Sekarang' }}
                            </button>
                        </form>
                    </details>
                </div>
            @empty
                <div
                    class="rounded-2xl border-2 border-dashed border-slate-300 bg-white px-5 py-10 text-center text-xs font-semibold text-slate-400">
                    Belum ada tugas yang diterbitkan.
                </div>
            @endforelse
        </div>

        <!-- Bagian Daftar Kuis Evaluasi -->
        <div id="kuis" class="space-y-4 scroll-mt-24 pt-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Daftar Kuis Evaluasi</h3>
            </div>

            @forelse ($quizzes as $quiz)
                @php
                    $quizSub = $quizSubmissions[$quiz->id] ?? null;
                @endphp
                <div
                    class="bg-white p-5 sm:p-6 rounded-2xl border-2 border-slate-200 shadow-sm space-y-4 hover:border-indigo-600 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <span
                            class="px-3 py-1 bg-amber-100 border border-amber-300 text-amber-800 font-extrabold text-xs rounded-lg">
                            {{ $quiz->classroom?->name ?? 'Kelas' }}
                        </span>
                        @if ($quizSub)
                            <span
                                class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 font-extrabold text-xs rounded-lg">
                                Skor: {{ $quizSub->score }}
                            </span>
                        @else
                            <span
                                class="px-3 py-1 bg-slate-100 border border-slate-300 text-slate-700 font-extrabold text-xs rounded-lg">
                                {{ $quiz->due_at ? 'Tenggat: ' . $quiz->due_at->format('d M Y') : 'Tanpa tenggat' }}
                            </span>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <h4 class="text-sm sm:text-base font-extrabold text-slate-900">{{ $quiz->title }}</h4>
                        <p class="text-xs text-slate-600 font-medium leading-relaxed">
                            {{ $quiz->question_count ?? 10 }} Soal • Durasi {{ $quiz->duration_minutes ?? 30 }} Menit • KKM
                            {{ $quiz->passing_score ?? 75 }}
                        </p>
                    </div>

                    <div class="pt-3 border-t-2 border-slate-200 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">Pilihan Ganda</span>
                        <div class="flex items-center gap-2">
                            @if ($quizSub)
                                <a href="{{ route('siswa.evaluasi', $quizSub) }}"
                                    class="px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-xl text-xs font-extrabold transition-all inline-block border border-indigo-200">
                                    Lihat Hasil
                                </a>
                                <a href="{{ route('siswa.pengerjaan', $quiz) }}"
                                    class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-extrabold transition-all inline-block">
                                    Ulangi
                                </a>
                            @else
                                <a href="{{ route('siswa.pengerjaan', $quiz) }}"
                                    class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 border border-amber-600 text-white rounded-xl text-xs font-extrabold shadow-md transition-all inline-block">
                                    Mulai Kuis
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="rounded-2xl border-2 border-dashed border-slate-300 bg-white px-5 py-10 text-center text-xs font-semibold text-slate-400">
                    Belum ada kuis yang diterbitkan.
                </div>
            @endforelse
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>

</html>