<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Guru | Cakrawala Educentre</title>
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
    <div class="mx-auto flex min-h-screen w-full max-w-md flex-col space-y-6 bg-[#F8FAFC] p-4 sm:p-6 md:max-w-7xl md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Profil Guru -->
        <div class="flex items-center justify-between pt-2">
            <div class="flex items-center space-x-3">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&auto=format&fit=crop&q=80" alt="Foto Pak Lutfi" class="w-12 h-12 rounded-full object-cover shadow-sm border-2 border-white">
                <div>
                    <div class="flex items-center space-x-1.5">
                        <h1 class="text-sm font-black text-slate-900 tracking-tight">Halo, Pak Lutfi!</h1>
                        <span class="text-xs" title="Tutor Utama">👨‍🏫</span>
                    </div>
                    <p class="text-[11px] text-slate-500 font-medium">Tutor Utama + Bidang Fisika & Sains</p>
                </div>
            </div>
        </div>

        <!-- Kartu Ringkasan Mengajar Pekan Ini -->
        <div class="bg-indigo-600 rounded-3xl p-5 text-white shadow-xl shadow-indigo-100 relative overflow-hidden space-y-4">
            <!-- Elemen Dekoratif Background -->
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-indigo-500/30 rounded-full blur-xl pointer-events-none"></div>

            <div class="flex items-center justify-between relative z-10">
                <span class="text-[10px] font-black uppercase tracking-wider text-indigo-200">Ringkasan Mengajar Pekan Ini</span>
                <span class="text-[10px] font-bold bg-white/20 px-2.5 py-1 rounded-full text-white">Semester Ganjil</span>
            </div>

            <div class="relative z-10">
                <h2 class="text-base sm:text-lg font-black tracking-tight leading-snug">4 Sesi Kelas Interaktif Berjalan</h2>
            </div>

            <!-- Statistik Grid -->
            <div class="grid grid-cols-3 pt-2 border-t border-indigo-500/50 relative z-10 text-center">
                <div class="border-r border-indigo-500/50 pr-2">
                    <div class="text-base sm:text-lg font-black text-white">142</div>
                    <div class="text-[10px] text-indigo-200 font-medium truncate">Siswa Aktif</div>
                </div>
                <div class="px-2">
                    <div class="text-base sm:text-lg font-black text-amber-300">08</div>
                    <div class="text-[10px] text-indigo-200 font-medium truncate">Butuh Nilai</div>
                </div>
                <div class="border-l border-indigo-500/50 pl-2">
                    <div class="text-base sm:text-lg font-black text-emerald-300">92%</div>
                    <div class="text-[10px] text-indigo-200 font-medium truncate">Kelulusan Kuis</div>
                </div>
            </div>
        </div>

        <!-- Section: Jadwal Mengajar Hari Ini -->
        <div class="space-y-3">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-400">Jadwal Mengajar Hari Ini</h3>
                <a href="{{ route('guru.kelas') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors">Kelola Sesi</a>
            </div>

            <!-- Kartu Jadwal Mengajar -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <!-- Status Badge: Sedang Live -->
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black bg-rose-50 text-rose-600 space-x-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-600 animate-pulse"></span>
                        <span>Sesi Sedang Live</span>
                    </span>
                    <span class="text-xs font-bold text-slate-400">15:30 - 17:00 WIB</span>
                </div>

                <div class="space-y-1">
                    <h4 class="text-xs sm:text-sm font-black text-slate-900 tracking-tight">Fisika Kuantum & Efek Fotolistrik</h4>
                    <p class="text-[11px] text-slate-500 font-medium">Siswa Terdaftar: Kelas XI - IPA 2 (36 Orang)</p>
                </div>

                <div class="pt-2 border-t border-slate-50 flex items-center justify-between">
                    <span class="text-[11px] text-slate-400 font-medium">Platform: Cakrawala Live Stream</span>
                    <button class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-100 transition-all">
                        Mulai Mengajar
                    </button>
                </div>
            </div>
        </div>

        <!-- Section: Tugas Perlu Dinilai -->
        <div class="space-y-3">
            <div class="px-1">
                <h3 class="text-xs font-black uppercase tracking-wider text-slate-400">Tugas Perlu Dinilai</h3>
            </div>

            <div class="space-y-2.5">
                
                <!-- List Item 1: Laporan Praktikum Senyawa -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 flex items-center justify-between hover:border-slate-200 transition-all">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 font-black text-xs flex items-center justify-center flex-shrink-0">
                            !
                        </div>
                        <div class="space-y-0.5">
                            <h5 class="text-xs font-bold text-slate-900">Laporan Praktikum Senyawa</h5>
                            <p class="text-[10px] text-slate-400 font-medium">Fisika Kelas XII • 12 Siswa Mengumpulkan</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold bg-rose-50 text-rose-600 px-2.5 py-1 rounded-full flex-shrink-0">Mendesak</span>
                </div>

                <!-- List Item 2: Kuis Termodinamika Lanjutan -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 flex items-center justify-between hover:border-slate-200 transition-all">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 font-black text-xs flex items-center justify-center flex-shrink-0">
                            !
                        </div>
                        <div class="space-y-0.5">
                            <h5 class="text-xs font-bold text-slate-900">Kuis Termodinamika Lanjutan</h5>
                            <p class="text-[10px] text-slate-400 font-medium">Fisika Kelas XII • 8 Siswa Menunggu Koreksi</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold bg-amber-50 text-amber-600 px-2.5 py-1 rounded-full flex-shrink-0">Sisa 1 Hari</span>
                </div>

            </div>
        </div>

    </div>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')

</body>
</html>