<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Layanan | Cakrawala Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50/50 via-slate-50 to-blue-50/40 font-sans text-slate-800 antialiased">
    <header class="border-b border-slate-200/80 bg-white/90 backdrop-blur-md">
        <div class="mx-auto flex min-h-20 max-w-4xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
            <a href="{{ route('maintenance.landing.layer', 'package') }}" class="text-sm font-black text-slate-900">← Kembali ke Paket Layanan</a>
            <span class="text-xs font-black uppercase tracking-[0.16em] text-slate-400">Cakrawala Maintenance</span>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="mb-6 rounded-3xl border-2 border-emerald-200 bg-emerald-50/70 p-6 shadow-sm sm:p-8">
            <p class="text-[11px] font-black uppercase tracking-[0.16em] text-emerald-700">Layer 2 · Online Schedule + Paket</p>
            <h1 class="mt-2 text-2xl font-black tracking-tight text-slate-900">Tambah Paket Layanan</h1>
            <p class="mt-1 text-sm font-semibold text-slate-600">Paket baru akan langsung muncul pada kartu layanan di landing page.</p>
        </header>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border-2 border-rose-300 bg-rose-50 px-5 py-4 text-sm font-bold text-rose-800">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('maintenance.landing.package.store') }}" class="rounded-3xl border-2 border-indigo-100 bg-white/90 p-6 shadow-sm sm:p-8">
            @csrf
            <input type="hidden" name="type" value="package">
            <input type="hidden" name="is_active" value="1">
            <input type="hidden" name="is_featured" value="0">

            <div class="grid gap-4 md:grid-cols-2">
                <label class="space-y-1.5 text-xs font-black text-slate-700">Badge
                    <input name="badge" value="{{ old('badge') }}" maxlength="80" placeholder="PAKET BELAJAR" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </label>
                <label class="space-y-1.5 text-xs font-black text-slate-700">Urutan tampil
                    <input type="number" name="sort_order" value="{{ old('sort_order', 1) }}" min="0" max="999" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </label>
                <label class="space-y-1.5 text-xs font-black text-slate-700 md:col-span-2">Nama paket
                    <input name="title" value="{{ old('title') }}" required maxlength="150" placeholder="Paket Belajar" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </label>
                <label class="space-y-1.5 text-xs font-black text-slate-700 md:col-span-2">Deskripsi
                    <textarea name="description" rows="4" maxlength="500" placeholder="Jelaskan isi paket secara singkat." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">{{ old('description') }}</textarea>
                </label>
                <label class="space-y-1.5 text-xs font-black text-slate-700">Harga
                    <input name="price" value="{{ old('price') }}" maxlength="80" placeholder="Rp 149.000" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </label>
                <label class="space-y-1.5 text-xs font-black text-slate-700">Satuan harga
                    <input name="price_suffix" value="{{ old('price_suffix') }}" maxlength="30" placeholder="/bln" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </label>
                <label class="space-y-1.5 text-xs font-black text-slate-700 md:col-span-2">Fitur paket, satu fitur per baris
                    <textarea name="features" rows="5" maxlength="500" placeholder="Materi sesuai kurikulum&#10;E-learning 24/7 jam" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">{{ old('features') }}</textarea>
                </label>
                <label class="space-y-1.5 text-xs font-black text-slate-700">Label tombol
                    <input name="cta_label" value="{{ old('cta_label') }}" maxlength="80" placeholder="Pilih paket" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 font-semibold outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </label>
            </div>

            <button type="submit" class="mt-6 w-full rounded-xl bg-emerald-600 px-4 py-3 text-sm font-black text-white transition hover:bg-emerald-700">Simpan Paket Layanan</button>
        </form>
    </main>
</body>
</html>
