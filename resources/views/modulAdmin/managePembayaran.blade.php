<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pembayaran | Cakrawala Educentre</title>
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
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Pembayaran</h1>
        </div>

        <!-- Kolom Pencarian -->
        <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-3.5 flex items-center space-x-3">
            <div class="text-slate-400 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" placeholder="Cari nama mahasiswa atau No. Invoice..." class="w-full bg-transparent text-xs sm:text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none">
        </div>

        <!-- Filter Tab (Semua, Lunas, Belum Lunas) -->
        <div class="flex items-center space-x-2 overflow-x-auto no-scrollbar">
            <button class="px-5 py-2.5 bg-indigo-600 text-white font-extrabold text-xs rounded-xl shadow-md border border-indigo-700 flex-shrink-0 transition-all">Semua</button>
            <button class="px-5 py-2.5 bg-white border-2 border-slate-300 text-slate-700 font-bold text-xs rounded-xl hover:bg-slate-50 flex-shrink-0 transition-all">Lunas</button>
            <button class="px-5 py-2.5 bg-white border-2 border-slate-300 text-slate-700 font-bold text-xs rounded-xl hover:bg-slate-50 flex-shrink-0 transition-all">Belum Lunas</button>
        </div>

        <!-- Daftar Kartu Pembayaran -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <!-- Pembayaran 1: Bintang Cakrawala (Lunas) -->
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-4.5 flex items-center justify-between space-x-3 hover:border-indigo-600 transition-all">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center flex-shrink-0 font-bold shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div class="space-y-0.5 truncate">
                        <div class="flex items-center space-x-2">
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">Bintang Cakrawala</h3>
                            <span class="text-xs font-extrabold text-indigo-700">Rp 1.500.000</span>
                        </div>
                        <p class="text-xs text-slate-600 font-medium truncate">#INV-2026-0012 • SPP Semester 1 (24 Jul 2026)</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-extrabold rounded-lg flex-shrink-0">Lunas</span>
            </div>

            <!-- Pembayaran 2: Siti Aminah (Lunas) -->
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-4.5 flex items-center justify-between space-x-3 hover:border-indigo-600 transition-all">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center flex-shrink-0 font-bold shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div class="space-y-0.5 truncate">
                        <div class="flex items-center space-x-2">
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">Siti Aminah</h3>
                            <span class="text-xs font-extrabold text-indigo-700">Rp 350.000</span>
                        </div>
                        <p class="text-xs text-slate-600 font-medium truncate">#INV-2026-0015 • Uang Praktikum (18 Jul 2026)</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-extrabold rounded-lg flex-shrink-0">Lunas</span>
            </div>

            <!-- Pembayaran 3: Rian Hidayat (Belum Lunas) -->
            <div class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-4.5 flex items-center justify-between space-x-3 hover:border-indigo-600 transition-all">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 border border-amber-300 flex items-center justify-center flex-shrink-0 font-bold shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div class="space-y-0.5 truncate">
                        <div class="flex items-center space-x-2">
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">Rian Hidayat</h3>
                            <span class="text-xs font-extrabold text-amber-700">Rp 1.500.000</span>
                        </div>
                        <p class="text-xs text-slate-600 font-medium truncate">#INV-2026-0021 • SPP Semester 1 (20 Jul 2026)</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-amber-100 border border-amber-300 text-amber-800 text-xs font-extrabold rounded-lg flex-shrink-0">Belum Lunas</span>
            </div>


            <!-- Pembayaran 4: Dewi Lestari (Lunas) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 flex items-center justify-between space-x-3">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <div class="w-11 h-11 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0 font-bold shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div class="space-y-0.5 truncate">
                        <div class="flex items-center space-x-2">
                            <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Dewi Lestari</h3>
                            <span class="text-xs font-black text-indigo-600">Rp 450.000</span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-medium truncate">#INV-2026-0024 • Buku Paket K-13 (10 Jul 2026)</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full flex-shrink-0">Lunas</span>
            </div>

            <!-- Pembayaran 5: Adi Wijaya (Tunggakan) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 flex items-center justify-between space-x-3">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <div class="w-11 h-11 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-bold shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div class="space-y-0.5 truncate">
                        <div class="flex items-center space-x-2">
                            <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Adi Wijaya</h3>
                            <span class="text-xs font-black text-rose-600">Rp 1.500.000</span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-medium truncate">#INV-2026-0032 • SPP Semester (10 Jul 2026)</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-rose-50 text-rose-600 text-[10px] font-black rounded-full flex-shrink-0">Tunggakan</span>
            </div>

        </div>

        <!-- Tombol Floating Action (Tambah Pembayaran / Invoice) -->
        <div class="fixed bottom-24 right-4 z-50 md:bottom-8 md:right-8 lg:right-12">
            <button class="w-14 h-14 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow-lg shadow-indigo-300 flex items-center justify-center transition-all hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            </button>
        </div>

    </div>

    @include('components.footerMobile_admin')

</body>
</html>