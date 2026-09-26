<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Siswa | Cakrawala Educentre</title>
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

<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <div
        class="mx-auto flex min-h-screen w-full max-w-3xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">
        <!-- Header Halaman -->
        <div class="flex items-center justify-between pt-2">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">
                    {{ $assignment->classroom?->name ?? 'Penilaian Tugas' }}
                </p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Input Nilai Siswa
                </h1>
            </div>
            <a href="{{ route('guru.koreksi.tugas') }}"
                class="rounded-xl border-2 border-slate-300 bg-white px-4 py-2.5 text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">Kembali</a>
        </div>

        @if($errors->any())
            <div class="p-4 bg-rose-50 border-2 border-rose-300 text-rose-800 rounded-2xl text-xs font-bold space-y-1">
                @foreach ($errors->all() as $err)
                    <p>• {{ $err }}</p>
                @endforeach
            </div>
        @endif

        <!-- Kartu Identitas Siswa -->
        <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 flex items-center space-x-4">
            <div
                class="w-12 h-12 rounded-xl bg-indigo-100 border-2 border-indigo-300 text-indigo-800 font-extrabold text-sm flex items-center justify-center flex-shrink-0">
                {{ strtoupper(substr($student?->user?->name ?? 'S', 0, 2)) }}
            </div>
            <div class="space-y-0.5 min-w-0">
                <h3 class="text-base font-extrabold text-slate-900 truncate">{{ $student?->user?->name ?? 'Siswa' }}
                </h3>
                <p class="text-xs text-slate-600 font-semibold truncate">NISN: {{ $student?->nisn ?? '-' }} • Kelas
                    {{ $assignment->classroom?->name ?? '-' }}
                </p>
            </div>
        </div>

        <!-- Form Kontainer Utama -->
        <form action="{{ route('guru.input-nilai.store', $submission) }}" method="POST"
            class="space-y-5 rounded-2xl border-2 border-slate-300 bg-white p-6 shadow-sm sm:p-8">
            @csrf

            <!-- Section: Informasi Tugas -->
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 space-y-1">
                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">Judul Tugas</span>
                <h4 class="text-sm font-extrabold text-slate-900">{{ $assignment->title }}</h4>
                @if($assignment->description)
                    <p class="text-xs text-slate-600 font-medium">{{ $assignment->description }}</p>
                @endif
            </div>

            <!-- Section: Jawaban / Catatan Siswa -->
            @if($submission->submission_text)
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Teks Jawaban /
                        Catatan Siswa</label>
                    <div
                        class="bg-slate-50 rounded-xl border-2 border-slate-300 p-4 text-xs sm:text-sm font-medium text-slate-800 leading-relaxed whitespace-pre-line">
                        {{ $submission->submission_text }}
                    </div>
                </div>
            @endif

            <!-- Section: Tugas Siswa (File Lampiran) -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Berkas Tugas
                    Siswa</label>
                @if($submission->file_path)
                    <div
                        class="bg-slate-50 rounded-xl border-2 border-slate-300 p-4 flex items-center justify-between space-x-3 hover:border-indigo-600 transition-all">
                        <div class="flex items-center space-x-3.5 min-w-0">
                            <div
                                class="w-10 h-10 rounded-xl bg-rose-100 border border-rose-300 text-rose-700 flex items-center justify-center flex-shrink-0 font-extrabold text-xs">
                                FILE
                            </div>
                            <div class="space-y-0.5 truncate">
                                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">
                                    {{ basename($submission->file_path) }}
                                </h4>
                                <p class="text-xs text-slate-500 font-semibold">Diserahkan pada
                                    {{ $submission->submitted_at?->format('d M Y, H:i') }} WIB
                                </p>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
                            class="text-xs font-extrabold text-indigo-600 hover:underline shrink-0 px-3 py-1.5 bg-indigo-50 border border-indigo-200 rounded-lg">
                            Unduh / Buka
                        </a>
                    </div>
                @else
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 text-xs text-slate-500 font-semibold">
                        Siswa tidak melampirkan berkas (hanya pengumpulan teks/jawaban langsung).
                    </div>
                @endif
            </div>

            <!-- Section: Beri Nilai (Skala 100) -->
            <div class="space-y-1.5">
                <label for="score" class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Beri
                    Nilai (Skala 100) *</label>
                <input type="number" id="score" name="score" min="0" max="100" step="0.1" required
                    value="{{ old('score', $submission->score) }}" placeholder="Misal: 85"
                    class="w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-sm sm:text-base font-extrabold text-indigo-700 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                @error('score')
                    <p class="text-xs font-bold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Section: Catatan Guru / Umpan Balik -->
            <div class="space-y-1.5">
                <label for="feedback"
                    class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Catatan Guru / Umpan
                    Balik</label>
                <textarea id="feedback" name="feedback" rows="4"
                    placeholder="Berikan masukan atau apresiasi hasil kerja siswa..."
                    class="w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all resize-none leading-relaxed">{{ old('feedback', $submission->feedback) }}</textarea>
                @error('feedback')
                    <p class="text-xs font-bold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi Utama -->
            <div class="pt-3">
                <button type="submit"
                    class="w-full py-4 bg-indigo-600 border border-indigo-700 hover:bg-indigo-700 text-white font-extrabold text-xs sm:text-sm rounded-xl shadow-md transition-all flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Simpan & Kirim Penilaian Siswa</span>
                </button>
            </div>
        </form>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>

</html>