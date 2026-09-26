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
    @include('components.fonts')
</head>

<body class="bg-gradient-to-br from-indigo-50/50 via-sky-50/30 to-purple-50/50 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-8 p-4 sm:p-6 md:space-y-10 md:p-8 lg:px-12">

        <!-- Header Halaman dengan Gradien Modern -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 p-8 text-white shadow-xl">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/15 blur-2xl"></div>
            <div class="relative z-10 space-y-2">
                <span class="inline-block rounded-full bg-white/20 px-3.5 py-1 text-xs font-bold uppercase tracking-widest backdrop-blur-md">Evaluasi Belajar</span>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight">
                    Tugas & Evaluasi
                </h1>
                <p class="text-xs sm:text-sm font-medium text-indigo-100">Kerjakan tugas pembelajaran dan kumpulkan tepat waktu.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-xs font-bold text-emerald-800 shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-xs font-bold text-rose-800 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Statistik Kartu Ringkasan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="bg-gradient-to-br from-white via-amber-50/40 to-orange-100/50 p-6 rounded-3xl border border-amber-100 shadow-sm flex flex-col justify-between space-y-3 backdrop-blur-sm">
                <span class="text-xs font-extrabold text-amber-800 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-amber-500"></span> Total Tugas
                </span>
                <div class="flex items-baseline space-x-3">
                    <span class="text-3xl sm:text-4xl font-black text-slate-900">{{ sprintf('%02d', $assignments->count()) }}</span>
                    <span class="px-3 py-1 bg-amber-500 text-white font-extrabold text-xs rounded-xl shadow-xs">Tugas</span>
                </div>
            </div>
            <div class="bg-gradient-to-br from-white via-emerald-50/40 to-teal-100/50 p-6 rounded-3xl border border-emerald-100 shadow-sm flex flex-col justify-between space-y-3 backdrop-blur-sm">
                <span class="text-xs font-extrabold text-emerald-800 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Tugas Dikumpulkan
                </span>
                <div class="flex items-baseline space-x-3">
                    <span class="text-3xl sm:text-4xl font-black text-slate-900">{{ sprintf('%02d', count($assignmentSubmissions)) }}</span>
                    <span class="px-3 py-1 bg-emerald-500 text-white font-extrabold text-xs rounded-xl shadow-xs">Selesai</span>
                </div>
            </div>
        </div>

        <!-- Bagian Daftar Tugasmu -->
        <div id="tugas" class="space-y-5 scroll-mt-28">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <span class="h-3 w-3 rounded-full bg-amber-500"></span> Daftar Tugasmu
                </h3>
            </div>

            <div class="space-y-4">
                @forelse ($assignments as $assignment)
                    @php
                        $submission = $assignmentSubmissions[$assignment->id] ?? null;
                    @endphp
                    <div class="bg-gradient-to-br from-white via-amber-50/20 to-orange-50/30 p-6 rounded-3xl border border-amber-100 shadow-sm space-y-5 hover:border-amber-400 hover:shadow-xl transition-all duration-300 backdrop-blur-sm">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <span class="px-3.5 py-1.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-black text-xs rounded-xl shadow-xs">
                                {{ $assignment->classroom?->name ?? 'Kelas' }}
                            </span>
                            <div class="flex items-center gap-2">
                                @if ($submission && $submission->status === 'graded')
                                    <span class="px-3.5 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 font-extrabold text-xs rounded-xl shadow-2xs">
                                        Nilai: {{ $submission->score }}/{{ $assignment->points }}
                                    </span>
                                @elseif ($submission)
                                    <span class="px-3.5 py-1.5 bg-amber-50 border border-amber-200 text-amber-700 font-extrabold text-xs rounded-xl shadow-2xs">
                                        Menunggu Koreksi
                                    </span>
                                @else
                                    <span class="px-3.5 py-1.5 bg-slate-100 border border-slate-200 text-slate-600 font-extrabold text-xs rounded-xl shadow-2xs">
                                        {{ $assignment->due_at ? 'Tenggat: ' . $assignment->due_at->format('d M Y') : 'Tanpa tenggat' }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2">
                            <h4 class="text-base sm:text-lg font-black text-slate-900">{{ $assignment->title }}</h4>
                            <p class="text-xs sm:text-sm text-slate-600 font-medium leading-relaxed">{{ $assignment->instructions }}</p>
                            @if ($submission && $submission->feedback)
                                <div class="mt-3 rounded-2xl bg-indigo-50/80 border border-indigo-200 p-4 text-xs text-indigo-900 backdrop-blur-sm shadow-2xs">
                                    <span class="font-extrabold text-indigo-700">Catatan Guru:</span> {{ $submission->feedback }}
                                </div>
                            @endif
                        </div>

                        <!-- Accordion Form Pengumpulan Tugas -->
                        <details class="group rounded-2xl border border-amber-200/60 bg-white/80 p-4 transition shadow-2xs">
                            <summary class="flex cursor-pointer items-center justify-between text-xs font-black text-amber-700 list-none">
                                <span class="flex items-center gap-2">
                                    {{ $submission ? 'Perbarui Pengumpulan Tugas' : 'Kumpulkan Tugas Ini' }}
                                </span>
                                <span class="transition-transform duration-300 group-open:rotate-180 bg-amber-100 p-1 rounded-lg text-amber-800">&darr;</span>
                            </summary>
                            <form method="POST" action="{{ route('siswa.tugas.submit', $assignment) }}"
                                enctype="multipart/form-data" class="mt-4 space-y-4 pt-4 border-t border-amber-100">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Catatan / Jawaban Teks:</label>
                                    <textarea name="submission_text" rows="3" placeholder="Tulis catatan pengerjaan di sini..."
                                        class="w-full rounded-2xl border border-slate-200 p-3 text-xs font-medium text-slate-800 bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 focus:outline-none transition-all">{{ old('submission_text', $submission?->submission_text) }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Unggah Berkas (PDF, DOCX, Gambar maks 10MB):</label>
                                    <input type="file" name="file"
                                        class="w-full text-xs text-slate-500 file:mr-3 file:rounded-xl file:border-0 file:bg-amber-50 file:px-4 file:py-2 file:text-xs file:font-extrabold file:text-amber-700 hover:file:bg-amber-100 transition-colors">
                                    @if ($submission && $submission->file_name)
                                        <p class="mt-2 text-xs font-bold text-emerald-600 flex items-center gap-1">
                                            Berkas terunggah: {{ $submission->file_name }}
                                        </p>
                                    @endif
                                </div>
                                <button type="submit"
                                    class="w-full rounded-2xl bg-gradient-to-r from-amber-500 to-orange-500 px-5 py-3 text-xs font-black text-white shadow-md hover:shadow-lg hover:from-amber-600 hover:to-orange-600 transition-all">
                                    {{ $submission ? 'Simpan Perubahan' : 'Kirim Tugas Sekarang' }}
                                </button>
                            </form>
                        </details>
                    </div>
                @empty
                    <div class="rounded-3xl border-2 border-dashed border-amber-200 bg-white/60 backdrop-blur-sm px-5 py-12 text-center text-xs font-semibold text-slate-400">
                        Belum ada tugas yang diterbitkan.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>

</html>