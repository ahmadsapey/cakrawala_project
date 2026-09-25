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
            <img src="{{ $brandContent?->image_url ?? asset('images/logoCakrawala.png') }}" alt="Logo {{ $brandContent?->title ?? 'Cakrawala Educentre' }}" class="h-9 w-9 object-contain">
            <span class="text-sm font-extrabold tracking-wider text-slate-900 uppercase">{{ $brandContent?->title ?? 'Cakrawala Educentre' }}</span>
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
                    <label for="name" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Nama Siswa</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </span>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Contoh: Rayyan Pratama" class="w-full pl-11 pr-4 py-3 bg-white border-2 border-slate-300 rounded-xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
                </div>
            </div>

            <!-- Kata Sandi & Lupa Kata Sandi -->
                <div class="space-y-1.5">
                    <label for="nisn" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">NISN</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
                        <input id="nisn" type="text" name="nisn" value="{{ old('nisn') }}" required maxlength="20" inputmode="numeric" placeholder="Masukkan NISN" class="w-full pl-11 pr-4 py-3 bg-white border-2 border-slate-300 rounded-xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all">
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

     

        <!-- Footer Card / Navigasi Daftar -->
        <div class="mt-4 text-center text-xs font-medium text-slate-600">
             <a href="{{ route('siswa.register') }}" class="text-indigo-600 font-extrabold hover:underline">Belum punya akun?</a>
        </div>

    </div>

</body>
</html>
