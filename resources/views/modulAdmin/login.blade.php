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
</head>
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    <!-- Container Utama -->
    <div class="max-w-md mx-auto min-h-screen bg-[#F8FAFC] flex flex-col justify-between p-4 sm:p-6 relative shadow-2xl">

        <!-- Bagian Atas: Header & Form -->
        <div class="space-y-6 pt-4">
            
            <!-- Header Halaman -->
            <div class="space-y-1.5">
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Admin Panel</h1>
                <p class="text-xs text-slate-500 font-medium leading-relaxed">
                    Masuk untuk mengelola kelas, bahan ajar, dan memeriksa tugas siswa.
                </p>
            </div>

            <!-- Form Login -->
            <div class="space-y-4">
                
                <!-- Input 1: Email Resmi Guru / NUPTK -->
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Email Resmi Guru / NUPTK</label>
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-3.5 flex items-center space-x-3">
                        <div class="text-slate-400 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="text" placeholder="Contoh: budi.utomo@cakrawala.edu" class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder:text-slate-300 focus:outline-none">
                    </div>
                </div>

                <!-- Input 2: Kata Sandi -->
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Kata Sandi</label>
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-3.5 flex items-center justify-between space-x-3">
                        <div class="flex items-center space-x-3 w-full">
                            <div class="text-slate-400 flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" value="Masukan kata sandi akun Anda" class="w-full bg-transparent text-xs font-medium text-slate-800 focus:outline-none">
                        </div>
                        <button class="text-slate-400 hover:text-slate-600 transition-colors flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Link Lupa Kata Sandi -->
                <div class="flex justify-end pt-1 px-1">
                    <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors">Lupa Kata Sandi ?</a>
                </div>

            </div>

        </div>

        <!-- Tombol Aksi Utama di Bawah -->
        <div class="pt-6">
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                <span>Masuk Sekarang &rarr;</span>
            </button>
        </div>

    </div>

</body>
</html>