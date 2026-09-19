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
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Profil Guru -->
        <div class="flex items-center justify-between pt-2">
            <div class="flex items-center space-x-3.5">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&auto=format&fit=crop&q=80" alt="Foto Pak Lutfi" class="w-12 h-12 rounded-full object-cover shadow-sm border-2 border-indigo-600">
                <div>
                    <div class="flex items-center space-x-2">
                        <h1 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">Halo, Pak Lutfi!</h1>
                        <span class="text-xs" title="Tutor Utama">👨‍🏫</span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 font-semibold">Tutor Utama + Bidang Fisika & Sains</p>
                </div>
            </div>
        </div>

        <!-- Kartu Ringkasan Mengajar Pekan Ini -->
        <div class="bg-indigo-600 border-2 border-indigo-700 rounded-2xl p-6 text-white shadow-md space-y-4">
            <div class="flex items-center justify-between relative z-10">
                <span class="text-xs font-extrabold uppercase tracking-wider text-indigo-100">Ringkasan Mengajar Pekan Ini</span>
                <span class="text-xs font-extrabold bg-white/20 px-3 py-1 rounded-lg text-white border border-white/30">Semester Ganjil</span>
            </div>

            <!-- Statistik Grid -->
            <div class="grid grid-cols-3 pt-4 border-t-2 border-indigo-400/50 relative z-10 text-center">
                <div class="border-r-2 border-indigo-400/50 pr-2">
                    <div class="text-xl sm:text-2xl font-extrabold text-white">142</div>
                    <div class="text-xs text-indigo-100 font-extrabold truncate">Siswa Aktif</div>
                </div>
                <div class="px-2">
                    <div class="text-xl sm:text-2xl font-extrabold text-amber-300">08</div>
                    <div class="text-xs text-indigo-100 font-extrabold truncate">Butuh Nilai</div>
                </div>
                <div class="border-l-2 border-indigo-400/50 pl-2">
                    <div class="text-xl sm:text-2xl font-extrabold text-emerald-300">92%</div>
                    <div class="text-xs text-indigo-100 font-extrabold truncate">Kelulusan Kuis</div>
                </div>
            </div>
        </div>

        <!-- Section: Jadwal Mengajar Hari Ini -->
        <div class="space-y-3">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Jadwal Mengajar Hari Ini</h3>
                <a href="{{ route('guru.kelas') }}" class="text-xs font-extrabold text-indigo-600 hover:underline">Kelola Sesi</a>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="bg-white rounded-2xl border-2 border-slate-300 p-5 shadow-sm space-y-3 hover:border-indigo-600 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="rounded-lg bg-indigo-100 border border-indigo-300 px-3 py-1 text-xs font-extrabold uppercase tracking-wider text-indigo-800">Fisika XI - IPA 2</span>
                        <span class="text-xs font-bold text-slate-600 bg-slate-100 border border-slate-300 px-2.5 py-1 rounded-lg">08:00 - 09:30 WIB</span>
                    </div>
                    <div>
                        <h4 class="text-base font-extrabold text-slate-900">Bab 2: Eksperimen Efek Fotolistrik</h4>
                        <p class="text-xs font-semibold text-slate-500 mt-1">Laboratorium Fisika • 36 Siswa</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border-2 border-slate-300 p-5 shadow-sm space-y-3 hover:border-indigo-600 transition-all">
                    <div class="flex items-center justify-between">
                        <span class="rounded-lg bg-indigo-100 border border-indigo-300 px-3 py-1 text-xs font-extrabold uppercase tracking-wider text-indigo-800">Fisika XII - IPA 1</span>
                        <span class="text-xs font-bold text-slate-600 bg-slate-100 border border-slate-300 px-2.5 py-1 rounded-lg">10:00 - 11:30 WIB</span>
                    </div>
                    <div>
                        <h4 class="text-base font-extrabold text-slate-900">Bab 4: Termodinamika & Mesin Carnot</h4>
                        <p class="text-xs font-semibold text-slate-500 mt-1">Ruang Kelas XII-1 • 32 Siswa</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Tugas Perlu Dinilai -->
        <div class="space-y-3">
            <div class="px-1">
                <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Tugas Perlu Dinilai</h3>
            </div>

            <div class="space-y-3">
                <!-- List Item 1 -->
                <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-4.5 flex items-center justify-between hover:border-indigo-600 transition-all">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-800 border-2 border-rose-300 font-extrabold text-sm flex items-center justify-center flex-shrink-0">
                            !
                        </div>
                        <div class="space-y-0.5">
                            <h5 class="text-xs sm:text-sm font-extrabold text-slate-900">Laporan Praktikum Senyawa</h5>
                            <p class="text-xs font-semibold text-slate-600">Fisika Kelas XII • 12 Siswa Mengumpulkan</p>
                        </div>
                    </div>
                    <span class="text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-300 px-3 py-1 rounded-lg flex-shrink-0">Mendesak</span>
                </div>

                <!-- List Item 2 -->
                <div class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-4.5 flex items-center justify-between hover:border-indigo-600 transition-all">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 border-2 border-amber-300 font-extrabold text-sm flex items-center justify-center flex-shrink-0">
                            !
                        </div>
                        <div class="space-y-0.5">
                            <h5 class="text-xs sm:text-sm font-extrabold text-slate-900">Kuis Termodinamika Lanjutan</h5>
                            <p class="text-xs font-semibold text-slate-600">Fisika Kelas XII • 8 Siswa Menunggu Koreksi</p>
                        </div>
                    </div>
                    <span class="text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-300 px-3 py-1 rounded-lg flex-shrink-0">Sisa 1 Hari</span>
                </div>

            </div>
        </div>

    </div>

</body>
    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</html>