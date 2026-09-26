<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $label }} | Cakrawala Maintenance</title>
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
        <header class="flex flex-col gap-5 rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 sm:p-8 shadow-sm">
            <div>
                <a href="{{ route('maintenance.landing.index') }}" class="inline-flex items-center gap-1.5 text-xs font-black text-indigo-600 hover:text-indigo-800 transition-colors">
                    <span aria-hidden="true">←</span> Kembali ke Menu Utama 5 Layer
                </a>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <span class="inline-block rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-black uppercase tracking-[0.18em] text-indigo-700 shadow-2xs">Editor Layer Landing</span>
                    <h1 class="mt-3 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">{{ $label }}</h1>
                    <p class="mt-1 text-xs sm:text-sm font-bold text-slate-600">Menampilkan daftar komponen khusus yang menyusun bagian ini di halaman depan.</p>
                </div>
                @if ($layer === 'hero')
                    <a href="{{ route('maintenance.landing.program.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-4 py-3 text-xs font-black text-white shadow-sm transition hover:bg-emerald-700">+ Tambah Program & Unggulan</a>
                @elseif ($layer === 'visual')
                    <a href="{{ route('maintenance.landing.program.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-4 py-3 text-xs font-black text-white shadow-sm transition hover:bg-emerald-700">+ Tambah Program & Modul</a>
                @elseif ($layer === 'package')
                    <a href="{{ route('maintenance.landing.package.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-4 py-3 text-xs font-black text-white shadow-sm transition hover:bg-emerald-700">+ Tambah Paket Layanan</a>
                @else
                    <div class="rounded-2xl border-2 border-indigo-200 bg-indigo-50 px-4 py-3 text-center text-xs font-black text-indigo-700 shrink-0">
                        Total: <span class="text-indigo-900">{{ $contents->count() }}</span> Konten Aktif/Tersimpan
                    </div>
                @endif
            </div>
        </header>

        @if (session('status'))
            <div class="rounded-2xl border-2 border-emerald-300 bg-emerald-50 px-5 py-4 text-xs sm:text-sm font-bold text-emerald-800 shadow-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- Grid Konten per Layer -->
        <section class="grid gap-5 md:grid-cols-2">
            @forelse ($contents as $content)
                @php($isSectionHeader = $content->type === 'section')
                @php($isHeroHeader = $content->type === 'hero')
                @php($isCta = $content->type === 'cta')
                @php($isFooter = $content->type === 'footer')
                <article class="group rounded-3xl border-2 {{ $isSectionHeader ? 'border-emerald-200 bg-emerald-50/70 hover:border-emerald-400' : ($isHeroHeader ? 'border-sky-200 bg-sky-50/70 hover:border-sky-400' : ($isCta ? 'border-violet-200 bg-violet-50/70 hover:border-violet-400' : ($isFooter ? 'border-slate-300 bg-slate-100/80 hover:border-slate-400' : 'border-indigo-200 bg-white/90 hover:border-indigo-400'))) }} backdrop-blur-md p-6 shadow-sm transition-all hover:shadow-md {{ $isSectionHeader || $isHeroHeader || $isCta || $isFooter ? 'md:col-span-2' : '' }} flex flex-col justify-between">
                    <div>
                        @if ($content->image_url)
                            <div class="mb-5 overflow-hidden rounded-2xl border-2 border-indigo-100 bg-slate-100">
                                <img src="{{ $content->image_url }}" alt="{{ $content->title }}" class="h-44 w-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>
                        @endif
                        
                        <!-- Badge Atribut -->
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <span class="rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1 text-[11px] font-black uppercase tracking-wider text-indigo-700 shadow-2xs">Urutan #{{ $content->sort_order }}</span>
                                <span class="rounded-xl border px-2.5 py-1 text-[10px] font-black uppercase tracking-wider {{ $isSectionHeader ? 'border-emerald-200 bg-white text-emerald-700' : ($isHeroHeader ? 'border-sky-200 bg-white text-sky-700' : ($isCta ? 'border-violet-200 bg-white text-violet-700' : ($isFooter ? 'border-slate-300 bg-white text-slate-700' : 'border-slate-200 bg-slate-100 text-slate-600'))) }}">{{ $isSectionHeader ? 'Header Online Schedule' : ($isHeroHeader ? 'Hero Utama' : ($isCta ? 'CTA Prestasi' : ($isFooter ? 'Footer' : ($content->type === 'program' ? 'Program & Modul' : 'Paket Layanan')))) }}</span>
                            </div>
                            <span class="rounded-xl border px-3 py-1 text-[11px] font-black {{ $content->is_active ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-rose-200 bg-rose-50 text-rose-700' }}">
                                {{ $content->is_active ? '● Tampil di Web' : '○ Disembunyikan' }}
                            </span>
                        </div>

                        <!-- Judul & Deskripsi -->
                        <h2 class="mt-4 text-base sm:text-lg font-black text-slate-900 tracking-tight">{{ $content->title ?: 'Konten Tanpa Judul' }}</h2>
                        <p class="mt-2 min-h-[48px] text-xs sm:text-sm font-bold leading-relaxed text-slate-500">{{ $content->description ?: 'Belum ada deskripsi singkat untuk konten ini.' }}</p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-6 flex items-center gap-3 border-t-2 border-indigo-50 pt-4">
                        @if (! $isSectionHeader && ! $isHeroHeader && ! $isCta && ! $isFooter)
                            <form method="POST" action="{{ route('maintenance.landing.destroy', $content) }}" onsubmit="return confirm('Hapus konten ini dari landing page?')" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full rounded-2xl border-2 border-rose-200 bg-rose-50 px-4 py-2.5 text-center text-xs font-black text-rose-700 transition-all hover:bg-rose-100">Hapus</button>
                            </form>
                        @endif
                        <a href="{{ route('maintenance.landing.edit', $content) }}" 
                           class="{{ $isSectionHeader || $isHeroHeader || $isCta || $isFooter ? 'w-full' : 'flex-1' }} rounded-2xl border-2 border-indigo-600 bg-indigo-600 px-4 py-2.5 text-center text-xs font-black text-white hover:bg-indigo-700 hover:border-indigo-700 transition-all shadow-sm">
                            Edit Konten
                        </a>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border-2 border-dashed border-indigo-300 bg-white/80 px-6 py-16 text-center md:col-span-2 shadow-2xs">
                    <span class="flex h-12 w-12 mx-auto items-center justify-center rounded-2xl border-2 border-indigo-200 bg-indigo-50 text-lg font-black text-indigo-600 mb-3">!</span>
                    <p class="text-sm font-black text-slate-800">Belum ada konten yang terdaftar pada layer ini.</p>
                    <p class="mt-1 text-xs font-bold text-slate-500">Silakan tambahkan data atau hubungkan melalui database jika diperlukan.</p>
                </div>
            @endforelse
        </section>

    </main>

</body>
</html>