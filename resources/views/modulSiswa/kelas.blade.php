<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Belajarmu | Cakrawala Educentre</title>
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

<body class="bg-gradient-to-br from-indigo-50/50 via-sky-50/30 to-purple-50/50 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-8 p-4 sm:p-6 md:space-y-10 md:p-8 lg:px-12">

        <!-- Header Halaman dengan Gradien Modern -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 p-8 text-white shadow-xl">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/15 blur-2xl"></div>
            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="space-y-2">
                    <span class="inline-block rounded-full bg-white/20 px-3.5 py-1 text-xs font-bold uppercase tracking-widest backdrop-blur-md">Portal Siswa</span>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight">
                        Kelas Belajarmu
                    </h1>
                    <p class="text-xs sm:text-sm font-medium text-indigo-100">Pantau progres dan ikuti kelas interaktif harian dengan penuh semangat.</p>
                </div>
            </div>
        </div>

        <!-- Bar Pencarian & Filter Kategori -->
        <div class="space-y-5">
            <!-- Kolom Pencarian -->
            <form method="GET" action="{{ route('siswa.kelas') }}" class="relative group">
                @if ($selectedSubject && $selectedSubject !== 'Semua')
                    <input type="hidden" name="subject" value="{{ $selectedSubject }}">
                @endif
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari kelas aktif atau topik modul..."
                    class="w-full pl-12 pr-16 py-4 bg-white/90 border border-indigo-100 rounded-2xl text-xs sm:text-sm font-semibold text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 shadow-sm backdrop-blur-sm transition-all">
                @if ($search)
                    <a href="{{ route('siswa.kelas', array_filter(['subject' => $selectedSubject !== 'Semua' ? $selectedSubject : null])) }}"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-xs font-bold text-slate-400 hover:text-indigo-600 transition-colors">Reset</a>
                @endif
            </form>

            <!-- Filter Kategori (Chips) -->
            <div class="flex items-center space-x-2.5 overflow-x-auto pb-2 scrollbar-none">
                <a href="{{ route('siswa.kelas', array_filter(['search' => $search])) }}"
                    class="px-4.5 py-2.5 {{ $selectedSubject === 'Semua' ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-black shadow-md shadow-indigo-200' : 'bg-white/80 text-slate-600 border border-slate-200 font-bold hover:bg-white hover:border-indigo-300' }} text-xs rounded-2xl shrink-0 backdrop-blur-sm transition-all">
                    Semua
                </a>
                @foreach ($subjects as $subject)
                    <a href="{{ route('siswa.kelas', array_filter(['subject' => $subject, 'search' => $search])) }}"
                        class="px-4.5 py-2.5 {{ $selectedSubject === $subject ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-black shadow-md shadow-indigo-200' : 'bg-white/80 text-slate-600 border border-slate-200 font-bold hover:bg-white hover:border-indigo-300' }} text-xs rounded-2xl shrink-0 backdrop-blur-sm transition-all">
                        {{ $subject }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Daftar Kelas yang Sedang Diikuti -->
        <div class="space-y-4">
            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 uppercase tracking-wider px-1 flex items-center gap-2">
                <span class="inline-block h-2.5 w-2.5 rounded-full bg-indigo-500"></span> Kelas yang Sedang Diikuti
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @forelse ($classrooms as $classroom)
                    @php
                        // Palet tema kartu yang lebih kaya warna dan hidup
                        $themes = [
                            [
                                'bg' => 'bg-gradient-to-br from-white via-indigo-50/40 to-violet-100/50',
                                'border' => 'border-indigo-100 hover:border-indigo-400',
                                'icon_bg' => 'bg-gradient-to-br from-indigo-500 to-violet-600 text-white shadow-indigo-200',
                                'badge' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                'line' => 'border-indigo-100/80',
                            ],
                            [
                                'bg' => 'bg-gradient-to-br from-white via-sky-50/40 to-blue-100/50',
                                'border' => 'border-sky-100 hover:border-sky-400',
                                'icon_bg' => 'bg-gradient-to-br from-sky-500 to-blue-600 text-white shadow-sky-200',
                                'badge' => 'bg-sky-50 text-sky-700 border-sky-200',
                                'line' => 'border-sky-100/80',
                            ],
                            [
                                'bg' => 'bg-gradient-to-br from-white via-emerald-50/40 to-teal-100/50',
                                'border' => 'border-emerald-100 hover:border-emerald-400',
                                'icon_bg' => 'bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-emerald-200',
                                'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'line' => 'border-emerald-100/80',
                            ],
                            [
                                'bg' => 'bg-gradient-to-br from-white via-amber-50/40 to-orange-100/50',
                                'border' => 'border-amber-100 hover:border-amber-400',
                                'icon_bg' => 'bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-amber-200',
                                'badge' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'line' => 'border-amber-100/80',
                            ],
                        ];
                        $theme = $themes[$loop->index % count($themes)];
                    @endphp

                    <a href="{{ route('siswa.kelas.show', $classroom) }}"
                        class="group {{ $theme['bg'] }} p-6 rounded-3xl border {{ $theme['border'] }} shadow-sm hover:shadow-xl hover:-translate-y-1 backdrop-blur-sm transition-all duration-300 flex flex-col justify-between space-y-5">
                        
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-start space-x-4">
                                <div class="w-13 h-13 rounded-2xl {{ $theme['icon_bg'] }} flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform shadow-md">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332 1.253-4.5 1.253" />
                                    </svg>
                                </div>
                                <div class="space-y-1.5">
                                    <h4 class="text-base font-black text-slate-900 group-hover:text-indigo-600 transition-colors leading-snug">
                                        {{ $classroom->name }}
                                    </h4>
                                    <p class="text-xs font-semibold text-slate-500">{{ $classroom->subject }} · <span class="text-slate-700 font-bold">{{ $classroom->teacher?->user?->name ?? 'Guru Pengampu' }}</span></p>
                                </div>
                            </div>
                            <span class="text-[11px] font-extrabold {{ $theme['badge'] }} border px-3 py-1.5 rounded-xl shrink-0 shadow-xs">
                                {{ $classroom->grade_level }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between border-t {{ $theme['line'] }} pt-4 text-xs font-semibold text-slate-500">
                            <span class="flex items-center space-x-1.5 font-bold">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>{{ $classroom->students_count }} siswa terdaftar</span>
                            </span>
                            @if ($classroom->section)
                                <span class="bg-white/90 text-slate-700 border border-slate-200 px-3 py-1 rounded-lg text-[11px] font-extrabold shadow-2xs">{{ $classroom->section }}</span>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="col-span-full rounded-3xl border-2 border-dashed border-indigo-200 bg-white/60 backdrop-blur-sm px-5 py-16 text-center space-y-3">
                        <div class="w-14 h-14 bg-indigo-50 text-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-2 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        </div>
                        <p class="text-sm font-black text-slate-800">Tidak ada kelas yang sesuai filter.</p>
                        <p class="text-xs text-slate-400 font-semibold">Coba ubah kata kunci pencarian atau kategori kelas Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>

</html>