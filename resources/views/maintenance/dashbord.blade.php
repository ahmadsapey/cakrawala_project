<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Landing Page | Cakrawala Educentre</title>
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

<body class="min-h-screen bg-gradient-to-br from-indigo-50/50 via-slate-50 to-blue-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">
    
    <!-- Header Maintenance / Content Manager -->
    <header class="border-b-2 border-indigo-200 bg-white/90 backdrop-blur-md sticky top-0 z-40">
        <div class="mx-auto flex min-h-20 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-12">
            <a href="{{ route('maintenance.landing.index') }}" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl border-2 border-indigo-200 bg-indigo-50 text-base font-black text-indigo-700 shadow-2xs">C</span>
                <span>
                    <span class="block text-sm font-black tracking-tight text-slate-900">Cakrawala Maintenance</span>
                    <span class="block text-[10px] font-black uppercase tracking-[0.16em] text-slate-400">Landing Content Manager</span>
                </span>
            </a>
            <a href="{{ route('landing.page') }}" target="_blank" rel="noopener" 
                class="rounded-2xl border-2 border-indigo-200 bg-indigo-50 px-4 py-2.5 text-xs font-black text-indigo-700 hover:bg-indigo-100 transition-all inline-flex items-center gap-1.5 shadow-2xs">
                Buka Website <span>↗</span>
            </a>
        </div>
    </header>

    <main class="mx-auto flex w-full max-w-7xl flex-col gap-6 px-4 py-8 sm:px-6 lg:px-12">
        
        <!-- Header Halaman -->
        <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 sm:p-8 shadow-sm">
            <div>
                <span class="inline-block rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-black uppercase tracking-[0.18em] text-indigo-700 shadow-2xs">Konten Website</span>
                <h1 class="mt-3 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Kelola Landing Page</h1>
                <p class="mt-1 text-xs sm:text-sm font-bold text-slate-600">Edit semua teks, kartu program, paket, harga, gambar, dan CTA yang tampil di halaman depan.</p>
            </div>
            <a href="{{ route('landing.page') }}" target="_blank" rel="noopener" 
                class="rounded-2xl border-2 border-indigo-200 bg-indigo-50 px-5 py-3 text-center text-xs font-black text-indigo-700 hover:bg-indigo-100 transition-all inline-flex items-center justify-center gap-2 shrink-0">
                Lihat Landing Page <span aria-hidden="true">↗</span>
            </a>
        </header>

        @if (session('status'))
            <div class="rounded-2xl border-2 border-emerald-300 bg-emerald-50 px-5 py-4 text-xs sm:text-sm font-bold text-emerald-800 shadow-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl border-2 border-rose-300 bg-rose-50 px-5 py-4 text-xs sm:text-sm font-bold text-rose-800 shadow-sm">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $layers = [
                'hero' => ['label' => 'Layer 1 · Hero + Program & Modul', 'description' => 'Pilihan belajar utama dan kartu program yang tampil di hero.'],
                'package' => ['label' => 'Layer 2 · Online Schedule + Paket', 'description' => 'Judul schedule, harga, fitur, dan paket belajar.'],
                'visual' => ['label' => 'Layer 3 · Colossal Gambar', 'description' => 'Kumpulan gambar besar yang bergulir otomatis.'],
                'cta' => ['label' => 'Layer 4 · CTA Prestasi', 'description' => 'Ajakan terakhir untuk menaikkan prestasi.'],
                'footer' => ['label' => 'Layer 5 · Footer', 'description' => 'Identitas dan kontak utama pada bagian paling bawah.'],
            ];
            $groupedContents = $contents->groupBy('type');
        @endphp

        @if ($brandContent)
            <section>
                <a href="{{ route('maintenance.landing.edit', $brandContent) }}" class="group flex flex-col gap-4 rounded-3xl border-2 border-amber-200 bg-amber-50/70 p-5 shadow-sm transition-all hover:-translate-y-1 hover:border-amber-400 hover:shadow-md sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border-2 border-amber-200 bg-white p-2">
                            <img src="{{ $brandContent->image_url }}" alt="Logo {{ $brandContent->title }}" class="max-h-full max-w-full object-contain">
                        </div>
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-[0.16em] text-amber-700">Identitas global</p>
                            <h2 class="mt-1 text-base font-black text-slate-900">{{ $brandContent->title }}</h2>
                            <p class="mt-1 text-xs font-semibold text-slate-600">Logo dan nama ini dipakai di semua modul.</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-2 rounded-xl bg-amber-600 px-4 py-2.5 text-xs font-black text-white transition group-hover:bg-amber-700">Edit logo & nama <span aria-hidden="true">→</span></span>
                </a>
            </section>
        @endif

        <!-- Grid Layer Landing -->
        <section class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($layers as $layer => $layerInfo)
                @php
                    $group = match ($layer) {
                        'hero' => $contents->filter(fn ($content) => in_array($content->type, ['hero', 'program'], true)),
                        'package' => $contents->filter(fn ($content) => ($content->type === 'package') || ($content->type === 'section' && $content->sort_order === 1)),
                        'visual' => $contents->filter(fn ($content) => $content->type === 'program' && filled($content->image_url)),
                        default => $groupedContents->get($layer, collect()),
                    };
                    $firstContent = $group->first();
                @endphp
                <a href="{{ route('maintenance.landing.layer', $layer) }}" 
                    class="group rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 shadow-sm transition-all hover:-translate-y-1 hover:border-indigo-400 hover:shadow-md flex flex-col justify-between">
                    <div>
                        <div class="flex items-start justify-between gap-4">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl border border-indigo-200 bg-indigo-50 text-xs font-black text-indigo-700 shadow-2xs">{{ $loop->iteration }}</span>
                            <span class="rounded-xl border border-indigo-100 bg-indigo-50/50 px-3 py-1 text-[11px] font-black text-indigo-700">{{ $group->count() }} konten</span>
                        </div>
                        <h2 class="mt-5 text-base font-black text-slate-900 tracking-tight">{{ $layerInfo['label'] }}</h2>
                        <p class="mt-1 min-h-[40px] text-xs font-bold leading-relaxed text-slate-500">{{ $layerInfo['description'] }}</p>
                    </div>
                    <div class="mt-5 flex items-center justify-between border-t-2 border-indigo-50 pt-4 text-xs font-black">
                        <span class="max-w-[80%] truncate text-slate-700 font-bold">{{ $firstContent?->title ?? 'Belum ada konten' }}</span>
                        <span class="text-indigo-600 transition group-hover:translate-x-1" aria-hidden="true">→</span>
                    </div>
                </a>
            @endforeach
        </section>

    </main>

</body>

</html>