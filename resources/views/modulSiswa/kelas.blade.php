<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Belajarmu | Cakrawala Educentre</title>
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
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight flex items-center space-x-2">
                <span>Kelas Belajarmu</span>
                <span class="text-lg">📚</span>
            </h1>
            <p class="text-xs text-slate-500 font-medium">Pantau progres dan ikuti kelas interaktif harian.</p>
        </div>

        <!-- Kolom Pencarian -->
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" placeholder="Cari kelas aktif atau topik modul..." class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200/80 rounded-2xl text-xs sm:text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 shadow-sm transition-all">
        </div>

        <!-- Filter Kategori (Chips) -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 no-scrollbar">
            <button class="px-4 py-2 bg-indigo-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-200 shrink-0 transition-all">Semua</button>
            <button class="px-4 py-2 bg-white text-slate-600 border border-slate-200/80 font-semibold text-xs rounded-xl hover:bg-slate-50 shrink-0 transition-all">Fisika</button>
            <button class="px-4 py-2 bg-white text-slate-600 border border-slate-200/80 font-semibold text-xs rounded-xl hover:bg-slate-50 shrink-0 transition-all">Matematika</button>
            <button class="px-4 py-2 bg-white text-slate-600 border border-slate-200/80 font-semibold text-xs rounded-xl hover:bg-slate-50 shrink-0 transition-all">Kimia</button>
            <button class="px-4 py-2 bg-white text-slate-600 border border-slate-200/80 font-semibold text-xs rounded-xl hover:bg-slate-50 shrink-0 transition-all">Biologi</button>
        </div>

        <!-- Kelas yang Sedang Diikuti -->
        <div class="space-y-3">
            <h3 class="text-sm font-black text-slate-900">Kelas yang Sedang Diikuti</h3>

            <!-- Card Kelas 1 -->
            <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4 hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-black text-slate-900 leading-snug">Fisika Modern & UTBK</h4>
                            <p class="text-[10px] sm:text-xs text-slate-400 font-medium">Mentor: Kak Dr. Lutfi</p>
                        </div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=100&q=80" alt="Mentor" class="w-9 h-9 rounded-xl object-cover border border-slate-100 shadow-xs">
                </div>

                <!-- Progres Materi -->
                <div class="space-y-1.5 pt-1">
                    <div class="flex justify-between text-[11px] font-medium text-slate-500">
                        <span>Progres Materi</span>
                        <span class="font-bold text-slate-900">65% (12/18 Materi selesai)</span>
                    </div>
                    <!-- Progress Bar -->
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden p-0.5">
                        <div class="bg-indigo-600 h-full rounded-full transition-all duration-500" style="width: 65%"></div>
                    </div>
                </div>
            </div>

            <!-- Card Kelas 2 -->
            <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4 hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-black text-slate-900 leading-snug">Matematika Wajib K-12</h4>
                            <p class="text-[10px] sm:text-xs text-slate-400 font-medium">Mentor: Kak Sharly M.Si</p>
                        </div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Mentor" class="w-9 h-9 rounded-xl object-cover border border-slate-100 shadow-xs">
                </div>

                <!-- Progres Materi -->
                <div class="space-y-1.5 pt-1">
                    <div class="flex justify-between text-[11px] font-medium text-slate-500">
                        <span>Progres Materi</span>
                        <span class="font-bold text-slate-900">50% (12/24 Materi selesai)</span>
                    </div>
                    <!-- Progress Bar -->
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden p-0.5">
                        <div class="bg-indigo-600 h-full rounded-full transition-all duration-500" style="width: 50%"></div>
                    </div>
                </div>
            </div>

            <!-- Card Kelas 3 -->
            <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-100 shadow-sm space-y-4 hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs sm:text-sm font-black text-slate-900 leading-snug">Kimia Organik & Karbon</h4>
                            <p class="text-[10px] sm:text-xs text-slate-400 font-medium">Mentor: Kak Prof. Handoko</p>
                        </div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="Mentor" class="w-9 h-9 rounded-xl object-cover border border-slate-100 shadow-xs">
                </div>

                <!-- Progres Materi -->
                <div class="space-y-1.5 pt-1">
                    <div class="flex justify-between text-[11px] font-medium text-slate-500">
                        <span>Progres Materi</span>
                        <span class="font-bold text-slate-900">33% (5/16 Materi selesai)</span>
                    </div>
                    <!-- Progress Bar -->
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden p-0.5">
                        <div class="bg-indigo-600 h-full rounded-full transition-all duration-500" style="width: 33%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelas Interaktif Mendatang -->
        <div class="space-y-3">
            <h3 class="text-sm font-black text-slate-900">Kelas Interaktif Mendatang</h3>

            <div class="bg-white rounded-3xl p-4 sm:p-5 border border-slate-100 shadow-sm flex items-center justify-between hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-center space-x-3.5">
                    <div class="px-3 py-2 bg-rose-50 rounded-2xl text-rose-600 flex flex-col items-center justify-center shrink-0">
                        <span class="text-[9px] font-black uppercase tracking-wider">HARI INI</span>
                        <span class="text-xs font-black">15:30</span>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-black text-slate-900 leading-snug mb-0.5">Fisika Kuantan & Efek Fotolistrik</h4>
                        <p class="text-[10px] sm:text-xs text-slate-400 font-medium">Kak Dr. Lutfi • Persiapan UTBK</p>
                    </div>
                </div>
                <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 ml-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
        <a href="{{ route('siswa.kelas') }}" class="flex flex-col items-center space-y-1 text-indigo-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <span class="text-[10px] font-bold">Belajar</span>
        </a>
        <a href="{{ route('siswa.tugas') }}" class="flex flex-col items-center space-y-1 text-slate-400 hover:text-slate-600 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            <span class="text-[10px] font-medium">Ujian</span>
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