<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas | Cakrawala Educentre</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0D9488',
                        branddark: '#0F172A',
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-teal-50/50 via-slate-50 to-emerald-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-teal-500 selection:text-white">
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto max-w-5xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <!-- Header Halaman -->
        <div>
            <span class="text-xs font-black uppercase tracking-[0.18em] text-teal-700 bg-teal-50 border border-teal-200 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Evaluasi Kelas</span>
            <h1 class="mt-2 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Tambah Tugas Baru</h1>
            <p class="mt-1 text-xs sm:text-sm font-bold text-slate-500">Tugas yang diterbitkan akan tampil secara instan pada portal siswa.</p>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-300 bg-emerald-50 px-5 py-4 text-xs font-bold text-emerald-800 shadow-sm">{{ session('success') }}</div>
        @endif

        <!-- Notifikasi Error Validasi -->
        @if ($errors->any())
            <div class="rounded-2xl border border-rose-300 bg-rose-50 px-5 py-4 text-xs font-bold text-rose-700 shadow-sm">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Tambah Tugas -->
        <form method="POST" action="{{ route('guru.tugas.store') }}" class="space-y-5 rounded-3xl border-2 border-teal-200 bg-white/90 backdrop-blur-md p-6 sm:p-10 shadow-md">
            @csrf
            
            <label class="block text-xs font-black uppercase tracking-wider text-slate-700">
                Pilih Kelas
                <select name="classroom_id" required class="mt-2 w-full rounded-2xl border-2 border-teal-200 bg-white px-4 py-3.5 text-xs sm:text-sm font-bold text-slate-900 outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 transition-all shadow-2xs">
                    <option value="">-- Pilih Kelas Target --</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" @selected(old('classroom_id', $selectedClassroomId) == $classroom->id)>{{ $classroom->name }} · {{ $classroom->subject }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block text-xs font-black uppercase tracking-wider text-slate-700">
                Judul Tugas
                <input name="title" value="{{ old('title') }}" required placeholder="Contoh: Laporan Praktikum Efek Fotolistrik" class="mt-2 w-full rounded-2xl border-2 border-teal-200 bg-white px-4 py-3.5 text-xs sm:text-sm font-bold text-slate-900 outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 transition-all shadow-2xs">
            </label>

            <label class="block text-xs font-black uppercase tracking-wider text-slate-700">
                Instruksi & Pengerjaan
                <textarea name="instructions" rows="6" required placeholder="Jelaskan detail instruksi dan petunjuk pengerjaan..." class="mt-2 w-full rounded-2xl border-2 border-teal-200 bg-white px-4 py-3.5 text-xs sm:text-sm font-bold text-slate-900 outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 transition-all shadow-2xs resize-none">{{ old('instructions') }}</textarea>
            </label>

            <div class="grid gap-4 sm:grid-cols-3">
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700">
                    Nilai Maksimal
                    <input type="number" name="points" value="{{ old('points', 100) }}" min="1" required class="mt-2 w-full rounded-2xl border-2 border-teal-200 bg-white px-4 py-3.5 text-xs sm:text-sm font-bold text-slate-900 outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 transition-all shadow-2xs">
                </label>
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700 sm:col-span-2">
                    Tenggat Pengumpulan
                    <input type="datetime-local" name="due_at" value="{{ old('due_at') }}" class="mt-2 w-full rounded-2xl border-2 border-teal-200 bg-white px-4 py-3.5 text-xs sm:text-sm font-bold text-slate-900 outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 transition-all shadow-2xs">
                </label>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <button type="submit" name="status" value="draft" class="flex-1 rounded-2xl border-2 border-teal-300 bg-white px-5 py-3.5 text-center text-xs font-black text-teal-800 hover:bg-teal-50 transition-all shadow-xs">Simpan Draf</button>
                <button type="submit" name="status" value="published" class="flex-1 rounded-2xl bg-gradient-to-r from-teal-600 to-emerald-700 border-2 border-teal-700 px-5 py-3.5 text-center text-xs font-black text-white shadow-md shadow-teal-200 hover:from-teal-700 hover:to-emerald-800 transition-all">Terbitkan Tugas</button>
            </div>
        </form>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>