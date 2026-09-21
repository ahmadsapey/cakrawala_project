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
        <!-- Flash Messages -->
        @if(session('success'))
            <div
                class="p-4 bg-emerald-50 border-2 border-emerald-300 text-emerald-800 rounded-2xl text-xs sm:text-sm font-bold flex items-center justify-between shadow-sm">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div
                class="p-4 bg-rose-50 border-2 border-rose-300 text-rose-800 rounded-2xl text-xs sm:text-sm font-bold flex items-center justify-between shadow-sm">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Header Halaman -->
        <div class="flex items-center justify-between pt-2">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Modul Guru</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Koreksi & Penilaian
                    Tugas</h1>
            </div>
            <a href="{{ route('guru.tugas.create') }}"
                class="rounded-xl bg-indigo-600 border border-indigo-700 px-4 py-2.5 text-xs font-extrabold text-white shadow-md hover:bg-indigo-700 transition-all">+
                Buat Tugas Baru</a>
        </div>

        <!-- Filter Tab Kategori -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 scrollbar-none">
            <button
                class="px-5 py-2.5 bg-indigo-600 border border-indigo-700 text-white font-extrabold text-xs rounded-xl shadow-sm flex-shrink-0">
                Semua Kiriman ({{ $totalSubmissions }})
            </button>
            <span
                class="px-5 py-2.5 bg-white text-slate-700 border-2 border-slate-300 font-extrabold text-xs rounded-xl flex-shrink-0">
                Menunggu Dinilai: {{ $pendingCount }}
            </span>
            <span
                class="px-5 py-2.5 bg-white text-slate-700 border-2 border-slate-300 font-extrabold text-xs rounded-xl flex-shrink-0">
                Selesai Dinilai: {{ $gradedCount }}
            </span>
        </div>

        <!-- Statistik Ringkasan Kartu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <!-- Kartu 1: Total Tugas Masuk -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 space-y-1">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Total Tugas Masuk</span>
                <div class="flex items-baseline space-x-3 pt-1">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $totalSubmissions }}</span>
                    <span
                        class="text-xs font-extrabold bg-amber-50 text-amber-800 border border-amber-300 px-2.5 py-1 rounded-lg">{{ $pendingCount }}
                        Menunggu Koreksi</span>
                </div>
            </div>

            <!-- Kartu 2: Sudah Dikoreksi -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 space-y-1">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Sudah Dikoreksi</span>
                <div class="flex items-baseline space-x-3 pt-1">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $gradedCount }}</span>
                    <span
                        class="text-xs font-extrabold bg-emerald-50 text-emerald-800 border border-emerald-300 px-2.5 py-1 rounded-lg">Terkoreksi
                        Selesai</span>
                </div>
            </div>

        </div>

        <!-- Section: Kirim Hasil & Buat Evaluasi -->
        <div class="space-y-4">
            <div class="px-1 flex items-center justify-between">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Daftar Pengumpulan Tugas
                    Siswa</h3>
                <span class="text-xs font-semibold text-slate-500">Menampilkan {{ $submissions->count() }}
                    pengumpulan</span>
            </div>

            <div class="space-y-4">
                @forelse ($submissions as $sub)
                    <div
                        class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-6 space-y-4 hover:border-indigo-600 transition-all">
                        <div class="flex items-center justify-between">
                            <span
                                class="px-3 py-1 rounded-lg text-xs font-extrabold bg-indigo-100 text-indigo-800 border border-indigo-300 tracking-wider">
                                {{ $sub->assignment?->classroom?->name ?? 'Kelas' }}
                            </span>
                            @if($sub->status === 'graded')
                                <span
                                    class="text-xs font-extrabold bg-emerald-50 text-emerald-800 border border-emerald-300 px-3 py-1 rounded-lg">
                                    Terkoreksi • Nilai: {{ $sub->score }}/100
                                </span>
                            @else
                                <span
                                    class="text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-300 px-3 py-1 rounded-lg">
                                    Menunggu Dinilai
                                </span>
                            @endif
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center space-x-2">
                                <span
                                    class="text-xs font-bold text-indigo-600 uppercase">{{ $sub->student?->user?->name ?? 'Siswa' }}
                                    (NISN: {{ $sub->student?->nisn ?? '-' }})</span>
                            </div>
                            <h4 class="text-base font-extrabold text-slate-900 tracking-tight">
                                {{ $sub->assignment?->title ?? 'Tugas Mandiri' }}
                            </h4>
                            <p class="text-xs text-slate-600 font-semibold leading-relaxed">
                                {{ Str::limit($sub->submission_text ?: ($sub->file_path ? 'Berkas lampiran telah diserahkan siswa.' : 'Tidak ada catatan tambahan.'), 120) }}
                            </p>
                        </div>

                        <div class="pt-3 border-t-2 border-slate-200 flex items-center justify-between">
                            <span class="text-xs text-slate-500 font-semibold">Dikumpulkan:
                                {{ $sub->submitted_at?->diffForHumans() ?? 'Baru saja' }}</span>
                            <a href="{{ route('guru.input-nilai', $sub) }}"
                                class="px-5 py-2.5 {{ $sub->status === 'graded' ? 'bg-slate-100 hover:bg-slate-200 text-slate-800 border-slate-300' : 'bg-indigo-600 hover:bg-indigo-700 text-white border-indigo-700' }} font-extrabold text-xs rounded-xl shadow-sm border transition-all">
                                {{ $sub->status === 'graded' ? 'Edit Nilai' : 'Koreksi Sekarang' }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="bg-white rounded-2xl border-2 border-slate-300 p-8 text-center text-slate-500 font-bold text-xs space-y-2">
                        <p class="text-sm font-extrabold text-slate-700">Belum ada tugas yang dikumpulkan siswa.</p>
                        <p class="text-xs text-slate-500">Tugas yang dikumpulkan siswa akan otomatis muncul di sini untuk
                            dinilai.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>

</html>