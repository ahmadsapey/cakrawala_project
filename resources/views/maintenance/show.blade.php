<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $content->title }} | Cakrawala Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50/50 via-slate-50 to-blue-50/40 font-sans text-slate-800 antialiased">
    <header class="border-b border-slate-200/80 bg-white/90 backdrop-blur-md">
        <div class="mx-auto flex min-h-20 max-w-4xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
            <a href="{{ route('maintenance.landing.section', $content->type) }}" class="text-sm font-black text-slate-900">← Kembali ke bagian</a>
            <a href="{{ route('maintenance.landing.edit', $content) }}" class="rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-black text-white hover:bg-indigo-700">Edit konten</a>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <article class="rounded-3xl border-2 border-indigo-100 bg-white/90 p-6 shadow-sm sm:p-8">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <span class="rounded-lg bg-indigo-50 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-indigo-700">{{ $content->type }}</span>
                <span class="rounded-lg px-2.5 py-1 text-[10px] font-black {{ $content->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">{{ $content->is_active ? 'Tampil di landing' : 'Disembunyikan' }}</span>
            </div>
            <p class="mt-6 text-xs font-black uppercase tracking-[0.16em] text-slate-400">{{ $content->badge }}</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">{{ $content->title }}</h1>
            <p class="mt-4 whitespace-pre-line text-base leading-relaxed text-slate-600">{{ $content->description ?: 'Tidak ada deskripsi.' }}</p>

            <dl class="mt-8 grid gap-4 border-t border-slate-100 pt-6 sm:grid-cols-2">
                <div><dt class="text-xs font-black uppercase tracking-wider text-slate-400">Meta</dt><dd class="mt-1 font-semibold text-slate-800">{{ $content->meta ?: '-' }}</dd></div>
                <div><dt class="text-xs font-black uppercase tracking-wider text-slate-400">Gambar URL</dt><dd class="mt-1 break-all font-semibold text-slate-800">{{ $content->image_url ?: '-' }}</dd></div>
                <div><dt class="text-xs font-black uppercase tracking-wider text-slate-400">Harga</dt><dd class="mt-1 font-semibold text-slate-800">{{ $content->price ?: '-' }}{{ $content->price_suffix }}</dd></div>
                <div><dt class="text-xs font-black uppercase tracking-wider text-slate-400">Label tombol</dt><dd class="mt-1 font-semibold text-slate-800">{{ $content->cta_label ?: '-' }}</dd></div>
                <div><dt class="text-xs font-black uppercase tracking-wider text-slate-400">Urutan</dt><dd class="mt-1 font-semibold text-slate-800">{{ $content->sort_order }}</dd></div>
                <div><dt class="text-xs font-black uppercase tracking-wider text-slate-400">Unggulan</dt><dd class="mt-1 font-semibold text-slate-800">{{ $content->is_featured ? 'Ya' : 'Tidak' }}</dd></div>
            </dl>

            @if (is_array($content->features) && count($content->features))
                <div class="mt-8 border-t border-slate-100 pt-6">
                    <h2 class="text-sm font-black text-slate-900">Fitur</h2>
                    <ul class="mt-3 list-disc space-y-2 pl-5 text-sm font-semibold text-slate-600">
                        @foreach ($content->features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </article>
    </main>
</body>
</html>
