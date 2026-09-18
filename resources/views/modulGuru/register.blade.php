<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabung sebagai Tutor | Cakrawala Educentre</title>
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
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white flex items-center justify-center min-h-screen p-4 sm:p-6 pb-12">

    <!-- Container Utama -->
    <div class="w-full max-w-md bg-[#F8FAFC] flex flex-col p-2 sm:p-4 space-y-6 relative">

        <!-- Header: Judul & Subjudul -->
        <div class="space-y-1.5 pt-2">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Gabung sebagai Tutor</h1>
            <p class="text-xs text-slate-500 font-medium leading-relaxed">
                Bagikan ilmu Anda dan bantu ribuan siswa mencapai impian akademis mereka.
            </p>
        </div>

        <!-- Form Kartu Utama -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100 p-5 sm:p-6 space-y-5">
            
            <!-- Input 1: Nama Lengkap & Gelar -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Nama Lengkap & Gelar</label>
                <div class="relative flex items-center bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                    <input type="text" placeholder="Contoh: Dr. Budi Santoso, M.Pd." class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder-slate-400 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

            <!-- Input 2: Spesialisasi Mata Pelajaran -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Spesialisasi Mata Pelajaran</label>
                <div class="relative flex items-center bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </span>
                    <input type="text" placeholder="Contoh: Fisika Kuantum & UTBK" class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder-slate-400 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

            <!-- Input 3: NUPTK / ID Guru (Opsional) -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">NUPTK / ID Guru <span class="text-slate-400 font-normal lowercase">(Opsional)</span></label>
                <div class="relative flex items-center bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round5" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                    </span>
                    <input type="text" placeholder="Contoh: 98127398127398" class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder-slate-400 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

            <!-- Input 4: Kata Sandi Baru -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Kata Sandi Baru</label>
                <div class="relative flex items-center bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <input type="password" placeholder="Minimal 8 karakter (kombinasi angka)" class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder-slate-400 pl-11 pr-11 py-3.5 focus:outline-none">
                    <button type="button" class="absolute right-4 text-slate-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
            </div>

            <!-- Checkbox Persetujuan -->
            <div class="flex items-start space-x-3 pt-1">
                <input type="checkbox" id="terms" checked class="mt-0.5 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 accent-indigo-600 cursor-pointer">
                <label for="terms" class="text-[11px] text-slate-500 font-medium leading-relaxed select-none cursor-pointer">
                    Saya menyetujui <a href="{{ url('/') }}" class="font-bold text-indigo-600 hover:underline">Pakta Integritas Mengajar</a> serta <a href="{{ url('/') }}" class="font-bold text-indigo-600 hover:underline">Aturan Kode Etik Akademik</a> di Cakrawala Educentre.
                </label>
            </div>

        </div>

        <!-- Tombol Aksi & Navigasi Masuk -->
        <div class="space-y-4 pt-1">
            
            <!-- Tombol Daftar sebagai Pengajar -->
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                <span>Daftar sebagai Pengajar</span>
                <span class="text-indigo-300">*</span>
            </button>

            <!-- Footer: Sudah punya akun guru? -->
            <div class="text-center pt-2">
                <p class="text-xs text-slate-500 font-medium">
                    Sudah punya akun guru? <a href="{{ route('guru.login') }}" class="font-bold text-indigo-600 hover:text-indigo-700 transition-colors">Masuk Sekarang</a>
                </p>
            </div>

        </div>

    </div>

</body>
</html>