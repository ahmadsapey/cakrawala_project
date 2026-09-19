<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Tugas Baru | Cakrawala Educentre</title>
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
    <div class="mx-auto flex min-h-screen w-full max-w-3xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="flex items-center justify-between pt-2">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Fisika XI - Semester Ganjil</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Buat Tugas Baru</h1>
            </div>
            <a href="{{ route('guru.home') }}" class="rounded-xl border-2 border-slate-300 bg-white px-4 py-2.5 text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">Kembali</a>
        </div>

        <!-- Form Kontainer Utama -->
        <form class="space-y-5 rounded-2xl border-2 border-slate-300 bg-white p-6 shadow-sm sm:p-8">
            
            <!-- Input 1: Judul Tugas -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Judul Tugas</label>
                <input type="text" value="Laporan Praktikum Efek Fotolistrik" class="w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
            </div>

            <!-- Input 2: Instruksi & Cara Pengerjaan -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Instruksi & Cara Pengerjaan</label>
                <textarea rows="4" class="w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all resize-none leading-relaxed">1. Bacalah modul Bab 2 secara saksama.
2. Lakukan simulasi virtual PhET Efek Fotolistrik.
3. Catat tegangan penghenti (stopping voltage) untuk tiap variasi warna cahaya.
4. Kirim berkas dalam format PDF.</textarea>
            </div>

            <!-- Input 3: Bobot Nilai (%) & Tenggat Pengumpulan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Bobot Nilai (%)</label>
                    <input type="text" value="15%" class="w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Tenggat Pengumpulan</label>
                    <input type="text" value="25 Okt, 23:59 WIB" class="w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-extrabold text-indigo-700 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>
            </div>

            <!-- Input 4: File Panduan Praktikum (Opsional) -->
            <div class="space-y-1.5 pt-2">
                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">File Panduan Praktikum <span class="text-slate-400 font-medium lowercase">(opsional)</span></label>
                <div class="border-2 border-dashed border-indigo-400 bg-indigo-50/50 hover:bg-indigo-50 rounded-xl p-5 text-center space-y-2 transition-all cursor-pointer group">
                    <div class="w-10 h-10 bg-white text-indigo-600 border border-indigo-300 rounded-xl flex items-center justify-center mx-auto shadow-sm group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    </div>
                    <p class="text-xs font-extrabold text-indigo-700">Unggah atau Ganti Berkas Panduan (PDF/PPT)</p>
                </div>
            </div>

            <!-- Tombol Aksi Utama -->
            <div class="pt-3 flex gap-3">
                <button type="button" class="flex-1 py-3.5 px-4 bg-white border-2 border-slate-300 hover:bg-slate-50 text-slate-700 font-extrabold text-xs sm:text-sm rounded-xl transition-all">
                    Simpan Draf
                </button>
                <button type="button" class="flex-1 py-3.5 px-4 bg-indigo-600 border border-indigo-700 hover:bg-indigo-700 text-white font-extrabold text-xs sm:text-sm rounded-xl shadow-md transition-all">
                    Publikasikan Tugas
                </button>
            </div>
        </form>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>