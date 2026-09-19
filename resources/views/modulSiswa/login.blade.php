<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Cakrawala Educentre</title>
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
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">

    <!-- Container Form Login -->
    <div class="max-w-md w-full bg-white rounded-2xl p-8 sm:p-10 border-2 border-slate-200 shadow-xl relative">
        
        <!-- Logo / Nama Brand Kecil di Atas -->
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-sm border border-indigo-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
            </div>
            <span class="text-sm font-extrabold tracking-wider text-slate-900 uppercase">Cakrawala Educentre</span>
        </div>

        <!-- Header Judul -->
        <div class="mb-8 space-y-1.5">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang!</h1>
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed font-medium">Masuk untuk melanjutkan proses belajarmu di Cakrawala Educentre.</p>
        </div>

        <!-- Form Input -->
        <form class="space-y-5" action="{{ route('siswa.login.submit') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="rounded-xl border-2 border-rose-300 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700">{{ $errors->first() }}</div>
            @endif
            
            <!-- Email atau Nomor Handphone -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Email atau Nomor Handphone</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Contoh: rayyan@email.com" class="w-full pl-11 pr-4 py-3 bg-white border-2 border-slate-300 rounded-xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                </div>
            </div>

            <!-- Kata Sandi & Lupa Kata Sandi -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Kata Sandi</label>
                    <a href="{{ route('siswa.login') }}" class="text-xs font-bold text-indigo-600 hover:underline">Lupa Kata Sandi?</a>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
                    <input type="password" name="password" required placeholder="Masukkan kata sandi Anda" class="w-full pl-11 pr-12 py-3 bg-white border-2 border-slate-300 rounded-xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                    <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Tombol Aksi Masuk -->
            <button type="submit" class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs sm:text-sm rounded-xl border border-indigo-700 shadow-md transition-all flex items-center justify-center space-x-2">
                <span>Masuk Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>

        </form>

        <!-- Pemisah (Divider) -->
        <div class="relative flex py-6 items-center">
            <div class="flex-grow border-t-2 border-slate-200"></div>
            <span class="flex-shrink mx-4 text-slate-500 text-xs font-bold uppercase tracking-wider">atau masuk dengan</span>
            <div class="flex-grow border-t-2 border-slate-200"></div>
        </div>

        <!-- Footer Card / Navigasi Daftar -->
        <div class="mt-4 text-center text-xs font-medium text-slate-600">
            Belum punya akun? <a href="{{ route('siswa.register') }}" class="text-indigo-600 font-extrabold hover:underline">Daftar Di Sini</a>
        </div>

    </div>

</body>
</html>