<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengerjaan | Cakrawala Educentre</title>
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

        <!-- Header: Judul & Timer Mundur -->
        <div class="flex items-center justify-between pt-2">
            <h1 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Pengerjaan</h1>
            <div class="px-3 py-1.5 bg-rose-50 border border-rose-100 rounded-xl flex items-center space-x-1.5 text-rose-600 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-xs font-black tracking-wider">14:25</span>
            </div>
        </div>

        <!-- Progress Bar Ujian -->
        <div class="space-y-1.5 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between text-xs font-bold">
                <span class="text-slate-500">Soal Ke 4 dari 10</span>
                <span class="text-indigo-600">40% Selesai</span>
            </div>
            <!-- Progress Line -->
            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden p-0.5">
                <div class="bg-indigo-600 h-full rounded-full transition-all duration-500" style="width: 40%"></div>
            </div>
        </div>

        <!-- Kotak Soal -->
        <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm space-y-3">
            <span class="inline-block px-2.5 py-1 bg-indigo-50 text-indigo-600 font-black text-[10px] rounded-lg">SOAL NO. 4</span>
            <p class="text-xs sm:text-sm font-bold text-slate-900 leading-relaxed">
                Jika matriks $A$ berordo $2 \times 2$ memiliki nilai determinan sebesar 5, maka determinan dari matriks hasil operasi $2A$ adalah...
            </p>
        </div>

        <!-- Pilihan Jawaban (Options) -->
        <div class="space-y-2.5">
            <!-- Pilihan A -->
            <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs shrink-0">A</div>
                    <span class="text-xs font-bold text-slate-800">10</span>
                </div>
            </div>

            <!-- Pilihan B (Selected / Active) -->
            <div class="bg-indigo-50/30 p-3.5 rounded-2xl border-2 border-indigo-600 shadow-sm flex items-center justify-between cursor-pointer relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-600"></div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-md shadow-indigo-200">B</div>
                    <span class="text-xs font-bold text-indigo-900">20</span>
                </div>
                <div class="w-6 h-6 rounded-full bg-indigo-600 text-white flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>

            <!-- Pilihan C -->
            <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs shrink-0">C</div>
                    <span class="text-xs font-bold text-slate-800">5</span>
                </div>
            </div>

            <!-- Pilihan D -->
            <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs shrink-0">D</div>
                    <span class="text-xs font-bold text-slate-800">15</span>
                </div>
            </div>

            <!-- Pilihan E -->
            <div class="bg-white p-3.5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between hover:border-indigo-200 transition-all cursor-pointer">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs shrink-0">E</div>
                    <span class="text-xs font-bold text-slate-800">25</span>
                </div>
            </div>
        </div>

        <!-- Navigasi Tombol (Kembali & Simpan/Lanjut) -->
        <div class="grid grid-cols-2 gap-3 pt-2">
            <button class="py-3.5 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-xs rounded-2xl shadow-sm transition-all text-center">
                Kembali
            </button>
            <button class="py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-1.5">
                <span>Simpan & Lanjut</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

        <!-- Navigasi Lembar Jawaban (Pagination Soal 1-10) -->
        <div class="bg-white p-4 rounded-3xl border border-slate-100 shadow-sm space-y-2.5">
            <h4 class="text-[10px] font-black uppercase tracking-wider text-slate-400">Navigasi Lembar Jawaban</h4>
            <div class="grid grid-cols-5 gap-2">
                <button class="py-2 bg-indigo-50 text-indigo-600 font-bold text-xs rounded-xl border border-indigo-100">1</button>
                <button class="py-2 bg-indigo-50 text-indigo-600 font-bold text-xs rounded-xl border border-indigo-100">2</button>
                <button class="py-2 bg-indigo-50 text-indigo-600 font-bold text-xs rounded-xl border border-indigo-100">3</button>
                <button class="py-2 bg-indigo-600 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-200">4</button>
                <button class="py-2 bg-slate-50 text-slate-400 font-bold text-xs rounded-xl border border-slate-100">5</button>
                <button class="py-2 bg-slate-50 text-slate-400 font-bold text-xs rounded-xl border border-slate-100">6</button>
                <button class="py-2 bg-slate-50 text-slate-400 font-bold text-xs rounded-xl border border-slate-100">7</button>
                <button class="py-2 bg-slate-50 text-slate-400 font-bold text-xs rounded-xl border border-slate-100">8</button>
                <button class="py-2 bg-slate-50 text-slate-400 font-bold text-xs rounded-xl border border-slate-100">9</button>
                <button class="py-2 bg-slate-50 text-slate-400 font-bold text-xs rounded-xl border border-slate-100">10</button>
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>