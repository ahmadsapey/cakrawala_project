<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembuat Kuis | Cakrawala Educentre</title>
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

        <!-- Header Halaman: Pembuat Kuis -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-1">
            <h1 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Pembuat Kuis</h1>
            <p class="text-xs text-slate-500 font-medium">Kuis Harian: Termodinamika</p>
        </div>

        <!-- Statistik Pengaturan Kuis (2 Kolom) -->
        <div class="grid grid-cols-2 gap-3">
            <!-- Durasi Kuis -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-1">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Durasi Kuis</span>
                <div class="text-lg sm:text-xl font-black text-slate-900 pt-0.5">45 Menit</div>
            </div>
            <!-- Batas KKM -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-1">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Batas KKM</span>
                <div class="text-lg sm:text-xl font-black text-indigo-600 pt-0.5">75 / 100</div>
            </div>
        </div>

        <!-- Section: Daftar Soal Kuis -->
        <div class="space-y-3">
            <div class="px-1 flex items-center justify-between">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-400">Daftar Soal Kuis (1 dari 10)</h3>
                <button class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors">+ Tambah Soal</button>
            </div>

            <!-- Kartu Soal 1 -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-4">
                <div class="space-y-1">
                    <h4 class="text-xs sm:text-sm font-black text-slate-900 leading-snug">
                        1. Apakah yang terjadi pada efisiensi mesin Carnot jika suhu reservoir rendah diturunkan?
                    </h4>
                </div>

                <!-- Pilihan Jawaban -->
                <div class="space-y-2.5">
                    <!-- Opsi A (Kunci Jawaban - Disorot Ungu) -->
                    <div class="bg-indigo-50/40 rounded-2xl border-2 border-indigo-500 p-3.5 flex items-center space-x-3">
                        <div class="w-7 h-7 rounded-xl bg-indigo-600 text-white font-black text-xs flex items-center justify-center flex-shrink-0 shadow-sm shadow-indigo-200">
                            A
                        </div>
                        <div class="text-xs font-bold text-indigo-950">
                            Efisiensi akan meningkat (Kunci)
                        </div>
                    </div>

                    <!-- Opsi B -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-3.5 flex items-center space-x-3 hover:border-slate-300 transition-all">
                        <div class="w-7 h-7 rounded-xl bg-slate-100 text-slate-500 font-bold text-xs flex items-center justify-center flex-shrink-0">
                            B
                        </div>
                        <div class="text-xs font-medium text-slate-700">
                            Efisiensi akan menurun
                        </div>
                    </div>

                    <!-- Opsi C -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-3.5 flex items-center space-x-3 hover:border-slate-300 transition-all">
                        <div class="w-7 h-7 rounded-xl bg-slate-100 text-slate-500 font-bold text-xs flex items-center justify-center flex-shrink-0">
                            C
                        </div>
                        <div class="text-xs font-medium text-slate-700">
                            Efisiensi tetap konstan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Utama -->
        <div class="pt-2">
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                <span>Simpan & Publikasikan Kuis</span>
            </button>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>