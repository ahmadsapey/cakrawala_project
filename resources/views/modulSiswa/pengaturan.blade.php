<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan & Keamanan | Cakrawala Educentre</title>
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
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2">
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Pengaturan & Keamanan</h1>
        <div class="pt-2 flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Pengaturan & Keamanan</h1>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Kelola kata sandi, privasi, dan preferensi akun Anda.</p>
            </div>
            <a href="{{ route('siswa.profile') }}" class="px-4 py-2 bg-white border-2 border-slate-300 rounded-xl text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">
                Kembali ke Profil
            </a>
        </div>

        <!-- Section: KEAMANAN AKUN -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-2 border-emerald-300 text-emerald-800 rounded-2xl text-xs sm:text-sm font-bold flex items-center space-x-2 shadow-sm">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 bg-rose-50 border-2 border-rose-300 text-rose-800 rounded-2xl text-xs font-bold space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Section: KEAMANAN AKUN (Ubah Password) -->
        <div class="space-y-3">
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-600 px-1">Keamanan Akun</h3>
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm overflow-hidden divide-y-2 divide-slate-200">
                
                <!-- Menu 1: Ubah Kata Sandi -->
                <a href="{{ route('siswa.profile.edit') }}" class="flex items-center justify-between p-4.5 hover:bg-slate-50 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <span class="text-sm font-extrabold text-slate-900">Ubah Kata Sandi</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-600 px-1">Ubah Kata Sandi</h3>
            <form method="POST" action="{{ route('siswa.pengaturan.update') }}" class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-6 space-y-4">
                @csrf
                @method('PUT')

                <!-- Toggle 1: Autentikasi 2 Langkah (Aktif) -->
                <div class="flex items-center justify-between p-4.5">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <span class="text-sm font-extrabold text-slate-900">Autentikasi 2 Langkah</span>
                    </div>
                    <!-- Toggle Switch Active -->
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Kata Sandi Baru *</label>
                    <input type="password" id="password" name="password" required minlength="6" placeholder="Minimal 6 karakter" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 px-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>

                <!-- Toggle 2: Masuk dengan Sidik Jari / FaceID (Non-aktif) -->
                <div class="flex items-center justify-between p-4.5">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0115.171 17m3.839-1.132c.645-2.266.99-4.659.99-7.138A8 8 0 000 8c0 1.956.7 3.75 1.861 5.144"/></svg>
                        </div>
                        <span class="text-sm font-extrabold text-slate-900">Masuk dengan Sidik Jari / FaceID</span>
                    </div>
                    <!-- Toggle Switch Inactive -->
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Konfirmasi Kata Sandi Baru *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6" placeholder="Ketik ulang kata sandi baru" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 px-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>

            </div>
                <button type="submit" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl shadow-md transition-all">
                    Simpan Kata Sandi Baru
                </button>
            </form>
        </div>

        <!-- Section: PRIVASI DATA BELAJAR -->
        <!-- Section: PREFERENSI PRIVASI BELAJAR -->
        <div class="space-y-3">
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-600 px-1">Privasi Data Belajar</h3>
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-600 px-1">Privasi & Preferensi Akun</h3>
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm overflow-hidden divide-y-2 divide-slate-200">

                
                <!-- Toggle 3: Tampilkan Profil ke Publik (Aktif) -->
                <div class="flex items-center justify-between p-4">
                <!-- Toggle 1: Tampilkan Profil ke Publik -->
                <div class="flex items-center justify-between p-4.5">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Tampilkan Profil ke Publik</span>
                        <div>
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900">Tampilkan Profil ke Teman Sekelas</span>
                            <p class="text-xs text-slate-500 font-semibold">Mengizinkan teman sekelas melihat foto dan statistik belajar Anda.</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                </div>

                <!-- Toggle 4: Bagikan Progres Mingguan (Non-aktif) -->
                <div class="flex items-center justify-between p-4">
                <!-- Toggle 2: Notifikasi Tugas Baru -->
                <div class="flex items-center justify-between p-4.5">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Bagikan Progres Mingguan</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                </div>

                <!-- Toggle 5: Sembunyikan Peringkat Kelas (Non-aktif) -->
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411l0 0L21 21"/></svg>
                        <div>
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900">Notifikasi Tugas & Kuis</span>
                            <p class="text-xs text-slate-500 font-semibold">Dapatkan pemberitahuan saat guru menerbitkan tugas atau materi baru.</p>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Sembunyikan Peringkat Kelas</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                </div>

            </div>
        </div>

        <!-- Section: TENTANG CAKRAWALA -->
        <!-- Section: KELUAR & AKUN -->
        <div class="space-y-3">
            <h3 class="text-[10px] font-black uppercase tracking-wider text-slate-400 px-1">Tentang Cakrawala</h3>
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden divide-y divide-slate-50">
                
                <!-- Menu 2: Kebijakan Privasi -->
                <a href="{{ url('/') }}" class="flex items-center justify-between p-4 hover:bg-slate-50/80 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-600 px-1">Sesi & Akun</h3>
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm overflow-hidden">
                <form method="POST" action="{{ route('siswa.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-between p-4.5 hover:bg-rose-50 transition-all text-left">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </div>
                            <div>
                                <span class="text-xs sm:text-sm font-extrabold text-rose-600">Keluar dari Akun Siswa</span>
                                <p class="text-xs text-slate-500 font-semibold">Akhiri sesi belajar Anda di perangkat ini secara aman.</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Kebijakan Privasi</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Menu 3: Syarat dan Ketentuan -->
                <a href="{{ url('/') }}" class="flex items-center justify-between p-4 hover:bg-slate-50/80 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Syarat dan Ketentuan</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Info 1: Versi Aplikasi -->
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Versi Aplikasi</span>
                    </div>
                    <span class="text-xs font-bold text-slate-400">v2.4.1 (Stable)</span>
                </div>

                <!-- Menu Berbahaya: Hapus Akun Permanen -->
                <a href="{{ route('siswa.login') }}" class="flex items-center justify-between p-4 hover:bg-rose-50/40 transition-all group">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </div>
                        <span class="text-xs font-bold text-rose-600">Hapus Akun Permanen</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-rose-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                        <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </form>
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>