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
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="flex items-center justify-between pt-2">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Modul guru</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Koreksi & Penilaian Tugas</h1>
            </div>
            <a href="{{ route('guru.tugas.create') }}" class="rounded-xl bg-indigo-600 border border-indigo-700 px-4 py-2.5 text-xs font-extrabold text-white shadow-md hover:bg-indigo-700 transition-all">+ Buat Tugas Baru</a>
        </div>

        <!-- Filter Tab Kategori -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 scrollbar-none">
            <button class="px-5 py-2.5 bg-indigo-600 border border-indigo-700 text-white font-extrabold text-xs rounded-xl shadow-sm flex-shrink-0">
                Perlu Dinilai
            </button>
            <button class="px-5 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border-2 border-slate-300 font-extrabold text-xs rounded-xl transition-all flex-shrink-0">
                Tugas Aktif
            </button>
            <button class="px-5 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border-2 border-slate-300 font-extrabold text-xs rounded-xl transition-all flex-shrink-0">
                Draf & Selesai
            </button>
        </div>

        <!-- Statistik Ringkasan Kartu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            <!-- Kartu 1: Total Tugas Masuk -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 space-y-1">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Total Tugas Masuk</span>
                <div class="flex items-baseline space-x-3 pt-1">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900">38</span>
                    <span class="text-xs font-extrabold bg-amber-50 text-amber-800 border border-amber-300 px-2.5 py-1 rounded-lg">Menunggu Koreksi</span>
                </div>
            </div>

            <!-- Kartu 2: Sudah Dikoreksi -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 space-y-1">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Sudah Dikoreksi</span>
                <div class="flex items-baseline space-x-3 pt-1">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900">124</span>
                    <span class="text-xs font-extrabold bg-emerald-50 text-emerald-800 border border-emerald-300 px-2.5 py-1 rounded-lg">Terkoreksi Selesai</span>
                </div>
            </div>

        </div>

        <!-- Section: Kirim Hasil & Buat Evaluasi -->
        <div class="space-y-4">
            <div class="px-1">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Daftar Tugas Perlu Koreksi</h3>
            </div>

            <div class="space-y-4">
                
                <!-- Kartu Tugas 1 -->
                <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-6 space-y-4 hover:border-indigo-600 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-lg text-xs font-extrabold bg-indigo-100 text-indigo-800 border border-indigo-300 tracking-wider">
                            Fisika Kelas XI
                        </span>
                        <span class="text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-300 px-3 py-1 rounded-lg">12 Siswa Belum Dinilai</span>
                    </div>

                    <div class="space-y-1">
                        <h4 class="text-base font-extrabold text-slate-900 tracking-tight">Tugas Hukum Newton & Gaya Gesek</h4>
                        <p class="text-xs text-slate-600 font-semibold">Evaluasi langkah pengerjaan di kertas double folio.</p>
                    </div>

                    <div class="pt-3 border-t-2 border-slate-200 flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-semibold">Tenggat: 2 Hari Lalu</span>
                        <a href="{{ route('guru.input-nilai') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl shadow-md border border-indigo-700 transition-all">
                            Koreksi Sekarang
                        </a>
                    </div>
                </div>

                <!-- Kartu Tugas 2 -->
                <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-6 space-y-4 hover:border-indigo-600 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 rounded-lg text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300 tracking-wider">
                            Koreksi Rampung
                        </span>
                        <span class="text-xs font-extrabold text-emerald-700">Rerata: 85 / 100</span>
                    </div>

                    <div class="space-y-1">
                        <h4 class="text-base font-extrabold text-slate-900 tracking-tight">Kuis Harian: Matriks Ordo 3×3</h4>
                        <p class="text-xs text-slate-600 font-semibold">Ujian Pilihan Ganda • Terkoreksi Otomatis Sistem.</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>