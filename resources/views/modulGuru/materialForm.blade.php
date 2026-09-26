<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Bahan Ajar | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('components.fonts')
</head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto max-w-3xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <div>
            <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">Ruang mengajar</p>
            <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Kelola Bahan Ajar</h1>
            <p class="mt-1.5 text-xs sm:text-sm font-semibold text-slate-600">Terbitkan materi yang akan tampil di home siswa.</p>
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

        <form method="POST" action="{{ $material ? route('guru.material.update', $material) : route('guru.material.store') }}" enctype="multipart/form-data" class="space-y-5 rounded-2xl border-2 border-slate-300 bg-white p-6 shadow-sm sm:p-8">
            @csrf
            @if ($material)
                @method('PUT')
            @endif
            
            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                Kelas Target
                <select name="classroom_id" required class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    <option value="">-- Pilih Kelas Target --</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" @selected(old('classroom_id', $selectedClassroomId) == $classroom->id)>{{ $classroom->name }} - {{ $classroom->subject }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                Mata Pelajaran
                <input name="subject" value="{{ old('subject', $material?->subject) }}" required placeholder="Contoh: Fisika Modern" class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
            </label>

            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                Judul Materi
                <input name="title" value="{{ old('title', $material?->title) }}" required placeholder="Contoh: Eksperimen Efek Fotolistrik" class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
            </label>

            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                Ringkasan Ajar
                <textarea name="summary" rows="4" placeholder="Penjelasan singkat materi untuk dibaca siswa..." class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all resize-none">{{ old('summary', $material?->summary) }}</textarea>
            </label>

            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-700">
                Video Rekomendasi (URL YouTube)
                <input type="url" name="video_url" value="{{ old('video_url', $material?->video_url) }}" placeholder="https://youtube.com/..." class="mt-2 w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
            </label>

            <label class="block cursor-pointer rounded-xl border-2 border-dashed border-indigo-400 bg-indigo-50/50 hover:bg-indigo-50 p-5 text-xs sm:text-sm font-extrabold text-indigo-700 transition-all">
                {{ $material?->attachment_path ? 'Ganti Modul PDF / PPT / PPTX' : 'Pilih Modul PDF / PPT / PPTX' }}
                <input type="file" name="attachment" accept=".pdf,.ppt,.pptx" class="mt-2 block w-full text-xs font-semibold text-slate-600">
            </label>

            @if ($material?->attachment_path)
                <p class="text-xs font-semibold text-slate-500">Lampiran saat ini tersedia. Biarkan kosong untuk mempertahankannya.</p>
            @endif

            <div class="flex gap-3 pt-3">
                <button type="submit" name="status" value="draft" class="flex-1 rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-center text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">Simpan sebagai Draf</button>
                <button type="submit" name="status" value="published" class="flex-1 rounded-xl bg-indigo-600 border border-indigo-700 px-4 py-3 text-center text-xs font-extrabold text-white shadow-md hover:bg-indigo-700 transition-all">{{ $material ? 'Simpan Perubahan' : 'Terbitkan Sekarang' }}</button>
            </div>
        </form>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>
