<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Siswa | Cakrawala Educentre</title>
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
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerAdmin')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-5 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2">
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Siswa</h1>
        </div>

        <!-- Kolom Pencarian -->
        <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-3.5 flex items-center space-x-3">
            <div class="text-slate-400 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" placeholder="Cari nama mahasiswa atau NISN..." class="w-full bg-transparent text-xs sm:text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none">
        </div>

        <!-- Filter Tab (Semua, Aktif, Tidak Aktif) -->
        <div class="flex items-center space-x-2 overflow-x-auto no-scrollbar">
            <button class="px-5 py-2.5 bg-indigo-600 text-white font-extrabold text-xs rounded-xl shadow-md border border-indigo-700 flex-shrink-0 transition-all">Semua</button>
            <button class="px-5 py-2.5 bg-white border-2 border-slate-300 text-slate-700 font-bold text-xs rounded-xl hover:bg-slate-50 flex-shrink-0 transition-all">Aktif</button>
            <button class="px-5 py-2.5 bg-white border-2 border-slate-300 text-slate-700 font-bold text-xs rounded-xl hover:bg-slate-50 flex-shrink-0 transition-all">Tidak Aktif</button>
        </div>

        <!-- Daftar Kartu Siswa -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <!-- Siswa 1: Budi Santoso (Aktif) -->
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-4.5 flex items-center justify-between space-x-3 hover:border-indigo-600 transition-all">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150" alt="Budi Santoso" class="w-12 h-12 rounded-xl object-cover flex-shrink-0 shadow-sm border border-slate-300">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">Budi Santoso</h3>
                        <p class="text-xs text-slate-600 font-semibold truncate">NISN: 0082718291 • Kelas XII - IPA 2</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-extrabold rounded-lg flex-shrink-0">Aktif</span>
            </div>

            <!-- Siswa 2: Siti Aminah (Aktif) -->
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-4.5 flex items-center justify-between space-x-3 hover:border-indigo-600 transition-all">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=150" alt="Siti Aminah" class="w-12 h-12 rounded-xl object-cover flex-shrink-0 shadow-sm border border-slate-300">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">Siti Aminah</h3>
                        <p class="text-xs text-slate-600 font-semibold truncate">NISN: 0082718105 • Kelas XI - IPS 1</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-extrabold rounded-lg flex-shrink-0">Aktif</span>
            </div>

            <!-- Siswa 3: Rian Hidayat (Tidak Aktif) -->
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-4.5 flex items-center justify-between space-x-3 hover:border-indigo-600 transition-all">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150" alt="Rian Hidayat" class="w-12 h-12 rounded-xl object-cover flex-shrink-0 shadow-sm border border-slate-300">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">Rian Hidayat</h3>
                        <p class="text-xs text-slate-600 font-semibold truncate">NISN: 0082718304 • Kelas XII - IPA 1</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-rose-100 border border-rose-300 text-rose-800 text-xs font-extrabold rounded-lg flex-shrink-0">Tidak Aktif</span>
            </div>

            <!-- Siswa 4: Dewi Lestari (Aktif) -->
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-4.5 flex items-center justify-between space-x-3 hover:border-indigo-600 transition-all">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150" alt="Dewi Lestari" class="w-12 h-12 rounded-xl object-cover flex-shrink-0 shadow-sm border border-slate-300">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">Dewi Lestari</h3>
                        <p class="text-xs text-slate-600 font-semibold truncate">NISN: 0082718159 • Kelas XII - IPS 3</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-extrabold rounded-lg flex-shrink-0">Aktif</span>
            </div>


            <!-- Siswa 5: Adi Wijaya (Aktif) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 flex items-center justify-between space-x-3">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150" alt="Adi Wijaya" class="w-12 h-12 rounded-2xl object-cover flex-shrink-0 shadow-sm">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Adi Wijaya</h3>
                        <p class="text-[10px] text-slate-400 font-medium truncate">NISN: 0082718223 • Kelas X - IPA 3</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full flex-shrink-0">Aktif</span>
            </div>

        </div>

        <!-- Tombol Floating Action (Tambah Siswa) -->
        <div class="fixed bottom-24 right-4 z-50 md:bottom-8 md:right-8 lg:right-12">
            <button class="w-14 h-14 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow-lg shadow-indigo-300 flex items-center justify-center transition-all hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            </button>
        </div>

    </div>

    @include('components.footerMobile_admin')

</body>
</html>