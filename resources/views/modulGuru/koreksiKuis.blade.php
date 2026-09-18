<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koreksi Hasil Kuis | Cakrawala Educentre</title>
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
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-1">
            <h1 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Analisis Hasil Kuis</h1>
            <p class="text-xs text-slate-500 font-medium">Kuis Matriks Ordo 3×3</p>
        </div>

        <!-- Statistik Ringkasan (3 Kolom) -->
        <div class="grid grid-cols-3 gap-2.5">
            <!-- Rerata Kelas -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-3.5 space-y-1 text-center">
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Rerata Kelas</span>
                <div class="text-base sm:text-lg font-black text-slate-900">82.4</div>
            </div>
            <!-- Lulus KKM -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-3.5 space-y-1 text-center">
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Lulus KKM</span>
                <div class="text-base sm:text-lg font-black text-emerald-600">92%</div>
            </div>
            <!-- Siswa Ikut -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-3.5 space-y-1 text-center">
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Siswa Ikut</span>
                <div class="text-base sm:text-lg font-black text-indigo-600">36</div>
            </div>
        </div>

        <!-- Kartu Peringatan: Soal Tersulit -->
        <div class="bg-rose-50/50 rounded-3xl border border-rose-200/80 shadow-sm p-4 sm:p-5 space-y-3">
            <div class="flex items-center space-x-2 text-rose-600">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span class="text-[11px] font-black uppercase tracking-wider">Soal Tersulit (Soal No. 7)</span>
            </div>

            <div class="space-y-1.5">
                <h4 class="text-xs sm:text-sm font-black text-slate-900 leading-snug">
                    "Mencari determinan matriks singular menggunakan metode Sarrus"
                </h4>
                <p class="text-[11px] text-slate-600 font-medium leading-relaxed">
                    Hanya 14 dari 36 siswa (38.8%) yang berhasil menjawab benar. Disarankan untuk mengadakan ulasan khusus topik ini.
                </p>
            </div>
        </div>

        <!-- Section: Distribusi Nilai Siswa -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-4">
            <div class="px-0.5">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-400">Distribusi Nilai Siswa</h3>
            </div>

            <div class="space-y-3.5">
                <!-- Bar 1: Sangat Memuaskan (90–100) -->
                <div class="space-y-1">
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-slate-700">Sangat Memuaskan (90–100)</span>
                        <span class="text-indigo-600">16 Siswa</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-indigo-600 h-full rounded-full" style="width: 60%;"></div>
                    </div>
                </div>

                <!-- Bar 2: Cukup / Baik (75–89) -->
                <div class="space-y-1">
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-slate-700">Cukup / Baik (75–89)</span>
                        <span class="text-emerald-600">17 Siswa</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-emerald-500 h-full rounded-full" style="width: 70%;"></div>
                    </div>
                </div>

                <!-- Bar 3: Di Bawah KKM (<75) -->
                <div class="space-y-1">
                    <div class="flex items-center justify-between text-xs font-bold">
                        <span class="text-slate-700">Di Bawah KKM (&lt;75)</span>
                        <span class="text-rose-600">3 Siswa</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-rose-500 h-full rounded-full" style="width: 20%;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>