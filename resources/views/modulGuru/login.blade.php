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
    @include('components.fonts')
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white flex items-center justify-center min-h-screen p-4 sm:p-6">

    <!-- Container Utama -->
    <div class="w-full max-w-md bg-white rounded-2xl border-2 border-slate-200 shadow-xl p-6 sm:p-8 space-y-6 relative">

        <div class="flex items-center gap-3">
            <img src="{{ $brandContent?->image_url ?? asset('images/logoCakrawala.png') }}" alt="Logo {{ $brandContent?->title ?? 'Cakrawala Educentre' }}" class="h-10 w-10 object-contain">
            <span class="text-sm font-black uppercase tracking-tight text-slate-900">{{ $brandContent?->title ?? 'Cakrawala Educentre' }}</span>
        </div>

        <!-- Header: Judul & Subjudul -->
        <div class="space-y-1.5 pt-2">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang, Guru!</h1>
            <p class="text-xs sm:text-sm text-slate-600 font-semibold leading-relaxed">
                Masuk untuk mengelola kelas, bahan ajar, dan memeriksa tugas siswa.
            </p>
        </div>

        <!-- Form Kartu Utama -->
        <form method="POST" action="{{ route('guru.login.submit') }}" class="space-y-5">
            @csrf
            @if ($errors->any())<div class="rounded-xl border-2 border-rose-300 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700">{{ $errors->first() }}</div>@endif

            <!-- Input 1: Email Resmi Guru / NUPTK -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Email Resmi Guru / NUPTK</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Contoh: budi.utomo@cakrawala.edu" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 placeholder-slate-400 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>
            </div>

            <!-- Input 2: Kata Sandi -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Kata Sandi</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <input type="password" name="password" required placeholder="Masukkan kata sandi akun Anda" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 placeholder-slate-400 pl-11 pr-11 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    <!-- Tombol Toggle Lihat Password -->
                    <button type="button" class="absolute right-4 text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
                <!-- Lupa Kata Sandi -->
                <div class="flex justify-end pt-1">
                    <a href="{{ route('guru.login') }}" class="text-xs font-bold text-indigo-600 hover:underline transition-colors">
                        Lupa Kata Sandi Guru?
                    </a>
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs sm:text-sm rounded-xl border border-indigo-700 shadow-md transition-all flex items-center justify-center space-x-2">
                <span>Masuk Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>

    </div>

</body>
</html>
