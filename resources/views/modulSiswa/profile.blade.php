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
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-md flex-col space-y-6 bg-[#F8FAFC] p-4 sm:p-6 md:max-w-7xl md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Profil Saya</h1>
        </div>

        <!-- Kartu Identitas Pengguna -->
        <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm flex items-center space-x-4">
            <div class="relative shrink-0">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" alt="Foto Profil" class="w-16 h-16 rounded-2xl object-cover shadow-sm">
            </div>
            <div class="space-y-1 overflow-hidden">
                <h2 class="text-sm sm:text-base font-black text-slate-900 truncate">Bintang Cakrawala</h2>
                <p class="text-[11px] font-medium text-slate-400">NISN: 0082718291</p>
                <div class="pt-0.5">
                    <span class="inline-block px-2.5 py-0.5 bg-indigo-50 text-indigo-600 font-bold text-[10px] rounded-md">Kelas XI - IPA 2</span>
                </div>
            </div>
        </div>

        <!-- Informasi Sekolah -->
        <div class="bg-white p-4 rounded-3xl border border-slate-100 shadow-sm space-y-2">
            <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 px-1">Informasi Sekolah</span>
            <div class="flex items-center space-x-3 p-2 bg-amber-50/50 rounded-2xl border border-amber-100/60">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0.017.665-6.16 3.422A12.083 12.083 0 015.84 10.578L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"/></svg>
                </div>
                <div>
                    <h3 class="text-xs font-black text-slate-900">SMA Negeri 1 Harapan Bangsa</h3>
                    <p class="text-[10px] font-medium text-slate-500">Tahun Ajaran 2026/2027 (Semester Ganjil)</p>
                </div>
            </div>
        </div>

        <!-- Ringkasan Aktivitas Belajar -->
        <div class="space-y-3">
            <h3 class="text-sm font-black text-slate-900 px-1">Ringkasan Aktivitas Belajar</h3>
            <div class="grid grid-cols-2 gap-3">
                <!-- Box 1: Rerata Nilai -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-3">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Rerata Nilai</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-2xl font-black text-slate-900">88.4</span>
                        <span class="px-1.5 py-0.5 bg-emerald-50 text-emerald-600 font-bold text-[9px] rounded-md">A</span>
                    </div>
                </div>

                <!-- Box 2: Materi Selesai -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-3">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Materi Selesai</span>
                    <div class="flex items-baseline space-x-1.5">
                        <span class="text-2xl font-black text-slate-900">12</span>
                        <span class="text-xs font-bold text-slate-400">Bab</span>
                    </div>
                </div>

                <!-- Box 3: Tugas Selesai -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-3">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tugas Selesai</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-2xl font-black text-slate-900">14</span>
                        <span class="px-1.5 py-0.5 bg-indigo-50 text-indigo-600 font-bold text-[9px] rounded-md">100%</span>
                    </div>
                </div>

                <!-- Box 4: Peringkat Kelas -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-3">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Peringkat Kelas</span>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-2xl font-black text-indigo-600">#3</span>
                        <span class="text-[11px] font-medium text-slate-400">Dari 36</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengaturan Akun & Informasi -->
        <div class="space-y-3">
            <h3 class="text-sm font-black text-slate-900 px-1">Pengaturan Akun & Informasi</h3>
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden divide-y divide-slate-50">
                <!-- Menu 1: Edit Profil -->
                <a href="{{ route('siswa.profile.edit') }}" class="flex items-center justify-between p-4 hover:bg-slate-50/80 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Edit Profil Lengkap</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Menu 2: Keamanan & Kata Sandi -->
                <a href="{{ route('siswa.pengaturan') }}" class="flex items-center justify-between p-4 hover:bg-slate-50/80 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Keamanan & Kata Sandi</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Menu 3: Pembayaran -->
                <a href="{{ route('siswa.pengaturan') }}" class="flex items-center justify-between p-4 hover:bg-slate-50/80 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Pembayaran</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-0.5 bg-amber-50 text-amber-600 font-bold text-[9px] rounded-md border border-amber-100">Baru</span>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </a>

                <!-- Menu 4: Keluar -->
                <a href="{{ route('siswa.login') }}" class="flex items-center justify-between p-4 hover:bg-rose-50/40 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </div>
                        <span class="text-xs font-bold text-rose-600">Keluar</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-rose-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

    </div>

    <!-- Bottom Navigation Bar -->
    <div class="hidden fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white/90 backdrop-blur-md border-t border-slate-100 px-6 py-3 items-center justify-between z-50 shadow-lg">
        <a href="{{ route('siswa.home') }}" class="flex flex-col items-center space-y-1 text-slate-400 hover:text-slate-600 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span class="text-[10px] font-medium">Beranda</span>
        </a>
        <a href="{{ route('siswa.kelas') }}" class="flex flex-col items-center space-y-1 text-slate-400 hover:text-slate-600 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <span class="text-[10px] font-medium">Belajar</span>
        </a>
        <a href="{{ route('siswa.tugas') }}" class="flex flex-col items-center space-y-1 text-slate-400 hover:text-slate-600 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            <span class="text-[10px] font-medium">Ujian</span>
        </a>
        <a href="{{ route('siswa.profile') }}" class="flex flex-col items-center space-y-1 text-indigo-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span class="text-[10px] font-bold">Profil</span>
        </a>
    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>