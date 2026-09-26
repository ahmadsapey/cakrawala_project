<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $label }} | Cakrawala Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('components.fonts')
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50/50 via-slate-50 to-blue-50/40 font-sans text-slate-800 antialiased">
    <header class="border-b border-slate-200/80 bg-white/90 backdrop-blur-md">
        <div class="mx-auto flex min-h-20 max-w-6xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-12">
            <a href="{{ route('maintenance.landing.index') }}" class="text-sm font-black text-slate-900">Cakrawala Maintenance</a>
            <a href="{{ route('maintenance.landing.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black text-slate-600 hover:bg-slate-50">Kembali ke dashboard</a>
        </div>
    </header>

    <main class="mx-auto flex w-full max-w-6xl flex-col gap-6 px-4 py-8 sm:px-6 lg:px-12">
        <header class="rounded-3xl border-2 border-indigo-200 bg-white/90 p-6 shadow-sm sm:p-8">
            <p class="text-[11px] font-black uppercase tracking-[0.16em] text-indigo-600">Kelola bagian landing</p>
            <div class="mt-2 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">{{ $label }}</h1>
                    <p class="mt-1 text-sm font-semibold text-slate-500">Pilih konten untuk melihat detail atau mengeditnya.</p>
                </div>
                <span class="rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-black text-indigo-700">{{ $contents->count() }} konten</span>
            </div>
        </header>

        <section class="grid gap-4 md:grid-cols-2">
            @forelse ($contents as $content)
                <article class="rounded-3xl border-2 border-indigo-100 bg-white/90 p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-slate-500">Urutan {{ $content->sort_order }}</span>
                        <span class="rounded-lg px-2.5 py-1 text-[10px] font-black {{ $content->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">{{ $content->is_active ? 'Tampil' : 'Disembunyikan' }}</span>
                    </div>
                    <h2 class="mt-5 text-lg font-black text-slate-900">{{ $content->title ?: 'Konten tanpa judul' }}</h2>
                    <p class="mt-2 min-h-12 text-sm leading-relaxed text-slate-500">{{ $content->description ?: 'Belum ada deskripsi.' }}</p>
                    <div class="mt-5 flex gap-2 border-t border-slate-100 pt-4">
                        <a href="{{ route('maintenance.landing.show', $content) }}" class="flex-1 rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-2.5 text-center text-xs font-black text-indigo-700 hover:bg-indigo-100">Lihat detail</a>
                        <a href="{{ route('maintenance.landing.edit', $content) }}" class="flex-1 rounded-xl bg-indigo-600 px-3 py-2.5 text-center text-xs font-black text-white hover:bg-indigo-700">Edit konten</a>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border-2 border-dashed border-indigo-200 bg-white/80 px-6 py-12 text-center md:col-span-2">
                    <p class="font-black text-slate-800">Belum ada konten pada bagian ini.</p>
                </div>
            @endforelse
        </section>
    </main>
</body>
</html>
