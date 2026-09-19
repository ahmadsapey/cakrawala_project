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
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman: Pembuat Kuis -->
        <div class="flex items-center justify-between pt-2">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-amber-700">Kuis Harian: Termodinamika</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Pembuat & Editor Kuis</h1>
            </div>
            <a href="{{ route('guru.home') }}" class="rounded-xl border-2 border-slate-300 bg-white px-4 py-2.5 text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">Kembali</a>
        </div>

        <!-- Statistik Pengaturan Kuis -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Durasi Kuis -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 space-y-1">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Durasi Kuis</span>
                <div class="text-xl sm:text-2xl font-extrabold text-slate-900 pt-0.5">45 Menit</div>
            </div>
            <!-- Batas KKM -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 space-y-1">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Batas KKM Minimum</span>
                <div class="text-xl sm:text-2xl font-extrabold text-indigo-600 pt-0.5">75 / 100</div>
            </div>
        </div>

        <!-- Section: Daftar Soal Kuis -->
        <div class="space-y-4">
            <div class="px-1 flex items-center justify-between">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Daftar Soal Kuis (1 dari 10)</h3>
                <button class="px-4 py-2 bg-indigo-600 border border-indigo-700 text-white font-extrabold text-xs rounded-xl shadow-sm hover:bg-indigo-700 transition-all">+ Tambah Soal Baru</button>
            </div>

            <!-- Kartu Soal 1 -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-6 space-y-5">
                <div class="space-y-1">
                    <h4 class="text-sm sm:text-base font-extrabold text-slate-900 leading-snug">
                        1. Apakah yang terjadi pada efisiensi mesin Carnot jika suhu reservoir rendah diturunkan?
                    </h4>
                </div>

                <!-- Pilihan Jawaban -->
                <div class="space-y-3">
                    <!-- Opsi A (Kunci Jawaban) -->
                    <div class="bg-indigo-50 rounded-xl border-2 border-indigo-600 p-4 flex items-center space-x-3.5">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 text-white font-extrabold text-xs flex items-center justify-center flex-shrink-0 shadow-sm">
                            A
                        </div>
                        <div class="text-xs sm:text-sm font-extrabold text-indigo-950">
                            Efisiensi akan meningkat <span class="ml-2 text-xs bg-indigo-200 text-indigo-800 px-2 py-0.5 rounded border border-indigo-300 font-extrabold">(Kunci Jawaban)</span>
                        </div>
                    </div>

                    <!-- Opsi B -->
                    <div class="bg-white rounded-xl border-2 border-slate-300 p-4 flex items-center space-x-3.5 hover:border-slate-400 transition-all">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 font-extrabold text-xs flex items-center justify-center flex-shrink-0 border border-slate-300">
                            B
                        </div>
                        <div class="text-xs sm:text-sm font-semibold text-slate-700">
                            Efisiensi akan menurun
                        </div>
                    </div>

                    <!-- Opsi C -->
                    <div class="bg-white rounded-xl border-2 border-slate-300 p-4 flex items-center space-x-3.5 hover:border-slate-400 transition-all">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 font-extrabold text-xs flex items-center justify-center flex-shrink-0 border border-slate-300">
                            C
                        </div>
                        <div class="text-xs sm:text-sm font-semibold text-slate-700">
                            Efisiensi tetap konstan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Utama -->
        <div class="pt-2">
            <button class="w-full py-4 bg-indigo-600 border border-indigo-700 hover:bg-indigo-700 text-white font-extrabold text-xs sm:text-sm rounded-xl shadow-md transition-all flex items-center justify-center space-x-2">
                <span>Simpan & Publikasikan Kuis</span>
            </button>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>