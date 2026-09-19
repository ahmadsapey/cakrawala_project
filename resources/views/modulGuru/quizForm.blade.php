<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kuis | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto max-w-3xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <div>
            <p class="text-xs font-extrabold uppercase tracking-wider text-amber-700">Evaluasi kelas</p>
            <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Tambah Kuis Baru</h1>
            <p class="mt-1.5 text-xs sm:text-sm font-semibold text-slate-600">Kuis yang diterbitkan akan tampil otomatis di portal pengerjaan siswa.</p>
        </div>

        @if (session('success'))
            <div class="rounded-xl border-2 border-emerald-300 bg-emerald-50 px-4 py-3 text-xs font-extrabold text-emerald-800">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl border-2 border-rose-300 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('guru.kuis.store') }}" class="space-y-5 rounded-2xl border-2 border-slate-300 bg-white p-6 shadow-sm sm:p-8">
            @csrf
            
            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                Pilih Kelas
                <select name="classroom_id" required class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    <option value="">-- Pilih Kelas Target --</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" @selected(old('classroom_id', $selectedClassroomId) == $classroom->id)>{{ $classroom->name }} · {{ $classroom->subject }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                Judul Kuis
                <input name="title" value="{{ old('title') }}" required placeholder="Contoh: Kuis Termodinamika & Mesin Carnot" class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
            </label>

            <div class="grid gap-4 sm:grid-cols-3">
                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                    Durasi (menit)
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes', 30) }}" min="1" required class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </label>
                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                    Batas KKM
                    <input type="number" name="passing_score" value="{{ old('passing_score', 75) }}" min="0" max="100" required class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </label>
                <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                    Jumlah Soal
                    <input type="number" name="question_count" value="{{ old('question_count', 10) }}" min="1" required class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </label>
            </div>

            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                Tenggat Kuis
                <input type="datetime-local" name="due_at" value="{{ old('due_at') }}" class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
            </label>

            <div class="flex gap-3 pt-3">
                <button type="submit" name="status" value="draft" class="flex-1 rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-center text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">Simpan Draf</button>
                <button type="submit" name="status" value="published" class="flex-1 rounded-xl bg-indigo-600 border border-indigo-700 px-4 py-3 text-center text-xs font-extrabold text-white shadow-md hover:bg-indigo-700 transition-all">Terbitkan Kuis</button>
            </div>
        </form>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>
