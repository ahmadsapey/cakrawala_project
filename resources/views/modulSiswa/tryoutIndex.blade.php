<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Tryout CBT & Ujian Simulasi | Cakrawala Educentre</title>
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

<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Banner Header Tryout CBT -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-6 sm:p-10 text-white shadow-xl">
            <div class="relative z-10 max-w-3xl space-y-3">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-indigo-200 backdrop-blur-md border border-white/10">
                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Portal Ujian CBT Online Berstandar Nasional
                </div>
                <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-white">
                    Simulasi Tryout CBT & Seleksi Masuk
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                    Uji pemahamanmu dengan sistem Computer Based Test berwaktu nyata. Dilengkapi penilaian otomatis, peringkat skor, serta pembahasan soal mendalam. Khusus disiapkan untuk program bimbingan dan event akbar mitra <strong class="text-amber-300 font-bold">MAN Insan Cendikia</strong>.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-4 text-xs font-bold text-slate-300">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>Timer Real-time</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>Auto-Grading & Pembahasan</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>Format Standar SNBT & MAN IC</span>
                    </div>
                </div>
            </div>
            <div class="absolute -right-10 -bottom-10 h-64 w-64 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
        </div>

        <!-- Kartu Statistik Siswa -->
        @php
            $completedCount = $submissions->where('status', 'completed')->count();
            $averageScore = $completedCount > 0 ? round($submissions->where('status', 'completed')->avg('score'), 1) : 0;
            $availableCount = $tryouts->count();
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border-2 border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-xl border border-indigo-100">
                    {{ $availableCount }}
                </div>
                <div>
                    <div class="text-xs font-bold text-slate-500">Tryout Tersedia</div>
                    <div class="text-base font-extrabold text-slate-900">Ujian Aktif</div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border-2 border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xl border border-emerald-100">
                    {{ $completedCount }}
                </div>
                <div>
                    <div class="text-xs font-bold text-slate-500">Telah Diselesaikan</div>
                    <div class="text-base font-extrabold text-slate-900">Simulasi Tuntas</div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border-2 border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-black text-xl border border-amber-100">
                    {{ $averageScore }}
                </div>
                <div>
                    <div class="text-xs font-bold text-slate-500">Rata-rata Skor</div>
                    <div class="text-base font-extrabold text-slate-900">Dari 100 Poin</div>
                </div>
            </div>
        </div>

        <!-- Daftar Tryout CBT -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <span>Pilihan Paket Tryout & Simulasi</span>
                </h2>
                <span class="text-xs font-semibold text-slate-500">Pilih ujian untuk mulai pengerjaan</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @forelse ($tryouts as $tryout)
                    @php
                        $sub = $submissions->get($tryout->id);
                        $isCompleted = $sub && $sub->status === 'completed';
                        $isManIc = str_contains(strtolower($tryout->title), 'man') || str_contains(strtolower($tryout->title), 'cendikia') || str_contains(strtolower($tryout->classroom?->name ?? ''), 'man');
                    @endphp
                    <div class="bg-white rounded-2xl border-2 {{ $isManIc ? 'border-amber-400 shadow-amber-100/50' : 'border-slate-200' }} p-6 flex flex-col justify-between hover:shadow-lg transition-all space-y-5">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2 flex-wrap">
                                    @if ($isManIc)
                                        <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-black border border-amber-300">
                                            EVENT MITRA MAN IC
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-black border border-indigo-200">
                                            SIMULASI CBT
                                        </span>
                                    @endif
                                    <span class="text-xs font-bold text-slate-500">{{ $tryout->classroom?->subject ?? 'Umum' }}</span>
                                </div>
                                @if ($isCompleted)
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-black">
                                        Skor: {{ $sub->score }} / 100
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 text-xs font-bold">
                                        Belum Dikerjakan
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-base sm:text-lg font-extrabold text-slate-900 leading-snug">
                                {{ $tryout->title }}
                            </h3>

                            <p class="text-xs text-slate-600 line-clamp-2">
                                {{ $tryout->classroom?->description ?? 'Simulasi ujian berbasis komputer dengan materi komprehensif dan pembahasan langsung setelah selesai.' }}
                            </p>

                            <!-- Meta info: Waktu, Soal, Passing Grade -->
                            <div class="grid grid-cols-3 gap-2 py-3 border-y border-slate-100 text-center">
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">Waktu</div>
                                    <div class="text-xs font-black text-slate-800 mt-0.5">{{ $tryout->duration_minutes }} Menit</div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">Jumlah Soal</div>
                                    <div class="text-xs font-black text-slate-800 mt-0.5">{{ $tryout->questions->count() ?: $tryout->question_count }} Soal</div>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">Passing Score</div>
                                    <div class="text-xs font-black text-slate-800 mt-0.5">{{ $tryout->passing_score }} Poin</div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="pt-2">
                            @if ($isCompleted)
                                <a href="{{ route('siswa.evaluasi', $sub) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-600/20 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Lihat Evaluasi & Pembahasan (Skor: {{ $sub->score }})</span>
                                </a>
                            @else
                                <a href="{{ route('siswa.pengerjaan', $tryout) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-600/20 transition-all">
                                    <span>Mulai Ujian CBT Sekarang</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 rounded-2xl border-2 border-dashed border-slate-300 bg-white p-12 text-center text-xs font-semibold text-slate-500">
                        Belum ada Tryout CBT yang dipublikasikan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Petunjuk Pengerjaan CBT -->
        <div class="bg-white rounded-2xl border-2 border-slate-200 p-6 space-y-4">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                <span>Panduan Pengerjaan Tryout CBT</span>
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-slate-600">
                <div class="p-3 bg-slate-50 rounded-xl space-y-1 border border-slate-200">
                    <span class="font-extrabold text-slate-900 block">1. Pastikan Koneksi Stabil</span>
                    <p>Waktu ujian akan tetap berjalan setelah Anda menekan tombol mulai hingga batas durasi tercapai.</p>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl space-y-1 border border-slate-200">
                    <span class="font-extrabold text-slate-900 block">2. Navigasi Soal Fleksibel</span>
                    <p>Anda dapat berpindah antar nomor dan memeriksa kembali jawaban sebelum menekan kirim ujian.</p>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl space-y-1 border border-slate-200">
                    <span class="font-extrabold text-slate-900 block">3. Evaluasi Instan</span>
                    <p>Setelah selesai, nilai akhir, persentase kebenaran, serta pembahasan detail tiap butir soal langsung tersedia.</p>
                </div>
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>

</html>
