<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil | Cakrawala Educentre</title>
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
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Edit Profil</h1>
        </div>

        <!-- Bagian Foto Profil & Tombol Ubah -->
        <div class="flex flex-col items-center justify-center space-y-2 pt-1">
            <div class="relative group">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" alt="Foto Profil" class="w-20 h-20 rounded-full object-cover shadow-md border-2 border-white">
                <div class="absolute inset-0 rounded-full bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
            <button class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                Ubah Foto Profil
            </button>
        </div>

        <!-- Form Input Data Pengguna -->
        <div class="space-y-4">
            
            <!-- Input 1: Nama Lengkap -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Nama Lengkap</label>
                <div class="relative flex items-center bg-white rounded-2xl border border-slate-200 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                    <input type="text" value="Bintang Cakrawala" class="w-full bg-transparent text-xs font-bold text-slate-800 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

            <!-- Input 2: NISN -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">NISN</label>
                <div class="relative flex items-center bg-white rounded-2xl border border-slate-200 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                    </span>
                    <input type="text" value="0082718291" class="w-full bg-transparent text-xs font-bold text-slate-800 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

            <!-- Input 3: Alamat Email -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Alamat Email</label>
                <div class="relative flex items-center bg-white rounded-2xl border border-slate-200 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    <input type="email" value="bintang@cakrawala.sch.id" class="w-full bg-transparent text-xs font-bold text-slate-800 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

            <!-- Input 4: Nomor Telepon -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Nomor Telepon</label>
                <div class="relative flex items-center bg-white rounded-2xl border border-slate-200 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </span>
                    <input type="text" value="+62 812 3456 7890" class="w-full bg-transparent text-xs font-bold text-slate-800 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

            <!-- Input 5: Sekolah -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Sekolah</label>
                <div class="relative flex items-center bg-white rounded-2xl border border-slate-200 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.16 3.422A12.083 12.083 0 015.84 10.578L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"/></svg>
                    </span>
                    <input type="text" value="SMA Negeri 1 Harapan Bangsa" class="w-full bg-transparent text-xs font-bold text-slate-800 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

        </div>

        <!-- Tombol Simpan Perubahan -->
        <div class="pt-4">
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all text-center">
                Simpan Perubahan
            </button>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>