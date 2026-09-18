<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Guru | Cakrawala Educentre</title>
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

    @include('components.headerAdmin')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-md flex-col space-y-5 bg-[#F8FAFC] p-4 sm:p-6 md:max-w-7xl md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Manajemen Guru</h1>
        </div>

        <!-- Kolom Pencarian -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-3.5 flex items-center space-x-3">
            <div class="text-slate-400 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" placeholder="Cari nama guru atau NIP..." class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder:text-slate-400 focus:outline-none">
        </div>

        <!-- Filter Tab (Semua, Aktif, Tidak Aktif) -->
        <div class="flex items-center space-x-2 overflow-x-auto no-scrollbar">
            <button class="px-4 py-2 bg-indigo-600 text-white font-bold text-xs rounded-full shadow-md shadow-indigo-100 flex-shrink-0 transition-all">Semua</button>
            <button class="px-4 py-2 bg-white border border-slate-200/80 text-slate-600 font-bold text-xs rounded-full hover:bg-slate-50 flex-shrink-0 transition-all">Aktif</button>
            <button class="px-4 py-2 bg-white border border-slate-200/80 text-slate-600 font-bold text-xs rounded-full hover:bg-slate-50 flex-shrink-0 transition-all">Tidak Aktif</button>
        </div>

        <!-- Daftar Kartu Guru -->
        <div class="space-y-3">
            
            <!-- Guru 1: Kak Dr. Lutfi (Aktif) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 flex items-center justify-between space-x-3">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150" alt="Kak Dr. Lutfi" class="w-12 h-12 rounded-2xl object-cover flex-shrink-0 shadow-sm">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Kak Dr. Lutfi</h3>
                        <p class="text-[10px] text-slate-400 font-medium truncate">NIP: 19820412200 • Fisika</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full flex-shrink-0">Aktif</span>
            </div>

            <!-- Guru 2: Kak Sherly M.Si (Aktif) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 flex items-center justify-between space-x-3">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150" alt="Kak Sherly M.Si" class="w-12 h-12 rounded-2xl object-cover flex-shrink-0 shadow-sm">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Kak Sherly M.Si</h3>
                        <p class="text-[10px] text-slate-400 font-medium truncate">NIP: 19890311200 • Matematika</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full flex-shrink-0">Aktif</span>
            </div>

            <!-- Guru 3: Kak Prof. Handoko (Aktif) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 flex items-center justify-between space-x-3">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150" alt="Kak Prof. Handoko" class="w-12 h-12 rounded-2xl object-cover flex-shrink-0 shadow-sm">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Kak Prof. Handoko</h3>
                        <p class="text-[10px] text-slate-400 font-medium truncate">NIP: 19721014199 • Kimia</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full flex-shrink-0">Aktif</span>
            </div>

            <!-- Guru 4: Bpk. Ahmad Fauzi (Tidak Aktif) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 flex items-center justify-between space-x-3">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150" alt="Bpk. Ahmad Fauzi" class="w-12 h-12 rounded-2xl object-cover flex-shrink-0 shadow-sm">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Bpk. Ahmad Fauzi</h3>
                        <p class="text-[10px] text-slate-400 font-medium truncate">NIP: 19900824201 • Bahasa Indonesia</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-rose-50 text-rose-600 text-[10px] font-black rounded-full flex-shrink-0">Tidak Aktif</span>
            </div>

            <!-- Guru 5: Ibu Sari Indah (Aktif) -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 flex items-center justify-between space-x-3">
                <div class="flex items-center space-x-3.5 min-w-0">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150" alt="Ibu Sari Indah" class="w-12 h-12 rounded-2xl object-cover flex-shrink-0 shadow-sm">
                    <div class="space-y-0.5 truncate">
                        <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Ibu Sari Indah</h3>
                        <p class="text-[10px] text-slate-400 font-medium truncate">NIP: 19880115201 • Biologi</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full flex-shrink-0">Aktif</span>
            </div>

        </div>

        <!-- Tombol Floating Action (Tambah Guru) -->
        <div class="fixed bottom-6 right-4 sm:right-[calc(50%-13rem)] z-50">
            <button class="w-14 h-14 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow-lg shadow-indigo-300 flex items-center justify-center transition-all hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            </button>
        </div>

    </div>

    @include('components.footerMobile_admin')

</body>
</html>