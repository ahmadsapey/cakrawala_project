<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | Cakrawala Educentre</title>
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
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24 md:pb-0">

    @include('components.hiderSiswa')

 
    <!-- Container Utama -->
    <div class="mx-auto grid min-h-screen w-full max-w-7xl grid-cols-1 gap-6 bg-[#F8FAFC] p-4 sm:p-6 md:grid-cols-12 md:gap-8 md:space-y-0 md:px-8 lg:px-12">

        <!-- Header Profil & Notifikasi -->
        <div class="col-span-1 flex items-center justify-between pt-2 md:col-span-12">
            <div class="flex items-center space-x-3">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Avatar Rayyan" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md shadow-indigo-100">
                <div>
                    <h2 class="text-sm font-black text-slate-900 flex items-center space-x-1.5">
                        <span>Halo, Rayyan!</span>
                        <span class="text-base">👋</span>
                    </h2>
                    <p class="text-xs text-slate-500 font-medium">Kelas 12 SMA • Kurikulum Merdeka</p>
                </div>
            </div>
            <!-- Tombol Notifikasi -->
            <button class="w-10 h-10 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-50 shadow-sm transition-all relative">
                <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 rounded-full"></span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </button>
        </div>

        <!-- Target Belajar Minggu Ini Card -->
        <div class="relative col-span-1 overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 to-indigo-700 p-5 text-white shadow-xl shadow-indigo-200 md:col-span-7">
            <!-- Background Accent Shapes -->
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
            
            <div class="flex items-center justify-between mb-3">
                <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-200">Target Belajar Minggu Ini</span>
                <span class="px-2.5 py-1 bg-white/20 backdrop-blur-md rounded-lg text-[10px] font-bold tracking-wider">Level 14</span>
            </div>
            
            <h3 class="text-base sm:text-lg font-black tracking-tight mb-3">Selesaikan 3 Misi Lagi!</h3>
            
            <div class="space-y-1.5">
                <div class="flex justify-between text-[11px] font-medium text-indigo-100">
                    <span>Progres Belajar</span>
                    <span class="font-bold">75% (6/8 Jam)</span>
                </div>
                <!-- Progress Bar -->
                <div class="w-full bg-black/20 rounded-full h-2.5 overflow-hidden p-0.5">
                    <div class="bg-amber-400 h-full rounded-full transition-all duration-500" style="width: 75%"></div>
                </div>
            </div>
        </div>

        <!-- Mata Pelajaran Section -->
        <div class="col-span-1 space-y-3 md:col-span-5">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-slate-900">Mata Pelajaran</h3>
                <a href="{{ route('siswa.materi') }}" class="text-xs font-bold text-indigo-600 hover:underline flex items-center space-x-0.5">
                    <span>Lihat Semua</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Grid Mata Pelajaran -->
            <div class="grid grid-cols-2 gap-3">
                <!-- Mapel 1 -->
                <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm hover:border-indigo-200 transition-all cursor-pointer flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Matematika Wajib</h4>
                        <p class="text-[10px] text-slate-400 font-medium">24 Materi</p>
                    </div>
                </div>

                <!-- Mapel 2 -->
                <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm hover:border-indigo-200 transition-all cursor-pointer flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Fisika Modern</h4>
                        <p class="text-[10px] text-slate-400 font-medium">18 Materi</p>
                    </div>
                </div>

                <!-- Mapel 3 -->
                <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm hover:border-indigo-200 transition-all cursor-pointer flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Kimia Organik</h4>
                        <p class="text-[10px] text-slate-400 font-medium">15 Materi</p>
                    </div>
                </div>

                <!-- Mapel 4 -->
                <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm hover:border-indigo-200 transition-all cursor-pointer flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Biologi Sel</h4>
                        <p class="text-[10px] text-slate-400 font-medium">20 Materi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelas Interaktif Hari Ini -->
        <div class="col-span-1 space-y-3 md:col-span-7">
            <h3 class="text-sm font-black text-slate-900">Kelas Interaktif Hari Ini</h3>
            
            <div class="bg-white rounded-3xl p-4 sm:p-5 border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between text-xs">
                    <span class="px-2.5 py-1 bg-rose-50 text-rose-600 font-bold rounded-lg flex items-center space-x-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                        <span>LIVE INTERAKTIF</span>
                    </span>
                    <span class="text-slate-400 font-medium">Hari Ini, 15:30 - 17:00 WIB</span>
                </div>

                <div>
                    <h4 class="text-sm sm:text-base font-black text-slate-900 mb-1">Fisika Kuantan & Efek Fotolistrik</h4>
                    <p class="text-xs text-slate-500 font-medium">Persiapan UTBK Mandiri Sesi 12</p>
                </div>

                <div class="pt-3 border-t border-slate-50 flex items-center justify-between">
                    <div class="flex items-center space-x-2.5">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=100&q=80" alt="Mentor" class="w-9 h-9 rounded-xl object-cover">
                        <div>
                            <h5 class="text-xs font-bold text-slate-900">Kak Dr. Lutfi</h5>
                            <p class="text-[10px] text-slate-400 font-medium">Alumni Fisika UI</p>
                        </div>
                    </div>
                    <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-100 transition-all flex items-center space-x-1.5">
                        <span>Gabung Kelas</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Rekomendasi Belajar -->
        <div class="col-span-1 space-y-3 md:col-span-5">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-black text-slate-900">Rekomendasi Belajar</h3>
                <a href="{{ route('siswa.materi') }}" class="text-xs font-bold text-indigo-600 hover:underline flex items-center space-x-0.5">
                    <span>Lainnya</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- List Video / Rekomendasi Horizontal Scroll -->
            <div class="grid grid-cols-2 gap-3">
                <!-- Item 1 -->
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm group cursor-pointer hover:border-indigo-200 transition-all">
                    <div class="h-28 bg-slate-900 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?auto=format&fit=crop&w=300&q=80" alt="Thumbnail" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300 opacity-80">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-2 left-2 right-2 flex items-center justify-between text-[10px] text-white font-medium">
                            <span class="flex items-center space-x-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>15m</span>
                            </span>
                            <span>12.4k ditonton</span>
                        </div>
                    </div>
                    <div class="p-3">
                        <h4 class="text-xs font-bold text-slate-900 line-clamp-2 leading-snug">Trik Cepat Limit Fungsi Trigonometri</h4>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm group cursor-pointer hover:border-indigo-200 transition-all">
                    <div class="h-28 bg-slate-900 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=300&q=80" alt="Thumbnail" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300 opacity-80">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-2 left-2 right-2 flex items-center justify-between text-[10px] text-white font-medium">
                            <span class="flex items-center space-x-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>12m</span>
                            </span>
                            <span>8.9k ditonton</span>
                        </div>
                    </div>
                    <div class="p-3">
                        <h4 class="text-xs font-bold text-slate-900 line-clamp-2 leading-snug">Konsep Mudah Medan Magnetik</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Navigation Bar (Opsional agar makin mirip aplikasi mobile edukasi) -->
    <div class="hidden fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white/90 backdrop-blur-md border-t border-slate-100 px-6 py-3 items-center justify-between z-50 shadow-lg">
        <a href="{{ route('siswa.home') }}" class="flex flex-col items-center space-y-1 text-indigo-600">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
            <span class="text-[10px] font-bold">Beranda</span>
        </a>
        <a href="{{ route('siswa.kelas') }}" class="flex flex-col items-center space-y-1 text-slate-400 hover:text-slate-600 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <span class="text-[10px] font-medium">Belajar</span>
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