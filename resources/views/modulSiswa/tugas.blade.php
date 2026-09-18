<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas | Cakrawala Educentre</title>
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
        <div class="pt-2 space-y-1">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Tugas</h1>
        </div>

        <!-- Tab Navigasi (Tugas Aktif / Kuis Evaluasi) -->
        <div class="bg-slate-200/70 p-1.5 rounded-2xl flex items-center space-x-1">
            <button class="flex-1 py-2.5 bg-white text-indigo-600 font-bold text-xs rounded-xl shadow-sm transition-all text-center">Tugas Aktif</button>
            <button class="flex-1 py-2.5 text-slate-500 font-semibold text-xs rounded-xl hover:text-slate-900 transition-all text-center">Kuis Evaluasi</button>
        </div>

        <!-- Statistik Kartu Ringkasan -->
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-2">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Belum Selesai</span>
                <div class="flex items-baseline space-x-2">
                    <span class="text-2xl font-black text-slate-900">03</span>
                    <span class="px-2 py-0.5 bg-amber-50 text-amber-600 font-bold text-[9px] rounded-md">Tugas</span>
                </div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-2">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Sudah Dinilai</span>
                <div class="flex items-baseline space-x-2">
                    <span class="text-2xl font-black text-slate-900">14</span>
                    <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 font-bold text-[9px] rounded-md">Selesai</span>
                </div>
            </div>
        </div>

        <!-- Bagian Daftar Tugasmu -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-slate-900">Daftar Tugasmu</h3>
                <button class="text-xs font-bold text-indigo-600 flex items-center space-x-1 hover:underline">
                    <span>Filter Terlama</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </div>

            <!-- List Item 1: Tugas Fisika -->
            <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4 hover:border-indigo-200 transition-all">
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 font-bold text-[10px] rounded-lg">Fisika Kelas XI</span>
                    <span class="px-2.5 py-1 bg-rose-50 text-rose-600 font-bold text-[10px] rounded-lg">Sisa 2 Hari</span>
                </div>

                <div class="space-y-1">
                    <h4 class="text-xs sm:text-sm font-black text-slate-900">Tugas Fisika: Hukum Newton & Gaya Gesek</h4>
                    <p class="text-[11px] text-slate-500 font-medium line-clamp-2">Kerjakan soal latihan bab 3 pada halaman 112 hingga 115 di buku cetak...</p>
                </div>

                <div class="pt-3 border-t border-slate-50 flex items-center justify-between">
                    <div class="flex items-center space-x-2 text-slate-500 text-[11px] font-medium">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                        <span>1 Lampiran PDF</span>
                    </div>
                    <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-100 transition-all">
                        Kerjakan
                    </button>
                </div>
            </div>

            <!-- List Item 2: Kuis Aljabar -->
            <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4 hover:border-indigo-200 transition-all">
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-1 bg-sky-50 text-sky-600 font-bold text-[10px] rounded-lg">Kuis Aljabar</span>
                    <span class="px-2.5 py-1 bg-amber-50 text-amber-600 font-bold text-[10px] rounded-lg">Belum Mulai</span>
                </div>

                <div class="space-y-1">
                    <h4 class="text-xs sm:text-sm font-black text-slate-900">Kuis Harian: Matriks & Sistem Linear</h4>
                    <p class="text-[11px] text-slate-500 font-medium">Durasi: 30 Menit • 10 Soal Pilihan Ganda</p>
                </div>

                <div class="pt-3 border-t border-slate-50 flex items-center justify-between">
                    <div class="flex items-center space-x-1.5 text-slate-400 text-[11px] font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Tenggat: Besok, 23:59 WIB</span>
                    </div>
                    <button class="px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-xl text-xs font-bold transition-all">
                        Mulai Kuis
                    </button>
                </div>
            </div>

            <!-- List Item 3: Tugas Selesai / Dinilai -->
            <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-100 shadow-sm space-y-3 hover:border-emerald-200 transition-all">
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 font-bold text-[10px] rounded-lg">Selesai Dinilai</span>
                    <span class="text-sm font-black text-emerald-600">95/100</span>
                </div>

                <div class="space-y-1">
                    <h4 class="text-xs sm:text-sm font-black text-slate-900">Tugas Sejarah: Deklarasi Proklamasi RI</h4>
                    <p class="text-[11px] text-slate-400 font-medium">Dikumpulkan pada 12 Okt 2026 • Tepat Waktu</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Navigation Bar -->
    <div class="hidden fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white/90 backdrop-blur-md border-t border-slate-100 px-6 py-3 items-center justify-between z-50 shadow-lg">
        <a href="{{ route('siswa.home') }}" class="flex flex-col items-center space-y-1 text-slate-400 hover:text-slate-600 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span class="text-[10px] font-medium">Beranda</span>
        </a>
        <a href="{{ route('siswa.kelas') }}" class="flex flex-col items-center space-y-1 text-slate-400 hover:text-slate-600 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <span class="text-[10px] font-medium">Belajar</span>
        </a>
        <a href="{{ route('siswa.tugas') }}" class="flex flex-col items-center space-y-1 text-indigo-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            <span class="text-[10px] font-bold">Ujian</span>
        </a>
        <a href="{{ route('siswa.profile') }}" class="flex flex-col items-center space-y-1 text-slate-400 hover:text-slate-600 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span class="text-[10px] font-medium">Profil</span>
        </a>
    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>