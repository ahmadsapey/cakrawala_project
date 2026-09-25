<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koreksi Tugas | Cakrawala Educentre</title>
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
</head>

<body class="min-h-screen bg-gradient-to-br from-teal-50/50 via-slate-50 to-emerald-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-teal-500 selection:text-white">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <main class="mx-auto flex w-full max-w-6xl flex-col space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="rounded-2xl border-2 border-emerald-300 bg-emerald-50 px-5 py-4 text-xs sm:text-sm font-bold text-emerald-800 shadow-sm flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-2xl border-2 border-rose-300 bg-rose-50 px-5 py-4 text-xs sm:text-sm font-bold text-rose-800 shadow-sm flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pt-2">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-teal-700 bg-teal-50 border border-teal-200 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Modul Guru</span>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Koreksi & Penilaian Tugas</h1>
            </div>
            <a href="{{ route('guru.tugas.create') }}"
                class="rounded-2xl bg-gradient-to-r from-teal-600 to-emerald-700 border-2 border-teal-700 px-5 py-3 text-center text-xs font-black text-white shadow-md shadow-teal-200 hover:from-teal-700 hover:to-emerald-800 transition-all">+ Buat Tugas Baru</a>
        </div>

        <!-- Filter Tab Kategori -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 scrollbar-none">
            <button class="px-5 py-3 bg-gradient-to-r from-teal-600 to-emerald-700 border-2 border-teal-700 text-white font-black text-xs rounded-2xl shadow-sm flex-shrink-0">
                Semua Kiriman ({{ $totalSubmissions }})
            </button>
            <span class="px-5 py-3 bg-white/90 text-slate-700 border-2 border-teal-200 font-black text-xs rounded-2xl flex-shrink-0 shadow-2xs">
                Menunggu Dinilai: {{ $pendingCount }}
            </span>
            <span class="px-5 py-3 bg-white/90 text-slate-700 border-2 border-teal-200 font-black text-xs rounded-2xl flex-shrink-0 shadow-2xs">
                Selesai Dinilai: {{ $gradedCount }}
            </span>
        </div>

        <!-- Statistik Ringkasan Kartu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <!-- Kartu 1: Total Tugas Masuk -->
            <div class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-teal-200 shadow-sm p-6 space-y-1">
                <span class="text-xs font-black text-slate-500 uppercase tracking-wider">Total Tugas Masuk</span>
                <div class="flex items-baseline space-x-3 pt-1">
                    <span class="text-3xl font-black text-slate-900">{{ $totalSubmissions }}</span>
                    <span class="text-xs font-black bg-amber-50 text-amber-800 border border-amber-300 px-3 py-1 rounded-xl">{{ $pendingCount }} Menunggu Koreksi</span>
                </div>
            </div>

            <!-- Kartu 2: Sudah Dikoreksi -->
            <div class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-teal-200 shadow-sm p-6 space-y-1">
                <span class="text-xs font-black text-slate-500 uppercase tracking-wider">Sudah Dikoreksi</span>
                <div class="flex items-baseline space-x-3 pt-1">
                    <span class="text-3xl font-black text-slate-900">{{ $gradedCount }}</span>
                    <span class="text-xs font-black bg-emerald-50 text-emerald-800 border border-emerald-300 px-3 py-1 rounded-xl">Terkoreksi Selesai</span>
                </div>
            </div>

        </div>

        <!-- Section: Kirim Hasil & Buat Evaluasi -->
        <div class="space-y-4">
            <div class="px-1 flex items-center justify-between">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-700">Daftar Pengumpulan Tugas Siswa</h3>
                <span class="text-xs font-bold text-slate-500">Menampilkan {{ $submissions->count() }} pengumpulan</span>
            </div>

            <div class="space-y-4">
                @forelse ($submissions as $sub)
                    <div class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-teal-200 shadow-sm p-6 sm:p-8 space-y-4 hover:border-teal-400 transition-all">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1.5 rounded-xl text-xs font-black bg-teal-50 text-teal-800 border border-teal-200 tracking-wider">
                                {{ $sub->assignment?->classroom?->name ?? 'Kelas' }}
                            </span>
                            @if($sub->status === 'graded')
                                <span class="text-xs font-black bg-emerald-50 text-emerald-800 border border-emerald-300 px-3 py-1.5 rounded-xl">
                                    Terkoreksi • Nilai: <span class="text-emerald-900">{{ $sub->score }}/100</span>
                                </span>
                            @else
                                <span class="text-xs font-black bg-rose-50 text-rose-700 border border-rose-300 px-3 py-1.5 rounded-xl">
                                    Menunggu Dinilai
                                </span>
                            @endif
                        </div>

                        <div class="space-y-1.5">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-black text-teal-700 uppercase tracking-wide">{{ $sub->student?->user?->name ?? 'Siswa' }} (NISN: {{ $sub->student?->nisn ?? '-' }})</span>
                            </div>
                            <h4 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">
                                {{ $sub->assignment?->title ?? 'Tugas Mandiri' }}
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-600 font-bold leading-relaxed">
                                {{ Str::limit($sub->submission_text ?: ($sub->file_path ? 'Berkas lampiran telah diserahkan siswa.' : 'Tidak ada catatan tambahan.'), 120) }}
                            </p>
                        </div>

                        <div class="pt-4 border-t-2 border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                            <span class="text-xs text-slate-500 font-bold">Dikumpulkan: {{ $sub->submitted_at?->diffForHumans() ?? 'Baru saja' }}</span>
                            <a href="{{ route('guru.input-nilai', $sub) }}"
                                class="w-full sm:w-auto px-6 py-3 text-center {{ $sub->status === 'graded' ? 'bg-white hover:bg-teal-50 text-teal-800 border-2 border-teal-200' : 'bg-gradient-to-r from-teal-600 to-emerald-700 text-white border-2 border-teal-700 shadow-md shadow-teal-200 hover:from-teal-700 hover:to-emerald-800' }} font-black text-xs rounded-2xl transition-all">
                                {{ $sub->status === 'graded' ? 'Edit Nilai' : 'Koreksi Sekarang' }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white/85 backdrop-blur-md rounded-3xl border-2 border-dashed border-slate-300 p-12 text-center text-slate-500 shadow-2xs space-y-2">
                        <p class="text-base font-black text-slate-800">Belum ada tugas yang dikumpulkan siswa.</p>
                        <p class="text-xs font-bold text-slate-500">Tugas yang dikumpulkan siswa akan otomatis muncul di sini untuk dinilai.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>

</html>