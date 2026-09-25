<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas & Progres | Cakrawala Educentre</title>
    <title>Detail Kelas: {{ $classroom?->name }} | Cakrawala Educentre</title>
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
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="flex items-center justify-between pt-2">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Modul guru</p>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Modul Guru</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Detail Kelas & Progres</h1>
            </div>
            <a href="{{ route('guru.kelas') }}" class="rounded-xl border-2 border-slate-300 bg-white px-4 py-2.5 text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">Kembali ke Kelas</a>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-2 border-emerald-300 text-emerald-800 rounded-2xl text-xs sm:text-sm font-bold flex items-center space-x-2 shadow-sm">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Kartu Informasi Utama Kelas -->
        <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-6 space-y-4">
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 rounded-lg text-xs font-extrabold bg-indigo-100 text-indigo-800 border border-indigo-300">
                    Kurikulum Merdeka
                </span>
                <span class="px-3 py-1 rounded-lg text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">
                    Sesi Ke-12
                    {{ $classroom?->grade_level ?? 'Kelas Aktif' }}
                </span>
            </div>

            <div class="space-y-1">
                <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">Kelas XI – IPA 2: Fisika Modern</h2>
                <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">{{ $classroom?->name ?? 'Kelas' }}: {{ $classroom?->subject ?? 'Mata Pelajaran' }}</h2>
                @if($classroom?->description)
                    <p class="text-xs text-slate-500 font-semibold">{{ $classroom->description }}</p>
                @endif
            </div>

            <div class="grid grid-cols-2 pt-4 border-t-2 border-slate-200 gap-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 pt-4 border-t-2 border-slate-200 gap-4">
                <div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider font-extrabold">Total Siswa Terdaftar</div>
                    <div class="text-sm sm:text-base font-extrabold text-slate-900 mt-0.5">{{ $students->count() }} Siswa Aktif</div>
                </div>
                <div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider font-extrabold">Progres Pembelajaran</div>
                    <div class="text-sm sm:text-base font-extrabold text-indigo-600 mt-0.5">{{ $progressPercent }}% Selesai</div>
                </div>
                <div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider font-extrabold">Total Materi Diterbitkan</div>
                    <div class="text-sm sm:text-base font-extrabold text-slate-900 mt-0.5">{{ $materials->count() }} Modul</div>
                </div>
            </div>
        </div>

        <!-- Section: Lihat Daftar Siswa -->
        <div class="space-y-3">
            <div class="px-1 flex items-center justify-between">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Daftar Siswa Terdaftar</h3>
                <a href="{{ route('guru.siswa') }}" class="text-xs font-extrabold text-indigo-600 hover:underline">Semua (36 Siswa)</a>
                <a href="{{ route('guru.siswa', $classroom) }}" class="text-xs font-extrabold text-indigo-600 hover:underline">Semua ({{ $students->count() }} Siswa) &rarr;</a>
            </div>

            <!-- List Avatar Siswa Horisontal -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                
                <!-- Siswa 1 -->
                <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-3.5 flex items-center space-x-3 hover:border-indigo-600 transition-all">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80" alt="Rayyan P." class="w-9 h-9 rounded-full object-cover border border-slate-300">
                    <div>
                        <p class="text-xs font-extrabold text-slate-900">Rayyan Pratama</p>
                        <p class="text-[10px] font-bold text-slate-500">NISN: 0019283912</p>
                @forelse ($students->take(6) as $st)
                    <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-3.5 flex items-center space-x-3 hover:border-indigo-600 transition-all">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center font-extrabold text-xs shrink-0">
                            {{ strtoupper(substr($st->user?->name ?? 'S', 0, 2)) }}
                        </div>
                        <div class="min-w-0 truncate">
                            <p class="text-xs font-extrabold text-slate-900 truncate">{{ $st->user?->name ?? 'Siswa' }}</p>
                            <p class="text-[10px] font-bold text-slate-500 truncate">NISN: {{ $st->nisn ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Siswa 2 -->
                <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-3.5 flex items-center space-x-3 hover:border-indigo-600 transition-all">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Bintang C." class="w-9 h-9 rounded-full object-cover border border-slate-300">
                    <div>
                        <p class="text-xs font-extrabold text-slate-900">Bintang Cakrawala</p>
                        <p class="text-[10px] font-bold text-slate-500">NISN: 0082718291</p>
                @empty
                    <div class="col-span-3 p-6 bg-white rounded-2xl border-2 border-slate-300 text-center text-xs font-bold text-slate-500">
                        Belum ada siswa yang terdaftar pada kelas ini.
                    </div>
                </div>

                <!-- Siswa 3 -->
                <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-3.5 flex items-center space-x-3 hover:border-indigo-600 transition-all">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop&q=80" alt="Siti A." class="w-9 h-9 rounded-full object-cover border border-slate-300">
                    <div>
                        <p class="text-xs font-extrabold text-slate-900">Siti Aulia Putri</p>
                        <p class="text-[10px] font-bold text-slate-500">NISN: 0038172645</p>
                    </div>
                </div>

                @endforelse
            </div>
        </div>

        <!-- Section: Daftar Bab Pembelajaran -->
        <!-- Section: Daftar Bab Pembelajaran (Materi) -->
        <div class="space-y-3">
            <div class="px-1">
            <div class="px-1 flex items-center justify-between">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Daftar Bab Pembelajaran</h3>
                <a href="{{ route('guru.material.create') }}" class="text-xs font-extrabold text-indigo-600 hover:underline">+ Tambah Bahan Ajar</a>
            </div>

            <div class="space-y-3">
                
                <!-- Bab 1: Selesai -->
                <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-4.5 flex items-start space-x-3.5 hover:border-indigo-600 transition-all">
                    <div class="w-7 h-7 rounded-xl bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 mt-0.5 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                @forelse ($materials as $index => $mat)
                    <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-4.5 flex items-start space-x-3.5 hover:border-indigo-600 transition-all">
                        <div class="w-8 h-8 rounded-xl {{ $mat->status === 'published' ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-700' }} flex items-center justify-center flex-shrink-0 mt-0.5 shadow-sm font-extrabold text-xs">
                            {{ $index + 1 }}
                        </div>
                        <div class="space-y-0.5 flex-1 min-w-0">
                            <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">{{ $mat->title }}</h4>
                            <p class="text-xs {{ $mat->status === 'published' ? 'text-emerald-700 font-extrabold' : 'text-slate-500 font-semibold' }}">
                                {{ $mat->status === 'published' ? 'Sudah Diterbitkan' : 'Draf' }} • {{ $mat->summary ? Str::limit($mat->summary, 80) : 'Modul pembelajaran kelas.' }}
                            </p>
                        </div>
                    </div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs sm:text-sm font-extrabold text-slate-900">01. Teori Kuantum Max Planck</h4>
                        <p class="text-xs text-emerald-700 font-extrabold">Sudah Diterbitkan • 100% Dibaca</p>
                @empty
                    <div class="bg-white rounded-2xl border-2 border-slate-300 p-8 text-center text-slate-500 font-bold text-xs space-y-3">
                        <p>Belum ada bahan ajar yang dibuat untuk kelas ini.</p>
                        <a href="{{ route('guru.material.create') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-extrabold">Buat Bahan Ajar Baru</a>
                    </div>
                </div>

                <!-- Bab 2: Sedang Berjalan -->
                <div class="bg-indigo-50/60 rounded-2xl border-2 border-indigo-600 shadow-sm p-4.5 flex items-start space-x-3.5 transition-all">
                    <div class="w-7 h-7 rounded-xl bg-indigo-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5 shadow-sm">
                        <span class="text-xs font-extrabold">2</span>
                    </div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs sm:text-sm font-extrabold text-indigo-950">02. Eksperimen Efek Fotolistrik</h4>
                        <p class="text-xs text-indigo-700 font-extrabold">Sedang Berjalan • Live Sesi Hari Ini</p>
                    </div>
                </div>

                <!-- Bab 3: Belum Mulai -->
                <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-4.5 flex items-start space-x-3.5 hover:border-indigo-600 transition-all">
                    <div class="w-7 h-7 rounded-xl bg-slate-100 border border-slate-300 text-slate-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-extrabold">3</span>
                    </div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs sm:text-sm font-extrabold text-slate-800">03. Formulasi Foton Einstein</h4>
                        <p class="text-xs text-slate-500 font-semibold">Belum Mulai • Dijadwalkan Pekan Depan</p>
                    </div>
                </div>

                @endforelse
            </div>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

</body>
</html>