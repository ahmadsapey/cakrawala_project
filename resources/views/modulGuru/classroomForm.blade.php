<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $classroom->exists ? 'Edit Kelas' : 'Tambah Kelas' }} | Cakrawala Educentre</title>
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

    <main class="mx-auto max-w-2xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        
        <!-- Header Halaman -->
        <div class="bg-white/85 backdrop-blur-md p-6 sm:p-7 rounded-3xl border border-teal-100 shadow-xs flex items-center justify-between gap-4">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-teal-700 bg-teal-50 border border-teal-100 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Modul Guru</span>
                <h1 class="mt-2 text-xl sm:text-2xl font-black tracking-tight text-slate-900">{{ $classroom->exists ? 'Edit Kelas' : 'Tambah Kelas Baru' }}</h1>
                <p class="mt-1 text-xs font-bold text-slate-500">Isi informasi kelas agar mudah dikelola dan ditemukan oleh siswa.</p>
            </div>
            <a href="{{ route('guru.kelas') }}" class="px-4 py-2.5 bg-white border border-teal-200 rounded-2xl text-xs font-black text-teal-700 hover:bg-teal-50 transition-all shrink-0 shadow-2xs">
                Kembali
            </a>
        </div>

        <!-- Notifikasi Error Validasi -->
        @if ($errors->any())
            <div class="p-5 bg-rose-50 border border-rose-200 text-rose-800 rounded-3xl text-xs font-bold space-y-1.5 shadow-xs">
                <p class="font-black uppercase tracking-wider">Perhatian:</p>
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form Tambah / Edit Kelas -->
        <form method="POST" action="{{ $classroom->exists ? route('guru.kelas.update', $classroom) : route('guru.kelas.store') }}" class="space-y-5 rounded-3xl border border-teal-100 bg-white/85 backdrop-blur-md p-6 sm:p-8 shadow-xs">
            @csrf
            @if ($classroom->exists)
                @method('PUT')
            @endif

            <!-- Input Nama Kelas -->
            <div class="space-y-1.5">
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700">Nama Kelas *</label>
                <input name="name" value="{{ old('name', $classroom->name) }}" required placeholder="Contoh: Fisika XI - IPA 2" class="w-full rounded-2xl border border-teal-100 bg-white px-4 py-3 text-xs sm:text-sm font-bold text-slate-900 focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all shadow-2xs">
            </div>

           

            <!-- Input Tingkat & Link Zoom -->
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="space-y-1.5">
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700">Tingkat *</label>
                    <input name="grade_level" value="{{ old('grade_level', $classroom->grade_level) }}" required placeholder="Contoh: Kelas XI" class="w-full rounded-2xl border border-teal-100 bg-white px-4 py-3 text-xs sm:text-sm font-bold text-slate-900 focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all shadow-2xs">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-700">Link Zoom / Pertemuan</label>
                    <input name="section" value="{{ old('section', $classroom->section) }}" placeholder="https://zoom.us/..." class="w-full rounded-2xl border border-teal-100 bg-white px-4 py-3 text-xs sm:text-sm font-bold text-slate-900 focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all shadow-2xs">
                </div>
            </div>

            <!-- Input Deskripsi -->
            <div class="space-y-1.5">
                <label class="block text-xs font-black uppercase tracking-wider text-slate-700">Deskripsi</label>
                <textarea name="description" rows="4" placeholder="Keterangan singkat mengenai kelas ini..." class="w-full rounded-2xl border border-teal-100 bg-white px-4 py-3 text-xs sm:text-sm font-bold text-slate-900 focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 focus:outline-none transition-all resize-none shadow-2xs">{{ old('description', $classroom->description) }}</textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-3 pt-3">
                <a href="{{ route('guru.kelas') }}" class="flex-1 rounded-2xl border border-slate-200 bg-white px-4 py-3.5 text-center text-xs font-black text-slate-700 hover:bg-slate-50 transition-all shadow-2xs">Batal</a>
                <button type="submit" class="flex-1 rounded-2xl bg-gradient-to-r from-teal-600 to-emerald-700 px-4 py-3.5 text-center text-xs font-black text-white shadow-lg shadow-teal-200 hover:from-teal-700 hover:to-emerald-800 transition-all">
                    {{ $classroom->exists ? 'Simpan Perubahan' : 'Simpan Kelas' }}
                </button>
            </div>
        </form>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>