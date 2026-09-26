<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Cakrawala Educentre</title>
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

<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    <!-- Container Utama -->
    <div
        class="max-w-md mx-auto min-h-screen bg-[#F8FAFC] flex flex-col justify-between p-4 sm:p-6 relative shadow-2xl">

        <!-- Bagian Atas: Header & Form -->
        <div class="space-y-6 pt-4">

            <div class="flex items-center gap-3">
                <img src="{{ $brandContent?->image_url ?? asset('images/logoCakrawala.png') }}" alt="Logo {{ $brandContent?->title ?? 'Cakrawala Educentre' }}" class="h-10 w-10 object-contain">
                <span class="text-sm font-black uppercase tracking-tight text-slate-900">{{ $brandContent?->title ?? 'Cakrawala Educentre' }}</span>
            </div>

            <!-- Header Halaman -->
            <div class="space-y-1.5">
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Admin Panel</h1>
                <p class="text-xs text-slate-500 font-medium leading-relaxed">
                    Masuk untuk mengelola kelas, bahan ajar, dan memeriksa tugas siswa.
                </p>
            </div>

            <!-- Form Login -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf
                @if ($errors->any())
                    <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Input 1: Email Resmi Guru / Admin -->
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Email Resmi
                        Admin</label>
                    <div
                        class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-3.5 flex items-center space-x-3">
                        <div class="text-slate-400 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="Contoh: admin@cakrawala.edu"
                            class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder:text-slate-300 focus:outline-none">
                    </div>
                </div>

                <!-- Input 2: Kata Sandi -->
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Kata Sandi</label>
                    <div
                        class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-3.5 flex items-center justify-between space-x-3">
                        <div class="flex items-center space-x-3 w-full">
                            <div class="text-slate-400 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" required placeholder="Masukkan kata sandi akun Anda"
                                class="w-full bg-transparent text-xs font-medium text-slate-800 focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Utama di Bawah -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                        <span>Masuk Sekarang &rarr;</span>
                    </button>
                </div>
            </form>

        </div>

</body>

</html>