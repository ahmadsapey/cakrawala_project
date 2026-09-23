<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rasionalisasi Prodi SNBP | Cakrawala Educentre</title>
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
    <style>
        /* Sembunyikan scrollbar untuk tampilan card bergulir yang bersih */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .neon-card {
            transition: border-color 300ms ease, box-shadow 300ms ease, transform 300ms ease;
        }

        .neon-card:hover,
        .neon-card:focus-within,
        .neon-card:active {
            border-color: #38bdf8;
            box-shadow: 0 0 0 1px #38bdf8, 0 0 18px rgba(14, 165, 233, 0.48), 0 0 36px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white">

    @include('components.header')

    <!-- Hero Section dengan Auto-Scroll Colosal Cards -->
    <section class="relative pt-10 pb-16 lg:pt-20 lg:pb-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Kolom Kiri: Teks & Statistik -->
                <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 bg-indigo-50 border border-indigo-100 px-3.5 py-1.5 rounded-full text-indigo-600 text-xs font-semibold tracking-wide mx-auto lg:mx-0">
                        <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                        <span class="uppercase">Pilihan Belajar Terbaik di Indonesia</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15]">
                        Belajar Lebih Mudah dengan Cakrawala Educentre
                    </h1>

                    <p class="text-slate-600 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Temukan cara belajar efektif, interaktif, dan fleksibel untuk menguasai berbagai materi pelajaran sesuai impianmu.
                    </p>

                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="{{ route('siswa.home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-7 py-3.5 rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5">
                            Login Mulai Belajar
                        </a>
                        <a href="#about" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-medium text-sm px-7 py-3.5 rounded-xl transition-all">
                            DAFTAR
                        </a>
                    </div>

                    <!-- Statistik Bawah Hero -->
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-slate-200/80 max-w-md mx-auto lg:mx-0">
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-900">15,000+</p>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">Pengguna aktif</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-900">1,200+</p>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">Modul belajar</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-900">4.9/5.0</p>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">Kepuasan user</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Colosal Cards Bergulir Otomatis setiap 3 Detik (Hero) -->
                <div class="lg:col-span-6 relative w-full">
                    <div class="flex items-center justify-between mb-4 px-2">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Program & Modul Pilihan</span>
                        
                    </div>
                    
                    <div id="autoScrollHero" class="flex space-x-5 overflow-x-auto no-scrollbar pb-6 pt-2 snap-x snap-mandatory px-2 scroll-smooth-container">
                        @foreach ($programs as $program)
                            <article class="neon-card min-w-[300px] sm:min-w-[300px] bg-white p-5 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 snap-start flex-shrink-0">
                                @if ($program->image_url)
                                    <div class="h-36 bg-slate-100 rounded-2xl mb-4 overflow-hidden">
                                        <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <span class="text-[10px] uppercase font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md tracking-wider">{{ $program->badge }}</span>
                                <h4 class="font-bold text-slate-900 text-base mt-2">{{ $program->title }}</h4>
                                <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">{{ $program->description }}</p>
                                <div class="flex items-center space-x-2 text-xs text-slate-500 mt-2">
                                    <span>{{ $program->meta }}</span>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                    <span class="text-slate-400">{{ $program->price }}{{ $program->price_suffix }}</span>
                                    <span class="w-5 h-5 rounded-full bg-blue-50 text-indigo-600 flex items-center justify-center font-bold text-xs">✓</span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Pricing Section: Diubah Menjadi Colossal Grid yang Bergulir Otomatis Setiap 3 Detik -->
    <section id="pricing" class="py-24 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            
            <div class="text-center max-w-2xl mx-auto space-y-3 mb-12">
                <span class="text-xs uppercase font-bold tracking-widest text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">ONLINE SCHEDULE</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Cakrawala Educentre</h2>
                <h3 class="text-base font-bold text-slate-700 tracking-wide uppercase">PT. INDO PRESTASI UTAMA</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Pilihan tepat untuk mendampingi proses belajar dengan sistem terbaik dan kurikulum mutakhir dari Cakrawala Educentre.</p>
            </div>

            <!-- Header Kecil Penanda Auto-Scroll Pricing -->
            <div class="flex items-center justify-between mb-4 px-2 max-w-6xl mx-auto">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Geser & Pilih Paket Layanan</span>
            </div>

            <!-- Pricing Colossal Container: Bergulir Otomatis (Auto-Scroll) & Rapi Tanpa Memanjang ke Bawah -->
            <div id="autoScrollPricing" class="flex space-x-6 overflow-x-auto no-scrollbar pb-8 pt-2 snap-x snap-mandatory px-2 scroll-smooth-container max-w-6xl mx-auto">
                @foreach ($packages as $package)
                    <article class="neon-card min-w-[280px] sm:min-w-[300px] lg:min-w-[270px] {{ $package->is_featured ? 'bg-indigo-600 text-white' : 'bg-white text-slate-900' }} rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 snap-start flex-shrink-0 flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] uppercase font-bold tracking-wider {{ $package->is_featured ? 'text-indigo-100 bg-white/10' : 'text-indigo-600 bg-indigo-50' }} px-2.5 py-1 rounded-md">{{ $package->badge }}</span>
                            <h4 class="font-bold text-base mt-4">{{ $package->title }}</h4>
                            <p class="{{ $package->is_featured ? 'text-indigo-100' : 'text-slate-500' }} text-xs leading-relaxed mt-2 mb-5">{{ $package->description }}</p>
                            <div class="mb-5">
                                <span class="text-[10px] {{ $package->is_featured ? 'text-indigo-200' : 'text-slate-400' }} block mb-0.5">Mulai dari</span>
                                <span class="text-xl font-black">{{ $package->price }}<span class="text-xs font-normal {{ $package->is_featured ? 'text-indigo-200' : 'text-slate-500' }}">{{ $package->price_suffix }}</span></span>
                            </div>
                            <ul class="space-y-2.5 mb-6 text-xs {{ $package->is_featured ? 'text-indigo-100' : 'text-slate-600' }}">
                                @foreach ($package->features ?? [] as $feature)
                                    <li class="flex items-center space-x-2"><span class="{{ $package->is_featured ? 'text-white' : 'text-indigo-600' }} font-bold">✓</span><span>{{ $feature }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('siswa.home') }}" class="w-full py-3 rounded-xl {{ $package->is_featured ? 'bg-white text-indigo-600 hover:bg-slate-50 font-bold' : 'border border-slate-200 hover:border-indigo-600 text-slate-700 hover:text-indigo-600 font-medium' }} text-xs text-center transition-colors">
                            {{ $package->cta_label }}
                        </a>
                    </article>
                @endforeach

                <!-- Pricing cards are managed from the admin landing page. -->
                <!--
                <div class="neon-card min-w-[280px] sm:min-w-[300px] lg:min-w-[270px] bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 snap-start flex-shrink-0 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-base mb-1.5">Rasionalisasi SNBP</h4>
                        <p class="text-slate-500 text-xs leading-relaxed mb-5">Analisis strategi prodi akurat berdasarkan nilai rapor dan data.</p>
                        <div class="mb-5">
                            <span class="text-[10px] text-slate-400 block mb-0.5">Mulai dari</span>
                            <span class="text-xl font-black text-indigo-600">Rp 15.000<span class="text-xs font-normal text-slate-500">/karya</span></span>
                        </div>
                        <ul class="space-y-2.5 mb-6 text-xs text-slate-600">
                            <li class="flex items-center space-x-2"><span class="text-indigo-600 font-bold">✓</span><span>Rekomendasi prodi tepat</span></li>
                            <li class="flex items-center space-x-2"><span class="text-indigo-600 font-bold">✓</span><span>Validasi data rapor online</span></li>
                        </ul>
                    </div>
                    <button class="w-full py-3 rounded-xl border border-slate-200 hover:border-indigo-600 text-slate-700 hover:text-indigo-600 font-medium text-xs transition-colors">
                        Analisis Rapor
                    </button>
                </div>

                <!-- Pricing Card 4: Tryout Nasional -->
                <div class="neon-card min-w-[280px] sm:min-w-[300px] lg:min-w-[270px] bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 snap-start flex-shrink-0 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-base mb-1.5">Tryout Nasional</h4>
                        <p class="text-slate-500 text-xs leading-relaxed mb-5">Simulasi ujian berkala nasional dengan sistem penilaian IRT.</p>
                        <div class="mb-5">
                            <span class="text-[10px] text-slate-400 block mb-0.5">Mulai dari</span>
                            <span class="text-xl font-black text-indigo-600">Rp 25.000<span class="text-xs font-normal text-slate-500">/sesi</span></span>
                        </div>
                        <ul class="space-y-2.5 mb-6 text-xs text-slate-600">
                            <li class="flex items-center space-x-2"><span class="text-indigo-600 font-bold">✓</span><span>Sistem penilaian mirip UTBK</span></li>
                            <li class="flex items-center space-x-2"><span class="text-indigo-600 font-bold">✓</span><span>Peringkat nasional & analisis</span></li>
                        </ul>
                    </div>
                    <button class="w-full py-3 rounded-xl border border-slate-200 hover:border-indigo-600 text-slate-700 hover:text-indigo-600 font-medium text-xs transition-colors">
                        Daftar Tryout
                    </button>
                </div>

                <!-- Pricing Card 5: Konsultasi 1 on 1 (Tambahan Konten Baru) -->
                <div class="neon-card min-w-[280px] sm:min-w-[300px] lg:min-w-[270px] bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 snap-start flex-shrink-0 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-base mb-1.5">Konsultasi Privat</h4>
                        <p class="text-slate-500 text-xs leading-relaxed mb-5">Sesi diskusi khusus personal dengan mentor ahli untuk bedah masalah.</p>
                        <div class="mb-5">
                            <span class="text-[10px] text-slate-400 block mb-0.5">Mulai dari</span>
                            <span class="text-xl font-black text-indigo-600">Rp 99.000<span class="text-xs font-normal text-slate-500">/jam</span></span>
                        </div>
                        <ul class="space-y-2.5 mb-6 text-xs text-slate-600">
                            <li class="flex items-center space-x-2"><span class="text-indigo-600 font-bold">✓</span><span>1 on 1 via video call</span></li>
                            <li class="flex items-center space-x-2"><span class="text-indigo-600 font-bold">✓</span><span>Solusi bedah soal mendalam</span></li>
                        </ul>
                    </div>
                    <button class="w-full py-3 rounded-xl border border-slate-200 hover:border-indigo-600 text-slate-700 hover:text-indigo-600 font-medium text-xs transition-colors">
                        Book Jadwal
                    </button>
                </div>
                -->

            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="about" class="py-24 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-5 space-y-6">
                    <span class="text-xs uppercase font-bold tracking-widest text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">PREPARING ANY COURSE</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Mengapa Memilih Cakrawala Educentre?
                    </h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Kami berkomitmen memberikan pendidikan berkualitas dengan pendekatan interaktif demi kemajuan belajar terbaik siswa.
                    </p>
                    <div class="neon-card bg-indigo-600 text-white p-6 rounded-2xl shadow-xl shadow-indigo-100">
                        <h4 class="font-bold text-xs uppercase tracking-wider mb-1.5">DENGAN PILIHAN KAMI</h4>
                        <p class="text-xs text-indigo-100 leading-relaxed">
                            Nikmati kemudahan akses materi kapan pun dan di mana pun sesuai kebutuhan perkembangan belajar kamu.
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="neon-card bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1.5">Sistem Komprehensif</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Seluruh komponen belajar dirancang sistematis untuk hasil maksimal.</p>
                    </div>

                    <div class="neon-card bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1.5">Biaya Terjangkau</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Investasi pendidikan terbaik tanpa beban biaya tinggi.</p>
                    </div>

                    <div class="neon-card bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1.5">Program Berfokus</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Spesifik mempersiapkan siswa menghadapi seleksi masuk perguruan tinggi.</p>
                    </div>

                    <div class="neon-card bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1.5">Target Akademik</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Fokus pada peningkatan nilai demi tercapainya target kelulusan.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Bottom Dark CTA Banner -->
    <section class="py-16 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="neon-card bg-[#0B0F19] rounded-3xl p-10 sm:p-14 text-center text-white relative overflow-hidden shadow-2xl">
                <div class="absolute -top-24 -left-24 w-80 h-80 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-purple-500/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <h3 class="text-2xl sm:text-3xl font-black tracking-tight mb-4">
                    Siap Naikkan Prestasi Akademikmu di Cakrawala?
                </h3>
                <p class="text-slate-400 text-sm sm:text-base max-w-xl mx-auto mb-8 leading-relaxed">
                    Kombinasi bimbingan, sistem, dan tutor terbaik siap membantumu meraih cita-cita masuk kampus impian lewat Cakrawala Educentre.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('siswa.home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-7 py-3.5 rounded-xl shadow-lg transition-transform hover:-translate-y-0.5">
                        Mulai Konsultasi Sekarang
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener" class="bg-white/10 hover:bg-white/20 text-white font-medium text-sm px-7 py-3.5 rounded-xl transition-colors">
                        Hubungi WhatsApp Konsultan
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- JavaScript untuk Auto-Scroll Otomatis Hero & Pricing setiap 3 Detik -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fungsi umum untuk membuat elemen bisa auto-scroll horizontal
            function setupAutoScroll(containerId, scrollAmount = 300, intervalTime = 3000) {
                const container = document.getElementById(containerId);
                if (!container) return;

                let scrollInterval;

                function startScrolling() {
                    scrollInterval = setInterval(() => {
                        // Jika sudah mencapai ujung kanan, kembalikan ke awal (0)
                        if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                            container.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                        }
                    }, intervalTime);
                }

                startScrolling();

                // Berhenti otomatis saat kursor diarahkan ke container (agar user bisa baca/klik)
                container.addEventListener("mouseenter", () => clearInterval(scrollInterval));
                container.addEventListener("mouseleave", () => startScrolling());
            }

            // Terapkan auto-scroll ke Hero cards dan Pricing cards
            setupAutoScroll("autoScrollHero", 320, 3000);
            setupAutoScroll("autoScrollPricing", 290, 3000);
        });
    </script>

    @include('components.footer')

</body>
</html>