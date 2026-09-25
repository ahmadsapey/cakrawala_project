<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $classroom->name }} | Cakrawala Educentre</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0D9488',
                        branddark: '#0F172A',
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-br from-teal-50/50 via-slate-50 to-emerald-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-teal-500 selection:text-white">
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        
        <!-- Header Halaman -->
        <div class="sticky top-16 z-40 flex flex-col justify-between gap-4 rounded-3xl border border-teal-100 bg-white/95 p-6 shadow-md shadow-slate-200/60 backdrop-blur-md sm:flex-row sm:items-end sm:p-7">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-teal-700 bg-teal-50 border border-teal-100 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Kelas Pembelajaran</span>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">
                    {{ $classroom->name }}
                </h1>
                <p class="mt-1.5 text-xs sm:text-sm font-bold text-slate-500">
                    {{ $classroom->subject }} · {{ $classroom->grade_level }}{{ $classroom->section ? ' · ' . $classroom->section : '' }}
                </p>
            </div>
            <a href="{{ route('guru.kelas') }}" class="rounded-2xl border border-teal-200 bg-white px-4 py-3 text-center text-xs font-black text-teal-800 hover:bg-teal-50 transition-all shadow-2xs shrink-0">
                &larr; Kembali ke Daftar Kelas
            </a>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-xs font-bold text-emerald-800 shadow-xs">
                {{ session('success') }}
            </div>
        @endif

        <!-- Kartu Aksi Cepat (Quick Actions) -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <a href="{{ route('guru.material.create', ['classroom_id' => $classroom->id]) }}" class="rounded-3xl border border-teal-600 bg-gradient-to-r from-teal-600 to-emerald-700 p-6 text-white shadow-lg shadow-teal-200 hover:from-teal-700 hover:to-emerald-800 transition-all group">
                <p class="text-xs font-black uppercase tracking-wider text-teal-100">Konten Kelas</p>
                <p class="mt-2 text-base font-black flex items-center gap-2">
                    <span class="text-lg">+</span> Tambah Materi & Bahan Ajar
                </p>
            </a>
            <a href="{{ route('guru.kelas.absensi', $classroom) }}" class="rounded-3xl border border-teal-100 bg-white/85 backdrop-blur-md p-6 text-slate-900 shadow-xs hover:border-teal-600 hover:shadow-md transition-all group">
                <p class="text-xs font-black uppercase tracking-wider text-emerald-700">Kehadiran Siswa</p>
                <p class="mt-2 text-base font-black flex items-center gap-2 group-hover:text-teal-700 transition-colors">
                    <span class="text-lg">📋</span> Kelola Absensi Kelas
                </p>
            </a>
        </div>

        <!-- Section: Materi dan Video Pembelajaran -->
        <section class="space-y-4 pt-2">
            <h2 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Materi dan Video Pembelajaran</h2>
            <div class="grid gap-4 md:grid-cols-2">
                @forelse ($materials as $material)
                    <article class="rounded-3xl border border-teal-100 bg-white/85 backdrop-blur-md p-6 shadow-xs space-y-4 hover:border-teal-600 hover:shadow-md transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-3">
                                <div>
                                    <span class="rounded-xl bg-teal-50 border border-teal-200 px-3 py-1 text-xs font-black uppercase tracking-wider text-teal-800 shadow-2xs">{{ $material->subject }}</span>
                                    <h3 class="mt-3 text-base sm:text-lg font-black text-slate-900">{{ $material->title }}</h3>
                                    <p class="mt-2 text-xs sm:text-sm font-semibold leading-relaxed text-slate-500">
                                        {{ $material->summary ?: 'Tidak ada ringkasan materi.' }}
                                    </p>
                                </div>
                                <span class="shrink-0 text-xs font-bold text-slate-600 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-xl shadow-2xs">{{ $material->published_at?->format('d M Y') }}</span>
                            </div>

                            <!-- Link Akses Media -->
                            <div class="flex flex-wrap gap-3 mt-4 text-xs font-black">
                                @if ($material->video_url)
                                    <a href="{{ $material->video_url }}" target="_blank" class="text-teal-700 hover:underline flex items-center gap-1.5">
                                        📺 Tonton Video
                                    </a>
                                @endif
                                @if ($material->attachment_path)
                                    <a href="{{ Storage::disk('public')->url($material->attachment_path) }}" target="_blank" class="text-rose-600 hover:underline flex items-center gap-1.5">
                                        📄 Buka Modul (PDF/PPT)
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Tombol Edit & Hapus Materi -->
                        <div class="flex items-center gap-2 border-t border-slate-200 pt-4">
                            <a href="{{ route('guru.material.edit', $material) }}" class="flex-1 rounded-2xl border border-teal-200 bg-teal-50 px-3 py-2.5 text-center text-xs font-black text-teal-800 transition-all hover:bg-teal-100 shadow-2xs">
                                Edit Materi
                            </a>
                            <form method="POST" action="{{ route('guru.material.destroy', $material) }}" class="flex-1" onsubmit="return confirm('Hapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full rounded-2xl border border-rose-200 bg-rose-50 px-3 py-2.5 text-xs font-black text-rose-700 transition-all hover:bg-rose-100 shadow-2xs">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-white/80 p-12 text-center text-xs font-bold text-slate-400 md:col-span-2 shadow-2xs">
                        Belum ada materi di kelas ini. Klik tombol di atas untuk menerbitkan materi.
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>

</html>