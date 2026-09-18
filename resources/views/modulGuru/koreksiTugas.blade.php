<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koreksi Tugas | Cakrawala Educentre</title>
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
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Koreksi Tugas</h1>
        </div>

        <!-- Filter Tab Kategori -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 scrollbar-none">
            <button class="px-4 py-2.5 bg-indigo-600 text-white font-bold text-xs rounded-full shadow-md shadow-indigo-100 flex-shrink-0">
                Perlu Dinilai
            </button>
            <button class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 font-bold text-xs rounded-full shadow-sm transition-all flex-shrink-0">
                Tugas Aktif
            </button>
            <button class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 font-bold text-xs rounded-full shadow-sm transition-all flex-shrink-0">
                Draf & Selesai
            </button>
        </div>

        <!-- Statistik Ringkasan Kartu (2 Kolom) -->
        <div class="grid grid-cols-2 gap-3">
            
            <!-- Kartu 1: Total Tugas Masuk -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-1">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Tugas Masuk</span>
                <div class="flex items-baseline space-x-2">
                    <span class="text-xl sm:text-2xl font-black text-slate-900">38</span>
                    <span class="text-[10px] font-bold bg-amber-50 text-amber-600 px-2 py-0.5 rounded-full">Menunggu</span>
                </div>
            </div>

            <!-- Kartu 2: Sudah Dikoreksi -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-1">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Sudah Dikoreksi</span>
                <div class="flex items-baseline space-x-2">
                    <span class="text-xl sm:text-2xl font-black text-slate-900">124</span>
                    <span class="text-[10px] font-bold bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-full">Selesai</span>
                </div>
            </div>

        </div>

        <!-- Section: Kirim Hasil & Buat Evaluasi -->
        <div class="space-y-3">
            <div class="px-1">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-400">Kirim Hasil & Buat Evaluasi</h3>
            </div>

            <div class="space-y-3.5">
                
                <!-- Kartu Tugas 1: Tugas Hukum Newton & Gaya Gesek -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-4 hover:border-indigo-100 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-black bg-indigo-50 text-indigo-600 tracking-wider">
                            Fisika Kelas XI
                        </span>
                        <span class="text-[10px] font-bold bg-rose-50 text-rose-600 px-2.5 py-1 rounded-full">12 Siswa Lagi</span>
                    </div>

                    <div class="space-y-1">
                        <h4 class="text-xs sm:text-sm font-black text-slate-900 tracking-tight">Tugas Hukum Newton & Gaya Gesek</h4>
                        <p class="text-[11px] text-slate-500 font-medium">Evaluasi langkah pengerjaan di kertas double folio.</p>
                    </div>

                    <div class="pt-2 border-t border-slate-50 flex items-center justify-between">
                        <span class="text-[11px] text-slate-400 font-medium">Tenggat: 2 Hari Lalu</span>
                        <button class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-100 transition-all">
                            Koreksi Sekarang
                        </button>
                    </div>
                </div>

                <!-- Kartu Tugas 2: Kuis Harian: Matriks Ordo 3×3 -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-3 hover:border-emerald-100 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-black bg-emerald-50 text-emerald-600 tracking-wider">
                            Koreksi Rampung
                        </span>
                        <span class="text-xs font-black text-emerald-600">Rerata: 85/100</span>
                    </div>

                    <div class="space-y-1">
                        <h4 class="text-xs sm:text-sm font-black text-slate-900 tracking-tight">Kuis Harian: Matriks Ordo 3×3</h4>
                        <p class="text-[11px] text-slate-500 font-medium">Ujian Pilihan Ganda • Terkoreksi Otomatis Sistem.</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Tombol Aksi Utama -->
        <div class="pt-2">
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                <span>Buat Tugas / Kuis Baru</span>
                <span>↗</span>
            </button>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>