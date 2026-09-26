<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami | Cakrawala Educentre</title>
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
    @include('components.fonts')
</head>
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.header')

    <div class="mx-auto flex min-h-screen max-w-7xl flex-col gap-6 px-4 py-6 sm:px-6 lg:gap-8 lg:px-12 lg:py-10">

        <!-- Section: Hero / Banner Utama -->
        <div class="bg-gradient-to-br from-indigo-900 to-indigo-700 rounded-3xl p-6 sm:p-8 lg:p-12 text-white space-y-3 shadow-xl relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-indigo-500/20 rounded-full blur-2xl"></div>
            <span class="px-3 py-1 bg-white/10 text-indigo-200 text-[10px] font-black uppercase tracking-wider rounded-full backdrop-blur-md">Tentang Perusahaan</span>
            <h1 class="text-xl sm:text-3xl lg:text-5xl max-w-3xl font-black tracking-tight leading-snug">
                Membangun Masa Depan Pendidikan Melalui Inovasi Digital
            </h1>
            <p class="text-xs sm:text-sm lg:text-base max-w-3xl text-indigo-100 font-medium leading-relaxed">
                Kami adalah institusi pengembang teknologi pendidikan terdepan yang berfokus pada digitalisasi manajemen sekolah, efisiensi akademik, dan peningkatan kualitas pembelajaran modern.
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
        <!-- Section: Sambutan Pengelola / Founder -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5 sm:p-7 space-y-4">
            <div class="flex items-center space-x-3.5">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150" alt="Founder & CEO" class="w-14 h-14 rounded-2xl object-cover shadow-md flex-shrink-0">
                <div class="space-y-0.5 overflow-hidden">
                    <h3 class="text-xs sm:text-sm font-black text-slate-900 truncate">Dr. Lutfi Hakim, M.Pd</h3>
                    <p class="text-[10px] text-indigo-600 font-bold tracking-wide uppercase">Founder & CEO Cakrawala</p>
                </div>
            </div>
            
            <div class="relative pl-3.5 border-l-2 border-indigo-500 space-y-2">
                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">Sambutan Pimpinan</span>
                <p class="text-xs text-slate-600 font-medium leading-relaxed italic">
                    "Selamat datang di Cakrawala Educentre. Kami percaya bahwa teknologi dan pendidikan adalah kombinasi terkuat untuk mencetak generasi unggul. Komitmen kami adalah terus mendampingi sekolah dan tenaga pendidik dalam menghadapi transformasi digital dengan sistem yang handal, transparan, dan mudah digunakan."
                </p>
            </div>
        </div>

        <!-- Section: Visi & Misi Perusahaan -->
        <div class="space-y-3">
            <h2 class="text-xs font-black uppercase tracking-wider text-slate-400 px-1">Visi & Misi Perusahaan</h2>

            <!-- Kartu Visi -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5 space-y-2">
                <div class="flex items-center space-x-2 text-indigo-600">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span class="text-xs font-black uppercase tracking-wider">Visi Utama</span>
                </div>
                <p class="text-xs text-slate-700 font-bold leading-relaxed">
                    "Menjadi ekosistem digital pendidikan nomor satu di Indonesia yang mewujudkan tata kelola institusi transparan, modern, dan berdaya saing global."
                </p>
            </div>

            <!-- Kartu Misi -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5 space-y-3">
                <div class="flex items-center space-x-2 text-emerald-600">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-6 9l2 2 4-4"/></svg>
                    <span class="text-xs font-black uppercase tracking-wider">Misi Perusahaan</span>
                </div>
                
                <ul class="space-y-2 text-xs text-slate-600 font-medium">
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 mt-1.5 flex-shrink-0"></span>
                        <span>Menyediakan platform manajemen sekolah terintegrasi yang mudah diakses oleh seluruh elemen institusi.</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 mt-1.5 flex-shrink-0"></span>
                        <span>Meningkatkan efisiensi kerja tenaga pengajar melalui otomatisasi nilai, absensi, dan administrasi keuangan.</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 mt-1.5 flex-shrink-0"></span>
                        <span>Menghadirkan inovasi pembelajaran interaktif berbasis teknologi cloud untuk siswa di seluruh Indonesia.</span>
                    </li>
                </ul>
            </div>

        </div>
        </div>

        <!-- Tombol Aksi / Footer Call to Action -->
        <div id="kontak" class="pt-2 lg:pt-4 lg:max-w-xl lg:self-center lg:w-full">
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                <span>Hubungi Tim Kami &rarr;</span>
            </button>
        </div>

    </div>

</body>
</html>