<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $classroom->name }} | Cakrawala</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-sky-50 to-purple-50 pb-28 font-sans text-slate-800 antialiased">
@include('components.hiderSiswa')

<main class="mx-auto max-w-4xl space-y-8 px-4 py-8 sm:px-6 lg:px-12">
    <!-- Header Kelas dengan Gradien Warna -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 p-8 text-white shadow-lg">
        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/15 blur-2xl"></div>
        <div class="relative z-10">
            <span class="inline-block rounded-full bg-white/20 px-3.5 py-1 text-xs font-bold uppercase tracking-widest backdrop-blur-md">Ruang Kelas</span>
            <h1 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">{{ $classroom->name }}</h1>
            <p class="mt-2 text-sm font-medium text-indigo-100 flex flex-wrap items-center gap-2">
                <span class="bg-indigo-700/50 px-2.5 py-1 rounded-lg">{{ $classroom->subject }}</span>
                <span>·</span>
                <span class="bg-purple-700/50 px-2.5 py-1 rounded-lg">{{ $classroom->grade_level }}</span>
                <span>·</span>
                <span class="text-pink-100">Guru: {{ $classroom->teacher?->user?->name ?? 'Guru' }}</span>
            </p>
        </div>
    </div>

    @if ($classroom->online_meeting_url)
        <!-- Live Online Meeting Banner -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 rounded-3xl border border-indigo-200 bg-gradient-to-r from-indigo-500 to-purple-600 p-6 text-white shadow-md">
            <div>
                <span class="inline-block rounded-full bg-white/20 px-3 py-1 text-xs font-bold uppercase tracking-wider backdrop-blur-md">Live Meeting</span>
                <h2 class="mt-2 text-xl font-black">Sesi Pembelajaran Online</h2>
                <p class="mt-1 text-xs text-indigo-100">Klik tombol di samping untuk bergabung ke tatap muka virtual kelas ini.</p>
            </div>
            <a href="{{ $classroom->online_meeting_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-xs font-black text-indigo-600 shadow-md hover:bg-indigo-50 transition-all shrink-0">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                Gabung Sesi Online
            </a>
        </div>
    @endif

    <!-- Bagian Materi Pembelajaran -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-black text-slate-900 flex items-center gap-2">
                <span class="inline-block h-3 w-3 rounded-full bg-indigo-500"></span> Materi Pembelajaran
            </h2>
        </div>
        
        @forelse ($materials as $material)
            <article class="group rounded-3xl border border-indigo-100 bg-white/80 p-6 shadow-sm backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:border-indigo-300 hover:shadow-md">
                <span class="inline-block rounded-xl bg-gradient-to-r from-indigo-500 to-violet-500 px-3.5 py-1.5 text-xs font-bold text-white shadow-sm">{{ $material->subject }}</span>
                <h3 class="mt-3 text-xl font-black text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $material->title }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $material->summary ?: 'Tidak ada ringkasan materi.' }}</p>
                <div class="mt-5 flex flex-wrap gap-3 border-t border-slate-100 pt-4 text-xs font-bold">
                    @if ($material->video_url)
                        <a href="{{ $material->video_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 rounded-xl bg-indigo-50 px-4 py-2 text-indigo-600 transition-colors hover:bg-indigo-600 hover:text-white">
                            Tonton Video
                        </a>
                    @endif 
                    @if ($material->attachment_path)
                        <a href="{{ Storage::disk('public')->url($material->attachment_path) }}" target="_blank" class="inline-flex items-center gap-1.5 rounded-xl bg-rose-50 px-4 py-2 text-rose-600 transition-colors hover:bg-rose-600 hover:text-white">
                            Unduh Modul (PDF)
                        </a>
                    @endif
                </div>
            </article>
        @empty
            <div class="rounded-3xl border border-dashed border-indigo-200 bg-white/50 p-10 text-center text-sm text-slate-400 backdrop-blur-sm">
                Belum ada materi di kelas ini.
            </div>
        @endforelse
    </section>

    <!-- Bagian Tugas -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-black text-slate-900 flex items-center gap-2">
                <span class="inline-block h-3 w-3 rounded-full bg-amber-500"></span> Tugas
            </h2>
        </div>

        @forelse ($assignments as $assignment)
            <article class="group rounded-3xl border border-amber-100 bg-white/80 p-6 shadow-sm backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:border-amber-300 hover:shadow-md">
                <span class="inline-block rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 px-3.5 py-1.5 text-xs font-bold text-white shadow-sm">Tugas</span>
                <h3 class="mt-3 text-xl font-black text-slate-900 group-hover:text-amber-600 transition-colors">{{ $assignment->title }}</h3>
                <p class="mt-2 text-sm text-slate-600">{{ $assignment->instructions }}</p>
                <div class="mt-4 flex flex-wrap items-center gap-3 text-xs font-semibold text-slate-500">
                    <span class="rounded-lg bg-amber-50 px-2.5 py-1 text-amber-700 font-bold">Nilai maks: {{ $assignment->points }}</span>
                    @if ($assignment->due_at)
                        <span class="rounded-lg bg-slate-100 px-2.5 py-1">Tenggat: {{ $assignment->due_at->format('d M Y H:i') }}</span>
                    @endif
                </div>
            </article>
        @empty
            <p class="text-sm text-slate-400">Belum ada tugas yang diterbitkan.</p>
        @endforelse 
    </section>
</main>

@include('components.footerSiswa')
@include('components.footerMobile_siswa')
</body>
</html>