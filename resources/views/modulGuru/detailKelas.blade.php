<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas & Progres | Cakrawala Educentre</title>
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

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-md flex-col space-y-5 bg-[#F8FAFC] p-4 sm:p-6 md:max-w-7xl md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Detail Kelas & Progres</h1>
        </div>

        <!-- Kartu Informasi Utama Kelas -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5 space-y-4">
            <div class="flex items-center space-x-2">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-indigo-50 text-indigo-600">
                    Kurikulum Merdeka
                </span>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-50 text-emerald-600">
                    Sesi Ke-12
                </span>
            </div>

            <div class="space-y-1">
                <h2 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Kelas XI – IPA 2: Fisika Modern</h2>
            </div>

            <div class="grid grid-cols-2 pt-2 border-t border-slate-50 gap-4">
                <div>
                    <div class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Total Siswa Terdaftar</div>
                    <div class="text-xs sm:text-sm font-black text-slate-800 mt-0.5">36 Siswa Aktif</div>
                </div>
                <div>
                    <div class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Progres Pembelajaran</div>
                    <div class="text-xs sm:text-sm font-black text-indigo-600 mt-0.5">65% Selesai</div>
                </div>
            </div>
        </div>

        <!-- Section: Lihat Daftar Siswa -->
        <div class="space-y-3">
            <div class="px-1 flex items-center justify-between">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-400">Lihat Daftar Siswa</h3>
                <a href="{{ route('guru.siswa') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors">Semua (36)</a>
            </div>

            <!-- List Avatar Siswa Horisontal -->
            <div class="flex items-center space-x-3 overflow-x-auto pb-1 scrollbar-none">
                
                <!-- Siswa 1 -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-3 flex items-center space-x-2.5 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80" alt="Rayyan P." class="w-8 h-8 rounded-full object-cover">
                    <span class="text-xs font-bold text-slate-800 pr-1">Rayyan P.</span>
                </div>

                <!-- Siswa 2 -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-3 flex items-center space-x-2.5 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Bintang C." class="w-8 h-8 rounded-full object-cover">
                    <span class="text-xs font-bold text-slate-800 pr-1">Bintang C.</span>
                </div>

                <!-- Siswa 3 -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-3 flex items-center space-x-2.5 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop&q=80" alt="Siti A." class="w-8 h-8 rounded-full object-cover">
                    <span class="text-xs font-bold text-slate-800 pr-1">Siti A.</span>
                </div>

            </div>
        </div>

        <!-- Section: Daftar Bab Pembelajaran -->
        <div class="space-y-3">
            <div class="px-1">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-400">Daftar Bab Pembelajaran</h3>
            </div>

            <div class="space-y-3">
                
                <!-- Bab 1: Selesai (Hijau) -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 flex items-start space-x-3.5 hover:border-emerald-100 transition-all">
                    <div class="w-6 h-6 rounded-lg bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 mt-0.5 shadow-sm shadow-emerald-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs font-black text-slate-900">01. Teori Kuantum Max Planck</h4>
                        <p class="text-[10px] text-emerald-600 font-bold">Sudah Diterbitkan • 100% Dibaca</p>
                    </div>
                </div>

                <!-- Bab 2: Sedang Berjalan (Indigo / Highlighted) -->
                <div class="bg-indigo-50/40 rounded-2xl border-2 border-indigo-500 shadow-sm p-4 flex items-start space-x-3.5 transition-all">
                    <div class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5 shadow-sm shadow-indigo-200">
                        <span class="text-xs font-bold">2</span>
                    </div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs font-black text-indigo-950">02. Eksperimen Efek Fotolistrik</h4>
                        <p class="text-[10px] text-indigo-600 font-bold">Sedang Berjalan • Live Sesi Hari Ini</p>
                    </div>
                </div>

                <!-- Bab 3: Belum Mulai (Abu-abu) -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 flex items-start space-x-3.5 hover:border-slate-200 transition-all">
                    <div class="w-6 h-6 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold">3</span>
                    </div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs font-black text-slate-700">03. Formulasi Foton Einstein</h4>
                        <p class="text-[10px] text-slate-400 font-medium">Belum Mulai • Dijadwalkan Pekan Depan</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>