<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Materi Belajar | Cakrawala Educentre</title>
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

        <!-- Header -->
        <div class="flex items-center justify-between pt-2">
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight flex items-center space-x-2">Detail Materi Belajar</h1>
            <button class="w-10 h-10 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-50 shadow-sm transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/></svg>
            </button>
        </div>

        <!-- Pemutar Video / Video Player Section -->
        <div class="relative rounded-3xl overflow-hidden bg-slate-900 shadow-lg aspect-video group cursor-pointer">
            <img src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?auto=format&fit=crop&w=600&q=80" alt="Video Thumbnail" class="w-full h-full object-cover opacity-75 group-hover:scale-105 transition-all duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20"></div>
            
            <!-- Tombol Play Tengah -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-14 h-14 rounded-full bg-white/90 backdrop-blur-md text-indigo-600 flex items-center justify-center shadow-2xl group-hover:scale-110 transition-all duration-300 pl-0.5">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
            </div>

            <!-- Durasi Video -->
            <div class="absolute bottom-3 right-3 px-2.5 py-1 bg-black/60 backdrop-blur-md rounded-lg text-[10px] font-bold text-white tracking-wider">
                12:45
            </div>
        </div>

        <!-- Info Materi & Label -->
        <div class="space-y-2">
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 bg-rose-50 text-rose-500 text-[10px] font-bold rounded-lg">Fisika Modern</span>
                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-lg">UTBK Mandiri</span>
            </div>

            <h2 class="text-base sm:text-lg font-black text-slate-900 leading-snug">Efek Fotolistrik & Teori Foton</h2>

            <div class="flex items-center space-x-2.5 pt-1">
                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=100&q=80" alt="Mentor" class="w-7 h-7 rounded-xl object-cover border border-slate-100">
                <p class="text-xs text-slate-500 font-medium">Oleh <span class="font-bold text-slate-900">Kak Dr. Lutfi</span> • Alumni Fisika UI</p>
            </div>
        </div>

        <!-- Modul Pembelajaran -->
        <div class="space-y-3">
            <h3 class="text-sm font-black text-slate-900">Modul Pembelajaran</h3>

            <div class="space-y-2.5">
                <!-- Modul 1 (Selesai) -->
                <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-slate-200 transition-all cursor-pointer">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">01. Teori Kuantum Max Planck</h4>
                            <p class="text-[10px] text-emerald-600 font-bold">Selesai</p>
                        </div>
                    </div>
                </div>

                <!-- Modul 2 (Sedang Dipelajari - Active) -->
                <div class="bg-white p-3.5 rounded-2xl border-2 border-indigo-600/30 shadow-sm flex items-center justify-between bg-indigo-50/20 cursor-pointer relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-600"></div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                            <span class="w-3 h-3 rounded-full border-2 border-indigo-600 border-t-transparent animate-spin"></span>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">02. Eksperimen Efek Fotolistrik</h4>
                            <p class="text-[10px] text-indigo-600 font-bold">Sedang Dipelajari</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Materi Pendukung (PDF) -->
        <div class="space-y-3">
            <h3 class="text-sm font-black text-slate-900">Materi Pendukung (PDF)</h3>

            <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0 font-black text-[10px]">
                        PDF
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Rumus_Cepat_Efek_Fotolistrik_UTBK.pdf</h4>
                        <p class="text-[10px] text-slate-400 font-medium">Dokumen Ringkasan • 2.4 MB</p>
                    </div>
                </div>
                <button class="w-9 h-9 rounded-xl bg-slate-50 text-indigo-600 hover:bg-indigo-50 flex items-center justify-center transition-all shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                </button>
            </div>
        </div>

        <!-- Kuis Evaluasi -->
        <div class="space-y-3">
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-center space-x-3.5">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 leading-snug">Kuis Evaluasi Efek Fotolistrik</h4>
                        <p class="text-[10px] text-slate-400 font-medium">10 Soal Pilihan Ganda • Fisika Modern</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 bg-rose-50 text-rose-600 font-bold text-[10px] rounded-lg shrink-0">
                    Sisa 3 jam!
                </span>
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>