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

<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div
        class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2 space-y-1">
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight flex items-center space-x-2">
                <span>Kelas Belajarmu</span>
                <span class="text-lg">📚</span>
            </h1>
            <p class="text-xs text-slate-600 font-semibold">Pantau progres dan ikuti kelas interaktif harian.</p>
        </div>

        <!-- Kolom Pencarian -->
        <form method="GET" action="{{ route('siswa.kelas') }}" class="relative">
            @if ($selectedSubject && $selectedSubject !== 'Semua')
                <input type="hidden" name="subject" value="{{ $selectedSubject }}">
            @endif
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari kelas aktif atau topik modul..."
                class="w-full pl-11 pr-16 py-3 bg-white border-2 border-slate-300 rounded-xl text-xs sm:text-sm font-semibold text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 shadow-sm transition-all">
            @if ($search)
                <a href="{{ route('siswa.kelas', array_filter(['subject' => $selectedSubject !== 'Semua' ? $selectedSubject : null])) }}"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-xs font-bold text-slate-400 hover:text-slate-600">Reset</a>
            @endif
        </form>

        <!-- Filter Kategori (Chips) -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 no-scrollbar">
            <a href="{{ route('siswa.kelas', array_filter(['search' => $search])) }}"
                class="px-4 py-2 {{ $selectedSubject === 'Semua' ? 'bg-indigo-600 text-white font-extrabold border-indigo-700 shadow-md' : 'bg-white text-slate-700 border-2 border-slate-300 font-bold hover:bg-slate-50' }} text-xs rounded-xl shrink-0 transition-all">
                Semua
            </a>
            @foreach ($subjects as $subject)
                <a href="{{ route('siswa.kelas', array_filter(['subject' => $subject, 'search' => $search])) }}"
                    class="px-4 py-2 {{ $selectedSubject === $subject ? 'bg-indigo-600 text-white font-extrabold border-indigo-700 shadow-md' : 'bg-white text-slate-700 border-2 border-slate-300 font-bold hover:bg-slate-50' }} text-xs rounded-xl shrink-0 transition-all">
                    {{ $subject }}
                </a>
            @endforeach
        </div>

        <!-- Kelas yang Sedang Diikuti -->
        <div class="space-y-3">
            <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Kelas yang Sedang Diikuti</h3>

            @forelse ($classrooms as $classroom)
                <a href="{{ route('siswa.kelas.show', $classroom) }}"
                    class="block bg-white p-5 rounded-2xl border-2 border-slate-200 shadow-sm space-y-4 hover:border-indigo-600 hover:shadow-md transition-all">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332 1.253-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 leading-snug">
                                    {{ $classroom->name }}</h4>
                                <p class="text-xs text-slate-600 font-semibold">{{ $classroom->subject }} ·
                                    {{ $classroom->teacher?->user?->name ?? 'Guru' }}</p>
                            </div>
                        </div>
                        <span
                            class="text-xs font-bold text-slate-600 bg-slate-100 border border-slate-300 px-2.5 py-1 rounded-lg">{{ $classroom->grade_level }}</span>
                    </div>
                    <div
                        class="flex items-center justify-between border-t-2 border-slate-200 pt-3 text-xs font-semibold text-slate-600">
                        <span>{{ $classroom->students_count }} siswa terdaftar</span>
                        @if ($classroom->section)<span>{{ $classroom->section }}</span>@endif
                    </div>
                </a>
            @empty
                <div
                    class="rounded-2xl border-2 border-dashed border-slate-300 bg-white px-5 py-12 text-center text-xs font-semibold text-slate-500">
                    Tidak ada kelas yang sesuai filter.
                </div>
            @endforelse
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>

</html>