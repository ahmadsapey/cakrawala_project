<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $classroom->name }} | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Kelas pembelajaran</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">{{ $classroom->name }}</h1>
                <p class="mt-1.5 text-xs sm:text-sm font-semibold text-slate-600">{{ $classroom->subject }} · {{ $classroom->grade_level }}{{ $classroom->section ? ' · '.$classroom->section : '' }}</p>
            </div>
            <a href="{{ route('guru.kelas') }}" class="rounded-xl border-2 border-slate-300 bg-white px-4 py-2.5 text-center text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">Kembali ke Daftar Kelas</a>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <a href="{{ route('guru.material.create', ['classroom_id' => $classroom->id]) }}" class="rounded-2xl border-2 border-indigo-700 bg-indigo-600 p-5 text-white shadow-md hover:bg-indigo-700 transition-all">
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-200">Konten kelas</p>
                <p class="mt-1 text-base font-extrabold">+ Tambah Materi & Bahan Ajar</p>
            </a>
            <a href="{{ route('guru.tugas.create', ['classroom_id' => $classroom->id]) }}" class="rounded-2xl border-2 border-slate-300 bg-white p-5 text-slate-900 shadow-sm hover:border-indigo-600 transition-all">
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Evaluasi kelas</p>
                <p class="mt-1 text-base font-extrabold">+ Buat Tugas Baru</p>
            </a>
            <a href="{{ route('guru.kuis.create', ['classroom_id' => $classroom->id]) }}" class="rounded-2xl border-2 border-slate-300 bg-white p-5 text-slate-900 shadow-sm hover:border-indigo-600 transition-all">
                <p class="text-xs font-extrabold uppercase tracking-wider text-amber-700">Evaluasi kelas</p>
                <p class="mt-1 text-base font-extrabold">+ Buat Kuis Baru</p>
            </a>
        </div>

        <section class="space-y-4">
            <h2 class="text-base sm:text-lg font-extrabold text-slate-900">Materi dan Video Pembelajaran</h2>
            <div class="grid gap-4 md:grid-cols-2">
                @forelse ($materials as $material)
                    <article class="rounded-2xl border-2 border-slate-300 bg-white p-6 shadow-sm space-y-4 hover:border-indigo-600 transition-all">
                        <div class="flex justify-between items-start gap-3">
                            <div>
                                <span class="rounded-lg bg-indigo-100 border border-indigo-300 px-3 py-1 text-xs font-extrabold uppercase tracking-wider text-indigo-800">{{ $material->subject }}</span>
                                <h3 class="mt-3 text-base sm:text-lg font-extrabold text-slate-900">{{ $material->title }}</h3>
                                <p class="mt-1.5 text-xs sm:text-sm font-medium leading-relaxed text-slate-600">{{ $material->summary ?: 'Tidak ada ringkasan materi.' }}</p>
                            </div>
                            <span class="shrink-0 text-xs font-bold text-slate-500 bg-slate-100 border border-slate-300 px-2.5 py-1 rounded-lg">{{ $material->published_at?->format('d M Y') }}</span>
                        </div>
                        <div class="flex gap-3 border-t-2 border-slate-200 pt-4 text-xs font-extrabold">
                            @if ($material->video_url)
                                <a href="{{ $material->video_url }}" target="_blank" class="text-indigo-600 hover:underline">📺 Tonton Video</a>
                            @endif 
                            @if ($material->attachment_path)
                                <a href="{{ Storage::disk('public')->url($material->attachment_path) }}" target="_blank" class="text-rose-600 hover:underline">📄 Buka Modul (PDF/PPT)</a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-white p-12 text-center text-xs font-semibold text-slate-500 md:col-span-2">Belum ada materi di kelas ini. Klik tombol di atas untuk menerbitkan materi.</div>
                @endforelse
            </div>
        </section>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>
