<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student ? 'Edit Siswa' : 'Tambah Siswa' }} | Cakrawala Educentre</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        branddark: '#0B0F19',
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50/50 via-slate-50 to-blue-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

    @include('components.headerAdmin')

    <!-- Container Utama -->
    <main class="mx-auto flex w-full max-w-3xl flex-col space-y-6 px-4 py-8 sm:px-6 lg:px-12">

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 sm:p-8 shadow-sm">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-indigo-700 bg-indigo-50 border border-indigo-200 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Modul Admin</span>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">{{ $student ? 'Edit Data Siswa' : 'Tambah Siswa' }}</h1>
                <p class="mt-1 text-xs sm:text-sm font-bold text-slate-600">Lengkapi biodata utama siswa dan akun akses belajarnya.</p>
            </div>
            <a href="{{ route('admin.siswa.index') }}" 
                class="rounded-2xl border-2 border-indigo-200 bg-indigo-50 px-5 py-3 text-center text-xs font-black text-indigo-700 hover:bg-indigo-100 transition-all inline-flex items-center justify-center shrink-0">
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="rounded-2xl border-2 border-rose-300 bg-rose-50 p-5 text-xs sm:text-sm font-bold text-rose-800 shadow-sm" role="alert">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Tambah/Edit -->
        <form method="POST" action="{{ $student ? route('admin.siswa.update', $student) : route('admin.siswa.store') }}" 
            class="space-y-6 rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 sm:p-8 shadow-sm">
            @csrf
            @if ($student) 
                @method('PUT') 
            @endif

            <div class="grid gap-5 sm:grid-cols-2">
                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700 sm:col-span-2">Nama lengkap
                    <input name="name" value="{{ old('name', $student?->user?->name) }}" required 
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700">NISN
                    <input name="nisn" value="{{ old('nisn', $student?->nisn) }}" required maxlength="20" 
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700">Kelas
                    <select name="classroom_id" required class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                        <option value="">Pilih kelas</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" @selected((string) old('classroom_id', $student?->classrooms?->first()?->id) === (string) $classroom->id)>
                                {{ $classroom->name }} · {{ $classroom->teacher?->user?->name ?? 'Guru belum tersedia' }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700 sm:col-span-2">Asal sekolah
                    <input name="school_name" value="{{ old('school_name', $student?->school_name) }}" required 
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700 sm:col-span-2">Alamat
                    <textarea name="address" rows="3" required 
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">{{ old('address', $student?->address) }}</textarea>
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700 sm:col-span-2">Nama Wali
                    <input name="guardian_name" value="{{ old('guardian_name', $student?->guardian_name) }}" required
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700 sm:col-span-2">No Wali <span class="font-bold text-slate-400">(opsional)</span>
                    <input name="phone" value="{{ old('phone', $student?->phone) }}" 
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700 sm:col-span-2">Status siswa
                    <select name="status" required class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                        <option value="active" @selected(old('status', $student?->status ?? 'active') === 'active')>Aktif</option>
                        <option value="inactive" @selected(old('status', $student?->status) === 'inactive')>Tidak Aktif</option>
                    </select>
                </label>
            </div>

            <button type="submit"
                class="w-full rounded-2xl bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 px-5 py-4 text-xs sm:text-sm font-black text-white shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-blue-800 transition-all">
                {{ $student ? 'Simpan Perubahan' : 'Tambah Siswa' }}
            </button>
        </form>

    </main>

    @include('components.footerMobile_admin')

</body>

</html>