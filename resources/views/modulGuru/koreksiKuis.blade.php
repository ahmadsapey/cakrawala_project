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
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="flex items-center justify-between pt-2">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Kuis Matriks Ordo 3×3</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Analisis Hasil Kuis Siswa</h1>
            </div>
            <a href="{{ route('guru.home') }}" class="rounded-xl border-2 border-slate-300 bg-white px-4 py-2.5 text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">Kembali</a>
        </div>

        <!-- Statistik Ringkasan -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Rerata Kelas -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 space-y-1 text-center">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Rerata Kelas</span>
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 pt-1">82.4</div>
            </div>
            <!-- Lulus KKM -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 space-y-1 text-center">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Tingkat Lulus KKM</span>
                <div class="text-2xl sm:text-3xl font-extrabold text-emerald-600 pt-1">92%</div>
            </div>
            <!-- Siswa Ikut -->
            <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-5 space-y-1 text-center">
                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Total Peserta</span>
                <div class="text-2xl sm:text-3xl font-extrabold text-indigo-600 pt-1">36 Siswa</div>
            </div>
        </div>

        <!-- Kartu Peringatan: Soal Tersulit -->
        <div class="bg-rose-50 rounded-2xl border-2 border-rose-300 shadow-sm p-6 space-y-3">
            <div class="flex items-center space-x-2 text-rose-800">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span class="text-xs font-extrabold uppercase tracking-wider">Soal Tersulit (Soal No. 7)</span>
            </div>

            <div class="space-y-1.5">
                <h4 class="text-sm sm:text-base font-extrabold text-slate-900 leading-snug">
                    "Mencari determinan matriks singular menggunakan metode Sarrus"
                </h4>
                <p class="text-xs text-slate-700 font-semibold leading-relaxed">
                    Hanya 14 dari 36 siswa (38.8%) yang berhasil menjawab benar. Disarankan untuk mengadakan ulasan khusus topik ini.
                </p>
            </div>
        </div>

        <!-- Section: Distribusi Nilai Siswa -->
        <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-6 space-y-5">
            <div class="px-0.5">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Distribusi Nilai Siswa</h3>
            </div>

            <div class="space-y-4">
                <!-- Bar 1: Sangat Memuaskan -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs font-extrabold">
                        <span class="text-slate-800">Sangat Memuaskan (90–100)</span>
                        <span class="text-indigo-700">16 Siswa</span>
                    </div>
                    <div class="w-full bg-slate-100 h-3 rounded-xl overflow-hidden border border-slate-300">
                        <div class="bg-indigo-600 h-full rounded-xl" style="width: 60%;"></div>
                    </div>
                </div>

                <!-- Bar 2: Cukup / Baik -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs font-extrabold">
                        <span class="text-slate-800">Cukup / Baik (75–89)</span>
                        <span class="text-emerald-700">17 Siswa</span>
                    </div>
                    <div class="w-full bg-slate-100 h-3 rounded-xl overflow-hidden border border-slate-300">
                        <div class="bg-emerald-500 h-full rounded-xl" style="width: 70%;"></div>
                    </div>
                </div>

                <!-- Bar 3: Di Bawah KKM -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs font-extrabold">
                        <span class="text-slate-800">Di Bawah KKM (&lt;75)</span>
                        <span class="text-rose-700">3 Siswa</span>
                    </div>
                    <div class="w-full bg-slate-100 h-3 rounded-xl overflow-hidden border border-slate-300">
                        <div class="bg-rose-500 h-full rounded-xl" style="width: 20%;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>