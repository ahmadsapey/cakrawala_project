<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Guru | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Modul guru</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Kelas yang Anda Ajar</h1>
                <p class="mt-1.5 text-xs sm:text-sm font-semibold text-slate-600">Lihat, ubah, atau hapus kelas yang sudah Anda input.</p>
            </div>
            <a href="{{ route('guru.kelas.create') }}" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 border border-indigo-700 px-5 py-3 text-xs font-extrabold text-white shadow-md transition-colors hover:bg-indigo-700">+ Tambah Kelas Baru</a>
        </div>

        @if (session('success'))
            <div class="rounded-xl border-2 border-emerald-300 bg-emerald-50 px-4 py-3 text-xs font-extrabold text-emerald-800">{{ session('success') }}</div>
        @endif

        <section class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($classrooms as $classroom)
                <article class="rounded-2xl border-2 border-slate-300 bg-white p-6 shadow-sm hover:border-indigo-600 hover:shadow-md transition-all">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <span class="rounded-lg bg-indigo-100 border border-indigo-300 px-3 py-1 text-xs font-extrabold uppercase tracking-wider text-indigo-800">{{ $classroom->subject }}</span>
                            <h2 class="mt-3 text-base sm:text-lg font-extrabold text-slate-900 leading-snug">{{ $classroom->name }}</h2>
                        </div>
                        <span class="shrink-0 text-xs font-bold text-slate-600 bg-slate-100 border border-slate-300 px-2.5 py-1 rounded-lg">{{ $classroom->grade_level }}</span>
                    </div>
                    @if ($classroom->section)
                        <p class="mt-2 text-xs font-bold text-slate-600">{{ $classroom->section }}</p>
                    @endif
                    @if ($classroom->description)
                        <p class="mt-3 line-clamp-3 text-xs font-medium leading-relaxed text-slate-600">{{ $classroom->description }}</p>
                    @endif
                    <div class="mt-5 flex items-center gap-2 border-t-2 border-slate-200 pt-4">
                        <a href="{{ route('guru.kelas.learning', $classroom) }}" class="flex-1 rounded-xl bg-indigo-600 border border-indigo-700 px-3 py-2.5 text-center text-xs font-extrabold text-white transition-colors hover:bg-indigo-700">Masuk Kelas</a>
                        <a href="{{ route('guru.kelas.edit', $classroom) }}" class="flex-1 rounded-xl border-2 border-indigo-300 bg-indigo-50 px-3 py-2.5 text-center text-xs font-extrabold text-indigo-700 transition-colors hover:bg-indigo-100">Edit</a>
                        <form method="POST" action="{{ route('guru.kelas.destroy', $classroom) }}" class="flex-1" onsubmit="return confirm('Hapus kelas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full rounded-xl border-2 border-rose-300 bg-rose-50 px-3 py-2.5 text-xs font-extrabold text-rose-700 transition-colors hover:bg-rose-100">Hapus</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-white px-5 py-12 text-center text-xs font-semibold text-slate-500 md:col-span-2 lg:col-span-3">Belum ada kelas yang diinput. Tambahkan kelas pertama Anda.</div>
            @endforelse
        </section>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>

