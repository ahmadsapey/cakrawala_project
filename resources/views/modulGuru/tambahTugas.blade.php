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
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-md flex-col space-y-5 bg-[#F8FAFC] p-4 sm:p-6 md:max-w-7xl md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="space-y-1 pt-2">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Buat Tugas Baru</h1>
            <p class="text-xs text-slate-500 font-medium">Fisika XI - Semester Ganjil</p>
        </div>

        <!-- Form Kontainer Utama -->
        <div class="space-y-4">
            
            <!-- Input 1: Judul Tugas -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Judul Tugas</label>
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4">
                    <input type="text" value="Laporan Praktikum Efek Fotolistrik" class="w-full bg-transparent text-xs font-bold text-slate-800 focus:outline-none">
                </div>
            </div>

            <!-- Input 2: Instruksi & Cara Pengerjaan -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Instruksi & Cara Pengerjaan</label>
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4">
                    <textarea rows="4" class="w-full bg-transparent text-xs font-medium text-slate-800 focus:outline-none resize-none leading-relaxed">1. Bacalah modul Bab 2 secara saksama.
2. Lakukan simulasi virtual PhET Efek Fotolistrik.
3. Catat tegangan penghenti (stopping voltage) untuk tiap variasi warna cahaya.
4. Kirim berkas dalam format PDF.</textarea>
                </div>
            </div>

            <!-- Input 3: Bobot Nilai (%) & Tenggat Pengumpulan (2 Kolom) -->
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Bobot Nilai (%)</label>
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4">
                        <input type="text" value="15%" class="w-full bg-transparent text-xs font-bold text-slate-800 focus:outline-none">
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Tenggat Pengumpulan</label>
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4">
                        <input type="text" value="25 Okt, 23:59 WIB" class="w-full bg-transparent text-xs font-bold text-indigo-600 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Input 4: File Panduan Praktikum (Opsional) -->
            <div class="space-y-1.5 pt-1">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">File Panduan Praktikum <span class="text-slate-400 font-normal lowercase">(Opsional)</span></label>
                <div class="border-2 border-dashed border-indigo-300/80 bg-indigo-50/20 hover:bg-indigo-50/40 rounded-2xl p-4 text-center space-y-2 transition-all cursor-pointer group">
                    <div class="w-9 h-9 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mx-auto shadow-sm group-hover:scale-105 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    </div>
                    <p class="text-xs font-black text-indigo-600">Ganti Berkas Panduan</p>
                </div>
            </div>

        </div>

        <!-- Tombol Aksi Utama -->
        <div class="pt-2">
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                <span>Publikasikan Tugas</span>
            </button>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>