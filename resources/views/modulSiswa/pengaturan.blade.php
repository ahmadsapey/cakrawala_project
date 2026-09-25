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
<body class="bg-gradient-to-br from-indigo-50/50 via-sky-50/30 to-purple-50/50 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2 flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Pengaturan & Keamanan</h1>
                <p class="text-xs font-bold text-slate-500 mt-0.5">Kelola kata sandi, privasi, dan preferensi akun Anda.</p>
            </div>
            <a href="{{ route('siswa.profile') }}" class="px-5 py-2.5 bg-white/80 backdrop-blur-sm border border-indigo-200 rounded-2xl text-xs font-black text-slate-700 hover:bg-indigo-50/50 transition-all shadow-sm">
                Kembali ke Profil
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50/90 backdrop-blur-sm border border-emerald-200 text-emerald-800 rounded-2xl text-xs sm:text-sm font-extrabold flex items-center space-x-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 bg-rose-50/90 backdrop-blur-sm border border-rose-200 text-rose-800 rounded-2xl text-xs font-extrabold space-y-1 shadow-sm">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Section: KEAMANAN AKUN (Ubah Kata Sandi) -->
        <div class="space-y-3">
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-500 px-1">Keamanan Akun</h3>
            <form method="POST" action="{{ route('siswa.pengaturan.update') }}" class="bg-white/85 backdrop-blur-sm rounded-3xl border border-indigo-100 shadow-sm p-6 sm:p-8 space-y-5">
                @csrf
                @method('PUT')

                <div class="flex items-center space-x-3.5 pb-2 border-b border-indigo-50">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center shrink-0 shadow-2xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-black text-slate-900">Ubah Kata Sandi Baru</h4>
                        <p class="text-xs font-bold text-slate-500">Pastikan menggunakan kombinasi sandi yang kuat dan aman.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label for="password" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Kata Sandi Baru *</label>
                        <input type="password" id="password" name="password" required minlength="6" placeholder="Minimal 6 karakter" class="w-full bg-white/80 text-xs sm:text-sm font-bold text-slate-900 px-4 py-3 border border-indigo-200 rounded-2xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all shadow-2xs">
                    </div>

                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Konfirmasi Kata Sandi Baru *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6" placeholder="Ketik ulang kata sandi baru" class="w-full bg-white/80 text-xs sm:text-sm font-bold text-slate-900 px-4 py-3 border border-indigo-200 rounded-2xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all shadow-2xs">
                    </div>
                </div>

                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs rounded-2xl shadow-md shadow-indigo-200 transition-all">
                    Simpan Kata Sandi Baru
                </button>
            </form>
        </div>

        <!-- Section: PRIVASI & PREFERENSI AKUN -->
        <div class="space-y-3">
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-500 px-1">Privasi & Preferensi Akun</h3>
            <div class="bg-white/85 backdrop-blur-sm rounded-3xl border border-indigo-100 shadow-sm overflow-hidden divide-y divide-indigo-50">
                
                <!-- Toggle 1: Tampilkan Profil ke Teman Sekelas -->
                <div class="flex items-center justify-between p-4.5 sm:p-5">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center shrink-0 shadow-2xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <div>
                            <span class="text-xs sm:text-sm font-black text-slate-900 block">Tampilkan Profil ke Teman Sekelas</span>
                            <p class="text-xs font-bold text-slate-500">Mengizinkan teman sekelas melihat foto dan statistik belajar Anda.</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                </div>

                <!-- Toggle 2: Notifikasi Tugas & Kuis -->
                <div class="flex items-center justify-between p-4.5 sm:p-5">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center shrink-0 shadow-2xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <div>
                            <span class="text-xs sm:text-sm font-black text-slate-900 block">Notifikasi Tugas & Materi</span>
                            <p class="text-xs font-bold text-slate-500">Dapatkan pemberitahuan saat guru menerbitkan tugas atau materi baru.</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                </div>

            </div>
        </div>

        <!-- Section: TENTANG CAKRAWALA & KELUAR -->
        <div class="space-y-3">
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-500 px-1">Tentang Cakrawala & Sesi</h3>
            <div class="bg-white/85 backdrop-blur-sm rounded-3xl border border-indigo-100 shadow-sm overflow-hidden divide-y divide-indigo-50">
                
                <!-- Menu 1: Kebijakan Privasi -->
                <a href="{{ url('/') }}" class="flex items-center justify-between p-4.5 sm:p-5 hover:bg-indigo-50/40 transition-all group">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-slate-800">Kebijakan Privasi</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Menu 2: Syarat dan Ketentuan -->
                <a href="{{ url('/') }}" class="flex items-center justify-between p-4.5 sm:p-5 hover:bg-indigo-50/40 transition-all group">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-slate-800">Syarat dan Ketentuan</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <!-- Info: Versi Aplikasi -->
                <div class="flex items-center justify-between p-4.5 sm:p-5">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center shadow-2xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-slate-800">Versi Aplikasi</span>
                    </div>
                    <span class="px-3 py-1 bg-indigo-50 border border-indigo-200 text-indigo-700 font-extrabold text-xs rounded-xl">v2.4.1 (Stable)</span>
                </div>

                <!-- Form Logout -->
                <form method="POST" action="{{ route('siswa.logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-between p-4.5 sm:p-5 hover:bg-rose-50/70 transition-all group text-left">
                        <div class="flex items-center space-x-3.5">
                            <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </div>
                            <div>
                                <span class="text-xs sm:text-sm font-black text-rose-600 block">Keluar dari Akun Siswa</span>
                                <p class="text-xs font-bold text-slate-500">Akhiri sesi belajar Anda di perangkat ini secara aman.</p>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-rose-400 group-hover:text-rose-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </form>

                <!-- Menu Berbahaya: Hapus Akun Permanen -->
                <a href="{{ route('siswa.login') }}" class="flex items-center justify-between p-4.5 sm:p-5 hover:bg-rose-50/70 transition-all group">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center group-hover:scale-105 transition-transform shadow-2xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-rose-600">Hapus Akun Permanen</span>
                    </div>
                    <svg class="w-4 h-4 text-rose-400 group-hover:text-rose-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>