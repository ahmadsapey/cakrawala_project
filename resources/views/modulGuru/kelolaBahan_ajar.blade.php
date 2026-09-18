<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Bahan Ajar | Cakrawala Educentre</title>
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
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Edit Bahan Ajar</h1>
            <p class="text-xs text-slate-500 font-medium">Fisika Modern - Kelas XI</p>
        </div>

        <!-- Form Kartu Utama -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5 space-y-4">
            
            <!-- Input 1: Judul Bab / Topik Utama -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Judul Bab / Topik Utama</label>
                <input type="text" value="02. Eksperimen Efek Fotolistrik" class="w-full bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm text-xs font-bold text-slate-800 px-4 py-3.5 focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all">
            </div>

            <!-- Input 2: Ringkasan Pembelajaran -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Ringkasan Pembelajaran</label>
                <textarea rows="3" class="w-full bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm text-xs font-medium text-slate-800 p-4 focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all resize-none leading-relaxed">Membahas tuntas tentang eksperimen fotolistrik Heinrich Hertz, fungsi kerja logam, dan energi kinetik maksimum fotoelektron.</textarea>
            </div>

            <!-- Input 3: Video Pembelajaran (YouTube / Drive) -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Video Pembelajaran (YouTube / Drive)</label>
                <div class="relative flex items-center bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm focus-within:border-indigo-600 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </span>
                    <input type="text" value="https://youtube.com/watch?v=cakrawala..." class="w-full bg-transparent text-xs font-bold text-slate-800 pl-11 pr-4 py-3.5 focus:outline-none">
                </div>
            </div>

            <!-- Input 4: Modul PDF & Slides Terlampir -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Modul PDF & Slides Terlampir</label>
                <div class="bg-slate-50/60 rounded-2xl border border-slate-200/80 shadow-sm p-3.5 flex items-center justify-between">
                    <div class="flex items-center space-x-3 overflow-hidden">
                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-black text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="space-y-0.5 overflow-hidden">
                            <h4 class="text-xs font-black text-slate-900 truncate">Modul_Rumus_Fotolistrik.pdf</h4>
                            <p class="text-[10px] text-emerald-600 font-bold">2.4 MB • Berhasil diunggah</p>
                        </div>
                    </div>
                    <button class="text-slate-400 hover:text-rose-600 transition-colors p-1.5 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </div>

            <!-- Input 5: Status Publikasi Materi -->
            <div class="space-y-1.5 pt-1">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Status Publikasi Materi</label>
                <div class="grid grid-cols-2 gap-2 bg-slate-100 p-1 rounded-2xl">
                    <button type="button" class="py-2.5 bg-indigo-600 text-white font-bold text-xs rounded-xl shadow-sm transition-all">
                        Terbitkan Sekarang
                    </button>
                    <button type="button" class="py-2.5 text-slate-600 hover:text-slate-900 font-bold text-xs rounded-xl transition-all">
                        Simpan sebagai Draf
                    </button>
                </div>
            </div>

        </div>

        <!-- Tombol Aksi Utama -->
        <div class="pt-2">
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                <span>Simpan Perubahan Materi</span>
            </button>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>