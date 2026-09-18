<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Siswa | Cakrawala Educentre</title>
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
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Input nilai Siswa</h1>
            <p class="text-xs text-slate-500 font-medium">Praktikum Efek Fotolistrik</p>
        </div>

        <!-- Kartu Identitas Siswa -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 flex items-center space-x-3.5">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 font-black text-sm flex items-center justify-center flex-shrink-0 shadow-sm">
                RP
            </div>
            <div class="space-y-0.5 overflow-hidden">
                <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Rayyan Pratama</h3>
                <p class="text-[11px] text-slate-500 font-medium truncate">NISN: 0019283912 • Kelas XI - IPA 2</p>
            </div>
        </div>

        <!-- Form Kontainer Utama -->
        <div class="space-y-4">
            
            <!-- Section: Tugas Siswa (File Lampiran) -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Tugas siswa</label>
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-3.5 flex items-center justify-between space-x-3 hover:border-indigo-300 transition-all cursor-pointer">
                    <div class="flex items-center space-x-3 min-w-0">
                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="space-y-0.5 truncate">
                            <h4 class="text-xs font-bold text-slate-800 truncate">Praktikum_Fotolistrik_Rayyan.pdf</h4>
                            <p class="text-[10px] text-slate-400 font-medium">Diserahkan tepat waktu (24 Okt, 14:02 WIB)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Beri Nilai (Skala 100) -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Beri Nilai (Skala 100)</label>
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4">
                    <input type="text" value="88" class="w-full bg-transparent text-sm font-black text-indigo-600 focus:outline-none">
                </div>
            </div>

            <!-- Section: Catatan Guru / Umpan Balik -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider px-1">Catatan Guru / Umpan Balik</label>
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4">
                    <textarea rows="4" class="w-full bg-transparent text-xs font-medium text-slate-800 focus:outline-none resize-none leading-relaxed">Kerja bagus Rayyan! Analisis grafik stopping voltage sangat detail dan akurat. Pertahankan performamu di bab selanjutnya.</textarea>
                </div>
            </div>

        </div>

        <!-- Tombol Aksi Utama -->
        <div class="pt-2">
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                <span>Kirim Penilaian Siswa</span>
            </button>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>