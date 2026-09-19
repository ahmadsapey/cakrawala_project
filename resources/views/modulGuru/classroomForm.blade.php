<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $classroom->exists ? 'Edit Kelas' : 'Tambah Kelas' }} | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto max-w-2xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <div>
            <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Modul guru</p>
            <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">{{ $classroom->exists ? 'Edit Kelas' : 'Tambah Kelas' }}</h1>
            <p class="mt-1.5 text-xs sm:text-sm font-semibold text-slate-600">Isi informasi kelas agar mudah dikelola dan ditemukan.</p>
        </div>

        @if ($errors->any())
            <div class="rounded-xl border-2 border-rose-300 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700"><ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ $classroom->exists ? route('guru.kelas.update', $classroom) : route('guru.kelas.store') }}" class="space-y-5 rounded-2xl border-2 border-slate-300 bg-white p-6 shadow-sm sm:p-8">
            @csrf
            @if ($classroom->exists)
                @method('PUT')
            @endif
            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Nama kelas<input name="name" value="{{ old('name', $classroom->name) }}" required placeholder="Fisika XI - IPA 2" class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"></label>
            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Mata pelajaran<input name="subject" value="{{ old('subject', $classroom->subject) }}" required placeholder="Fisika" class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"></label>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Tingkat<input name="grade_level" value="{{ old('grade_level', $classroom->grade_level) }}" required placeholder="Kelas XI" class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"></label>
                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Rombel / bagian<input name="section" value="{{ old('section', $classroom->section) }}" placeholder="IPA 2" class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all"></label>
            </div>
            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">Deskripsi<textarea name="description" rows="4" placeholder="Keterangan singkat kelas..." class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all resize-none">{{ old('description', $classroom->description) }}</textarea></label>
            <div class="flex gap-3 pt-2">
                <a href="{{ route('guru.kelas') }}" class="flex-1 rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-center text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">Batal</a>
                <button type="submit" class="flex-1 rounded-xl bg-indigo-600 border border-indigo-700 px-4 py-3 text-center text-xs font-extrabold text-white shadow-md hover:bg-indigo-700 transition-all">{{ $classroom->exists ? 'Simpan Perubahan' : 'Simpan Kelas' }}</button>
            </div>
        </form>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>

