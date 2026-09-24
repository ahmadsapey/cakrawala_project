<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | Cakrawala Educentre</title>
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
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2 flex items-center justify-between">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Profil Saya</h1>
            <a href="{{ route('siswa.profile.edit') }}" class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-2xl text-xs font-black shadow-md shadow-indigo-200 transition-all">
                Edit Profil
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50/90 backdrop-blur-sm border border-emerald-200 text-emerald-800 rounded-2xl text-xs sm:text-sm font-extrabold flex items-center space-x-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Kartu Identitas Pengguna dengan Gradien Header -->
        <div class="relative overflow-hidden bg-white/85 backdrop-blur-sm p-6 sm:p-8 rounded-3xl border border-indigo-100 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-indigo-500/10 blur-2xl"></div>
            <div class="flex items-center space-x-5 relative z-10">
                <div class="w-18 h-18 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white flex items-center justify-center font-black text-2xl shrink-0 shadow-md shadow-indigo-200">
                    {{ strtoupper(substr($user?->name ?? 'S', 0, 2)) }}
                </div>
                <div class="space-y-1.5 overflow-hidden">
                    <h2 class="text-lg sm:text-xl font-black text-slate-900 tracking-tight truncate">{{ $user?->name ?? 'Siswa Cakrawala' }}</h2>
                    <p class="text-xs font-bold text-slate-500">NISN: {{ $student?->nisn ?? '-' }} • {{ $user?->email ?? '-' }}</p>
                    <div class="pt-1">
                        <span class="inline-block px-3 py-1 bg-indigo-50 border border-indigo-200 text-indigo-700 font-extrabold text-xs rounded-xl">
                            {{ $student?->class_name ?? 'Kelas Aktif' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Lembaga & Kurikulum -->
        <div class="bg-white/85 backdrop-blur-sm p-6 rounded-3xl border border-indigo-100 shadow-sm space-y-3">
            <span class="text-xs font-black uppercase tracking-wider text-slate-500 px-1">Informasi Lembaga & Kurikulum</span>
            <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-amber-500/10 via-orange-500/5 to-transparent rounded-2xl border border-amber-200/80">
                <div class="w-11 h-11 rounded-2xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-amber-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.16 3.422A12.083 12.083 0 015.84 10.578L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"/></svg>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm font-black text-slate-900">Cakrawala Educentre — Bimbingan Belajar Modern</h3>
                    <p class="text-xs font-bold text-slate-600">Kurikulum Merdeka • Tahun Ajaran 2026/2027</p>
                </div>
            </div>
        </div>

        <!-- Ringkasan Aktivitas Belajar -->
        <div class="space-y-3">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider px-1">Ringkasan Aktivitas Belajar</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                
                <!-- Box 1: Rerata Nilai -->
                <div class="bg-white/85 backdrop-blur-sm p-5 rounded-3xl border border-indigo-100 shadow-sm flex flex-col justify-between space-y-3 hover:shadow-md transition-all">
                    <span class="text-xs font-black text-slate-500 uppercase tracking-wider">Rerata Nilai</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-3xl font-black text-slate-900">{{ number_format($avgScore ?? 0, 1) }}</span>
                        @php
                            $score = $avgScore ?? 0;
                            $gradeLetter = $score >= 85 ? 'A' : ($score >= 75 ? 'B' : 'C');
                        @endphp
                        <span class="px-2.5 py-0.5 {{ $score >= 75 ? 'bg-emerald-100 border-emerald-200 text-emerald-800' : 'bg-rose-100 border-rose-200 text-rose-800' }} border font-black text-xs rounded-lg">{{ $gradeLetter }}</span>
                    </div>
                </div>

                <!-- Box 2: Materi Tersedia -->
                <div class="bg-white/85 backdrop-blur-sm p-5 rounded-3xl border border-indigo-100 shadow-sm flex flex-col justify-between space-y-3 hover:shadow-md transition-all">
                    <span class="text-xs font-black text-slate-500 uppercase tracking-wider">Materi Aktif</span>
                    <div class="flex items-baseline space-x-1.5">
                        <span class="text-3xl font-black text-slate-900">{{ $materialsCount ?? 0 }}</span>
                        <span class="text-xs font-black text-slate-500">Bab</span>
                    </div>
                </div>

                <!-- Box 3: Tugas Dikumpul -->
                <div class="bg-white/85 backdrop-blur-sm p-5 rounded-3xl border border-indigo-100 shadow-sm flex flex-col justify-between space-y-3 hover:shadow-md transition-all">
                    <span class="text-xs font-black text-slate-500 uppercase tracking-wider">Tugas Dikumpul</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-3xl font-black text-slate-900">{{ $completedTasksCount ?? 0 }}</span>
                        <span class="px-2.5 py-0.5 bg-indigo-50 border border-indigo-200 text-indigo-700 font-black text-xs rounded-lg">Tugas</span>
                    </div>
                </div>

                <!-- Box 4: Peringkat Kelas -->
                <div class="bg-white/85 backdrop-blur-sm p-5 rounded-3xl border border-indigo-100 shadow-sm flex flex-col justify-between space-y-3 hover:shadow-md transition-all">
                    <span class="text-xs font-black text-slate-500 uppercase tracking-wider">Peringkat Kelas</span>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-3xl font-black text-indigo-600">#{{ $classRank ?? '-' }}</span>
                        <span class="text-xs font-bold text-slate-500">Dari {{ $totalStudentsInClass ?? '-' }}</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Pengaturan Akun & Informasi -->
        <div class="space-y-3">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider px-1">Pengaturan Akun & Informasi</h3>
            <div class="bg-white/85 backdrop-blur-sm rounded-3xl border border-indigo-100 shadow-sm overflow-hidden divide-y divide-indigo-50">
                
                <!-- Menu 1: Edit Profil -->
                <a href="{{ route('siswa.profile.edit') }}" class="flex items-center justify-between p-4.5 sm:p-5 hover:bg-indigo-50/40 transition-all group">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-slate-800">Edit Profil Lengkap</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Menu 2: Keamanan & Kata Sandi -->
                <a href="{{ route('siswa.pengaturan') }}" class="flex items-center justify-between p-4.5 sm:p-5 hover:bg-indigo-50/40 transition-all group">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-slate-800">Keamanan & Kata Sandi</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Menu 3: Pembayaran -->
                <a href="{{ route('siswa.payment.create') }}" class="flex items-center justify-between p-4.5 sm:p-5 hover:bg-indigo-50/40 transition-all group">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-slate-800">Administrasi & Pembayaran</span>
                    </div>
                    <div class="flex items-center space-x-2.5">
                        <span class="px-2.5 py-1 bg-amber-100 text-amber-700 font-black text-[10px] rounded-lg border border-amber-200 uppercase tracking-wider">Baru</span>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </a>

                <!-- Menu 4: Keluar -->
                <form method="POST" action="{{ route('siswa.logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-between p-4.5 sm:p-5 hover:bg-rose-50/70 transition-all group text-left">
                        <div class="flex items-center space-x-3.5">
                            <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </div>
                            <span class="text-xs sm:text-sm font-black text-rose-600">Keluar dari Akun Siswa</span>
                        </div>
                        <svg class="w-4 h-4 text-rose-400 group-hover:text-rose-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </form>

            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>