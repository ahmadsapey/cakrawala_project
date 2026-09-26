<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Belajar | Cakrawala Educentre</title>
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
<body class="min-h-screen bg-gradient-to-br from-indigo-50/60 via-slate-50 to-purple-50/50 pb-32 font-sans text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

    @include('components.hiderSiswa')

    <main class="mx-auto max-w-4xl space-y-8 px-4 py-8 sm:px-6 lg:px-12">
        
        <!-- HEADER HALAMAN -->
        <div class="bg-white/85 backdrop-blur-md p-6 sm:p-7 rounded-3xl border border-indigo-100 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-indigo-600 bg-indigo-50 border border-indigo-100 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Ruang Belajar</span>
                <h1 class="mt-3 text-2xl font-black tracking-tight text-slate-900">Materi Saya</h1>
                <p class="mt-1 text-xs sm:text-sm font-bold text-slate-500">Materi yang sudah diterbitkan oleh guru untuk kamu pelajari.</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-100 flex items-center justify-center shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        </div>

        <!-- SECTION: MATERI PEMBELAJARAN -->
        <section class="space-y-4">
            <div class="flex items-center justify-between px-1">
                <h2 class="text-xs font-black text-slate-500 uppercase tracking-wider">Materi Pembelajaran</h2>
                <span class="text-[11px] font-bold text-indigo-600 bg-indigo-50 border border-indigo-100 px-2.5 py-1 rounded-xl">{{ count($materials) }} Tersedia</span>
            </div>

            <div class="space-y-4">
                @forelse ($materials as $material)
                    <article class="rounded-3xl border border-indigo-100 bg-white/85 backdrop-blur-sm p-6 shadow-sm transition-all hover:border-indigo-300 hover:shadow-md flex flex-col justify-between space-y-4">
                        <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-start">
                            <div class="space-y-2">
                                <span class="rounded-xl bg-indigo-50 border border-indigo-200 px-3 py-1.5 text-xs font-black text-indigo-700 inline-block shadow-2xs">{{ $material->subject }}</span>
                                <h2 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">{{ $material->title }}</h2>
                                <p class="text-xs sm:text-sm leading-relaxed font-bold text-slate-600">{{ $material->summary ?: 'Tidak ada ringkasan materi.' }}</p>
                            </div>
                            <span class="shrink-0 text-xs font-black text-indigo-600 bg-indigo-50/50 px-3 py-1 rounded-xl border border-indigo-100">{{ $material->published_at?->format('d M Y') }}</span>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-indigo-50 pt-4 text-xs font-bold text-slate-500">
                            <span class="flex items-center space-x-1.5">
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                <span>Dibuat oleh {{ $material->teacher->user->name }}</span>
                            </span>
                            <div class="flex items-center space-x-3">
                                @if ($material->video_url)
                                    <a href="{{ $material->video_url }}" target="_blank" rel="noreferrer" class="inline-flex items-center space-x-1 px-3 py-1.5 rounded-xl bg-indigo-50 border border-indigo-200 text-indigo-600 hover:bg-indigo-100 transition-all font-black">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m10 8 6 4-6 4V8Z"/></svg>
                                        <span>Tonton Video</span>
                                    </a>
                                @endif 
                                @if ($material->attachment_path)
                                    <a href="{{ Storage::disk('public')->url($material->attachment_path) }}" target="_blank" rel="noreferrer" class="inline-flex items-center space-x-1 px-3 py-1.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-600 hover:bg-rose-100 transition-all font-black">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        <span>Unduh Modul</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-indigo-100 bg-white/85 backdrop-blur-sm px-6 py-12 text-center text-xs font-bold text-slate-500 shadow-sm">Belum ada materi yang diterbitkan.</div>
                @endforelse
            </div>
        </section>

        <!-- SECTION: TUGAS DARI GURU -->
        <section class="space-y-4">
            <h2 class="text-xs font-black text-slate-500 uppercase tracking-wider px-1">Tugas Dari Guru</h2>

            <div class="space-y-4">
                @forelse ($assignments as $assignment)
                    <article class="rounded-3xl border border-indigo-100 bg-white/85 backdrop-blur-sm p-6 shadow-sm transition-all hover:border-indigo-300 hover:shadow-md space-y-3">
                        <span class="rounded-xl bg-amber-50 border border-amber-200 px-3 py-1.5 text-xs font-black text-amber-700 inline-block shadow-2xs">{{ $assignment->classroom->name }}</span>
                        <h2 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">{{ $assignment->title }}</h2>
                        <p class="text-xs sm:text-sm leading-relaxed font-bold text-slate-600">{{ $assignment->instructions }}</p>
                        <div class="border-t border-indigo-50 pt-3 flex items-center justify-between text-xs font-bold text-slate-500">
                            <span>Nilai maksimal: <strong class="text-indigo-600 font-black">{{ $assignment->points }}</strong></span>
                            @if ($assignment->due_at)
                                <span class="text-rose-600 bg-rose-50 border border-rose-200 px-3 py-1 rounded-xl font-black">Tenggat: {{ $assignment->due_at->format('d M Y H:i') }}</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-indigo-100 bg-white/85 backdrop-blur-sm px-6 py-8 text-center text-xs font-bold text-slate-500 shadow-sm">Belum ada tugas yang diterbitkan.</div>
                @endforelse
            </div>
        </section>

    </main>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>