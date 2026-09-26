<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Landing Page | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('components.fonts')
</head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
@include('components.headerAdmin')
<main class="mx-auto max-w-6xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
    <div class="flex flex-col justify-between gap-4 rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm sm:flex-row sm:items-end sm:p-8">
        <div>
            <p class="text-xs font-black uppercase tracking-wider text-indigo-700">Modul Admin</p>
            <h1 class="mt-2 text-2xl font-black text-slate-900">Kelola Landing Page</h1>
            <p class="mt-1 text-sm font-semibold text-slate-500">Kelola konten penawaran program dan paket bimbel yang tampil di beranda.</p>
        </div>
    </div>

    @if (session('status'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-800">{{ session('status') }}</div>
    @endif

    <section class="space-y-4">
        <h2 class="text-lg font-black text-slate-900">Program Unggulan</h2>
        <div class="grid gap-4 md:grid-cols-2">
            @forelse ($programs as $program)
                <article class="flex flex-col justify-between rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm">
                    <div>
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <span class="rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700">{{ $program->badge }}</span>
                                <h3 class="mt-2 text-lg font-black text-slate-900">{{ $program->title }}</h3>
                            </div>
                            <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-bold">{{ $program->price }} {{ $program->price_suffix }}</span>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-500">{{ $program->description }}</p>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border-2 border-dashed border-slate-300 bg-white p-8 text-center text-sm font-bold text-slate-500 md:col-span-2">Belum ada konten program.</div>
            @endforelse
        </div>
    </section>

    <section class="space-y-4">
        <h2 class="text-lg font-black text-slate-900">Paket Bimbingan</h2>
        <div class="grid gap-4 md:grid-cols-2">
            @forelse ($packages as $package)
                <article class="flex flex-col justify-between rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm">
                    <div>
                        <span class="rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700">{{ $package->badge }}</span>
                        <h3 class="mt-2 text-lg font-black text-slate-900">{{ $package->title }}</h3>
                        <p class="mt-3 text-sm font-semibold text-slate-500">{{ $package->description }}</p>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border-2 border-dashed border-slate-300 bg-white p-8 text-center text-sm font-bold text-slate-500 md:col-span-2">Belum ada konten paket.</div>
            @endforelse
        </div>
    </section>
</main>
@include('components.footerMobile_admin')
</body>
</html>
