<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas yang Anda Ajar | Cakrawala Educentre</title>
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
        <div class="space-y-1.5 pt-2">
            <div class="flex items-center space-x-1.5">
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Kelas yang Anda Ajar</h1>
                <span class="text-base" title="Buku Kelas">📚</span>
            </div>
            <p class="text-xs text-slate-500 font-medium leading-relaxed">
                Daftar kelas aktif, buat sesi belajar, dan pantau progres belajar siswa Anda.
            </p>
        </div>

        <!-- Kolom Pencarian -->
        <div class="relative flex items-center bg-white rounded-2xl border border-slate-200 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
            <span class="absolute left-4 text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" placeholder="Cari kode kelas, mata pelajaran, atau jenjang..." class="w-full bg-transparent text-xs font-bold text-slate-800 placeholder-slate-400 pl-11 pr-4 py-3.5 focus:outline-none">
        </div>

        <!-- Filter Tab Kategori -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 scrollbar-none">
            <button class="px-4 py-2 bg-indigo-600 text-white font-bold text-xs rounded-full shadow-md shadow-indigo-100 flex-shrink-0">
                Semua Kelas
            </button>
            <button class="px-4 py-2 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 font-bold text-xs rounded-full shadow-sm transition-all flex-shrink-0">
                Fisika (4)
            </button>
            <button class="px-4 py-2 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 font-bold text-xs rounded-full shadow-sm transition-all flex-shrink-0">
                Matematika (1)
            </button>
        </div>

        <!-- Daftar Kartu Kelas -->
        <div class="space-y-3.5">
            
            <!-- Kartu Kelas 1: Fisika XI - IPA 2 -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-3.5 hover:border-indigo-100 transition-all group cursor-pointer">
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-black bg-indigo-50 text-indigo-600 tracking-wider">
                        FISIKA XI
                    </span>
                    <span class="text-xs font-bold text-slate-400">36 Siswa</span>
                </div>

                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-black text-slate-900 group-hover:text-indigo-600 transition-colors">Fisika XI – IPA 2</h3>
                </div>

                <div class="space-y-1.5 pt-1">
                    <div class="flex items-center justify-between text-[11px] font-medium">
                        <span class="text-slate-400">Progres Kurikulum Merdeka</span>
                        <span class="font-bold text-indigo-600">Bab 2 dari 4 (50%)</span>
                    </div>
                    <!-- Progress Bar Indigo -->
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-indigo-600 h-full rounded-full" style="width: 50%;"></div>
                    </div>
                </div>
            </div>

            <!-- Kartu Kelas 2: Fisika XII - IPA 1 -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-3.5 hover:border-rose-100 transition-all group cursor-pointer">
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-black bg-rose-50 text-rose-600 tracking-wider">
                        FISIKA XII
                    </span>
                    <span class="text-xs font-bold text-slate-400">40 Siswa</span>
                </div>

                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-black text-slate-900 group-hover:text-rose-600 transition-colors">Fisika XII – IPA 1</h3>
                </div>

                <div class="space-y-1.5 pt-1">
                    <div class="flex items-center justify-between text-[11px] font-medium">
                        <span class="text-slate-400">Progres Ujian Nasional</span>
                        <span class="font-bold text-rose-600">Bab 4 dari 6 (75%)</span>
                    </div>
                    <!-- Progress Bar Rose -->
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-rose-500 h-full rounded-full" style="width: 75%;"></div>
                    </div>
                </div>
            </div>

            <!-- Kartu Kelas 3: Matematika XII - IPS 1 -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-3.5 hover:border-emerald-100 transition-all group cursor-pointer">
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-black bg-emerald-50 text-emerald-600 tracking-wider">
                        MATEMATIKA XII
                    </span>
                    <span class="text-xs font-bold text-slate-400">32 Siswa</span>
                </div>

                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-black text-slate-900 group-hover:text-emerald-600 transition-colors">Matematika XII – IPS 1</h3>
                </div>

                <div class="space-y-1.5 pt-1">
                    <div class="flex items-center justify-between text-[11px] font-medium">
                        <span class="text-slate-400">Progres Aljabar Linear</span>
                        <span class="font-bold text-emerald-600">Bab 1 dari 5 (20%)</span>
                    </div>
                    <!-- Progress Bar Emerald -->
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-emerald-500 h-full rounded-full" style="width: 20%;"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>