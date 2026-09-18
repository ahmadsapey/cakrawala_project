<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Evaluasi | Cakrawala Educentre</title>
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
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-md flex-col space-y-6 bg-[#F8FAFC] p-4 sm:p-6 md:max-w-7xl md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Hasil Evaluasi</h1>
        </div>

        <!-- Kartu Utama Skor & Status Kelulusan -->
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col items-center text-center space-y-5 relative overflow-hidden">
            <!-- Badge Status -->
            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 font-black text-[10px] tracking-wider uppercase rounded-full border border-emerald-100">
                Lulus Evaluasi
            </span>

            <!-- Lingkaran Skor Akhir -->
            <div class="w-28 h-28 rounded-full bg-indigo-50/50 border-4 border-indigo-100 flex flex-col items-center justify-center shadow-inner">
                <span class="text-3xl font-black text-indigo-600 tracking-tight">80</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Skor Akhir</span>
            </div>

            <!-- Ucapan Motivasi -->
            <p class="text-xs sm:text-sm font-bold text-slate-800 max-w-xs leading-relaxed">
                Selamat Rayyan, kamu telah berhasil menguasai topik ini!
            </p>

            <!-- Statistik Singkat (Benar, Salah, Kecepatan) -->
            <div class="w-full grid grid-cols-3 gap-2 pt-4 border-t border-slate-50">
                <div class="flex flex-col items-center">
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Benar</span>
                    <span class="text-sm font-black text-emerald-600 mt-1">8 Soal</span>
                </div>
                <div class="flex flex-col items-center border-x border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Salah</span>
                    <span class="text-sm font-black text-rose-500 mt-1">2 Soal</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Kecepatan</span>
                    <span class="text-sm font-black text-slate-700 mt-1">18m 4s</span>
                </div>
            </div>
        </div>

        <!-- Detail Informasi Pelajaran -->
        <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm space-y-3">
            <div class="flex items-center justify-between text-xs">
                <span class="font-medium text-slate-400">Topik Pelajaran</span>
                <span class="font-bold text-slate-900">Matriks & Aljabar Linear</span>
            </div>
            <div class="flex items-center justify-between text-xs">
                <span class="font-medium text-slate-400">Siswa</span>
                <span class="font-bold text-slate-900">Rayyan Pratama</span>
            </div>
            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-50">
                <span class="font-medium text-slate-400">Batas KKM Minimum</span>
                <span class="font-black text-indigo-600">75 Poin</span>
            </div>
        </div>

        <!-- Bagian Review Jawaban -->
        <div class="space-y-3">
            <h3 class="text-sm font-black text-slate-900 px-1">Review Jawaban</h3>

            <!-- Review Item 1: Benar -->
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-emerald-200 transition-all">
                <div class="flex items-center space-x-3">
                    <div class="w-7 h-7 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs shrink-0">1</div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs font-bold text-slate-900">Pengertian Dasar Matriks Identitas</h4>
                        <p class="text-[10px] font-medium text-emerald-600">Benar • Pilihanmu: A (Kunci: A)</p>
                    </div>
                </div>
                <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>

            <!-- Review Item 2: Salah -->
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-rose-200 transition-all">
                <div class="flex items-center space-x-3">
                    <div class="w-7 h-7 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center font-bold text-xs shrink-0">2</div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs font-bold text-slate-900">Perhitungan Nilai Determinan Ordo 3×3</h4>
                        <p class="text-[10px] font-medium text-rose-500">Salah • Pilihanmu: C (Kunci: E)</p>
                    </div>
                </div>
                <div class="w-6 h-6 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
            </div>

            <!-- Review Item 3: Benar -->
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-emerald-200 transition-all">
                <div class="flex items-center space-x-3">
                    <div class="w-7 h-7 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs shrink-0">3</div>
                    <div class="space-y-0.5">
                        <h4 class="text-xs font-bold text-slate-900">Sifat Determinan Matriks Transpose</h4>
                        <p class="text-[10px] font-medium text-emerald-600">Benar • Pilihanmu: B (Kunci: B)</p>
                    </div>
                </div>
                <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Bawah -->
        <div class="space-y-2.5 pt-2">
            <button class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all text-center">
                Kembali ke Kelas Utama
            </button>
            <button class="w-full py-3.5 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-xs rounded-2xl shadow-sm transition-all text-center">
                Ulangi Kuis Remedial
            </button>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>