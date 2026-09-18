<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru | Cakrawala Educentre</title>
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
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white flex items-center justify-center min-h-screen p-4 sm:p-6">

    <!-- Container Utama -->
    <div class="w-full max-w-md bg-[#F8FAFC] flex flex-col p-2 sm:p-4 space-y-6 relative">

        <!-- Header: Judul & Subjudul -->
        <div class="space-y-1.5 pt-2">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Selamat Datang, Guru!</h1>
            <p class="text-xs text-slate-500 font-medium leading-relaxed">
                Masuk untuk mengelola kelas, bahan ajar, dan memeriksa tugas siswa.
            </p>
        </div>

        <!-- Form Kartu Utama -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100 p-5 sm:p-6 space-y-5">
            
            <!-- Input 1: Email Resmi Guru / NUPTK -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Email Resmi Guru / NUPTK</label>
                <div class="relative flex items-center bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    <input type="text" placeholder="Contoh: budi.utomo@cakrawala.edu" class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder-slate-400 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

            <!-- Input 2: Kata Sandi -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Kata Sandi</label>
                <div class="relative flex items-center bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <input type="password" placeholder="Masukkan kata sandi akun Anda" class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder-slate-400 pl-11 pr-11 py-3.5 focus:outline-none">
                    <!-- Tombol Toggle Lihat Password -->
                    <button type="button" class="absolute right-4 text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
                <!-- Lupa Kata Sandi -->
                <div class="flex justify-end pt-1">
                    <a href="{{ route('guru.login') }}" class="text-[11px] font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                        Lupa Kata Sandi Guru?
                    </a>
                </div>
            </div>

        </div>

        <!-- Tombol Aksi & Alternatif -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100 p-5 sm:p-6 space-y-4">
            
            <!-- Tombol Masuk Sekarang -->
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                <span>Masuk Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>

            <!-- Pemisah: atau masuk dengan -->
            <div class="relative flex items-center justify-center pt-2">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                <span class="relative bg-white px-3 text-[11px] font-medium text-slate-400">atau masuk dengan</span>
            </div>

            <!-- Tombol Alternatif Login (Opsional / Tambahan Estetik) -->
            <button class="w-full py-3.5 bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-2xl border border-slate-200/60 transition-all flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
                <span>Akun Google SSO Guru</span>
            </button>

        </div>

        <!-- Footer: Pendaftaran Mitra -->
        <div class="text-center pt-2">
            <p class="text-xs text-slate-500 font-medium">
                Belum terdaftar sebagai mitra? <a href="{{ route('guru.register') }}" class="font-bold text-indigo-600 hover:text-indigo-700 transition-colors">Daftar Di Sini</a>
            </p>
        </div>

    </div>

</body>
</html>