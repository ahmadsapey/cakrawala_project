<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | Cakrawala Educentre - PT Indo Prestasi Utama</title>
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

<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white">

    @include('components.header')

    <!-- Hero Section: Profile Perusahaan -->
    <section class="relative overflow-hidden bg-gradient-to-b from-indigo-950 via-slate-900 to-slate-950 py-20 text-white">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12 relative z-10">
            <div class="max-w-3xl space-y-5">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1.5 text-xs font-bold text-indigo-300 backdrop-blur-md border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    PT INDO PRESTASI UTAMA · CAKRAWALA EDUCENTRE
                </div>
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                    Startup Jasa Layanan Pendidikan Terintegrasi & Mitra Belajar Terpercaya
                </h1>
                <p class="text-sm sm:text-base text-slate-300 font-normal leading-relaxed">
                    Cakrawala Educentre bertekad memberikan pelayanan pendidikan terbaik dan menjadi mitra belajar terpercaya bagi anak. Kami mengintegrasikan bimbingan belajar tatap muka, les privat berkualitas, serta platform digital LMS modern untuk siswa, orang tua, dan institusi sekolah di seluruh Indonesia.
                </p>
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('siswa.login') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-xs sm:text-sm font-black text-white hover:bg-indigo-700 shadow-lg shadow-indigo-600/30 transition-all">
                        <span>Masuk Portal Belajar</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#empat-pilar" class="inline-flex items-center gap-2 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 px-5 py-3 text-xs sm:text-sm font-bold text-white transition-all">
                        <span>Lihat 4 Pilar Layanan</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
    </section>

    <!-- 4 Pilar Layanan Cakrawala Educentre -->
    <section id="empat-pilar" class="py-16 sm:py-20 bg-white">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12 space-y-12">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="text-xs font-black uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-200">
                    Fondasi Layanan Pendidikan
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    4 Pilar Utama Layanan Cakrawala
                </h2>
                <p class="text-sm text-slate-600">
                    Dirancang komprehensif mulai dari pemahaman fondasi usia dini hingga persiapan seleksi masuk perguruan tinggi dan madrasah unggulan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pilar 1 -->
                <div class="p-6 rounded-2xl border-2 border-slate-200 hover:border-indigo-600 hover:shadow-xl transition-all space-y-4 bg-slate-50/50 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-black text-xl">
                            01
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900">Les Privat</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Pendampingan personal 1-on-1 baik secara <strong>Online (Video Interaktif)</strong> maupun <strong>Offline (Guru Datang ke Rumah)</strong> dengan kurikulum yang disesuaikan kebutuhan spesifik siswa.
                        </p>
                    </div>
                    <ul class="pt-3 border-t border-slate-200 text-xs text-slate-600 space-y-1.5 font-medium">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>Jadwal fleksibel</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>Tutor terverifikasi</li>
                    </ul>
                </div>

                <!-- Pilar 2 -->
                <div class="p-6 rounded-2xl border-2 border-slate-200 hover:border-indigo-600 hover:shadow-xl transition-all space-y-4 bg-slate-50/50 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-black text-xl">
                            02
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900">Bimbingan Belajar</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Bimbel Terpadu untuk siswa SD, SMP, hingga SMA. Fokus pada pendalaman konsep sains, matematika, bahasa, serta persiapan ujian kenaikan kelas dan kelulusan.
                        </p>
                    </div>
                    <ul class="pt-3 border-t border-slate-200 text-xs text-slate-600 space-y-1.5 font-medium">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>Modul latihan tuntas</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>Diskusi kelompok intensif</li>
                    </ul>
                </div>

                <!-- Pilar 3 -->
                <div class="p-6 rounded-2xl border-2 border-amber-300 hover:border-amber-500 hover:shadow-xl transition-all space-y-4 bg-amber-50/30 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center font-black text-xl">
                            03
                        </div>
                        <div class="inline-block px-2 py-0.5 rounded text-[10px] font-black bg-amber-200 text-amber-900">MITRA RESMI</div>
                        <h3 class="text-lg font-extrabold text-slate-900">Vendor Pendidikan & Sekolah</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Penyelenggaraan event edukasi, Tryout Akbar CBT berstandar nasional, dan integrasi Learning Management System (LMS) bersama mitra unggulan seperti <strong>MAN Insan Cendikia</strong>.
                        </p>
                    </div>
                    <ul class="pt-3 border-t border-amber-200 text-xs text-slate-600 space-y-1.5 font-medium">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>Simulasi CBT Skolastik</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>Penilaian IRT akurat</li>
                    </ul>
                </div>

                <!-- Pilar 4 -->
                <div class="p-6 rounded-2xl border-2 border-slate-200 hover:border-indigo-600 hover:shadow-xl transition-all space-y-4 bg-slate-50/50 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-black text-xl">
                            04
                        </div>
                        <h3 class="text-lg font-extrabold text-slate-900">Calistung & Pengayaan</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Program membaca, menulis, dan berhitung dengan metode ramah anak, serta pendalaman materi pelajaran dasar untuk membangun fondasi logika berpikir sejak dini.
                        </p>
                    </div>
                    <ul class="pt-3 border-t border-slate-200 text-xs text-slate-600 space-y-1.5 font-medium">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>Metode fonik & interaktif</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>Laporan progres rutin</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Kolaborasi Khusus: MAN Insan Cendikia -->
    <section class="py-16 bg-slate-100 border-y border-slate-200">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
            <div class="bg-white rounded-3xl border-2 border-amber-300 p-8 sm:p-12 shadow-md grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-4">
                    <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-black uppercase tracking-wider border border-amber-300">
                        Kerjasama Program & Event Akbar
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        Kemitraan Edukasi & LMS bersama MAN Insan Cendikia
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Cakrawala Educentre bangga dipercaya sebagai mitra vendor dan platform LMS dalam menyelenggarakan simulasi Tryout Akbar, pembinaan materi kompetisi, serta manajemen bank soal untuk seleksi madrasah unggulan dan persiapan SNBT.
                    </p>
                    <div class="pt-2 flex flex-wrap gap-4 text-xs font-bold text-slate-700">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>Tryout CBT Skala Nasional</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>Bank Soal Standar Kemenag & UTBK</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>Dashboard Pantau Nilai Siswa</span>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 flex flex-col items-center justify-center p-6 bg-amber-50/60 rounded-2xl border border-amber-200 text-center space-y-3">
                    <div class="w-16 h-16 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-2xl font-black shadow-lg shadow-amber-500/30">
                        IC
                    </div>
                    <h4 class="text-sm font-extrabold text-slate-900">Event Tryout Akbar 2026</h4>
                    <p class="text-[11px] text-slate-500">Akses modul simulasi dan registrasi peserta tryout langsung melalui portal Cakrawala.</p>
                    <a href="{{ route('siswa.tryout') }}" class="w-full px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-xl transition-all">
                        Ikuti Tryout CBT &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Nilai & Keunggulan Kami -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12 space-y-12">
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    Mengapa Memilih Cakrawala Educentre?
                </h2>
                <p class="text-xs sm:text-sm text-slate-500">
                    Standar layanan bimbingan kami berorientasi pada hasil dan perkembangan karakter belajar siswa.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Tutor Terseleksi & Berpengalaman</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Seluruh pengajar melalui tahapan seleksi akademis dan micro-teaching ketat untuk memastikan penyampaian materi yang mudah dipahami.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Teknologi LMS Terintegrasi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Siswa dan orang tua dapat memantau jadwal, mengunduh modul, mengerjakan kuis CBT, serta melacak progres nilai secara transparan dalam satu sistem.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Pendekatan Personal</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Setiap anak memiliki ritme belajar yang berbeda. Kurikulum dan modul disesuaikan dengan gaya belajar anak untuk hasil optimal.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

</body>

</html>