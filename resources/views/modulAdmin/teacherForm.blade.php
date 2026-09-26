<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $teacher ? 'Edit Data Guru' : 'Tambah Guru Baru' }} | Cakrawala Educentre</title>
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
                <h1 class="mt-2 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">{{ $teacher ? 'Edit Data Guru' : 'Tambah Guru Baru' }}</h1>
                <p class="mt-1 text-xs sm:text-sm font-bold text-slate-600">Lengkapi data profil dan akun akses guru pengajar.</p>
            </div>
            <a href="{{ route('admin.guru.index') }}" 
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

        <!-- Form Tambah/Edit Guru -->
        <form method="POST" action="{{ $teacher ? route('admin.guru.update', $teacher) : route('admin.guru.store') }}" 
            class="space-y-6 rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 sm:p-8 shadow-sm">
            @csrf
            @if ($teacher) 
                @method('PUT') 
            @endif

            <div class="grid gap-5 sm:grid-cols-2">
                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700 sm:col-span-2">
                    Nama Lengkap Guru
                    <input type="text" name="name" value="{{ old('name', $teacher?->user?->name) }}" required 
                        placeholder="Contoh: Dra. Sri Wahyuni, M.Pd"
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700">
                    NIP / Identitas Tutor
                    <input type="text" name="nip" value="{{ old('nip', $teacher?->nip) }}" required maxlength="30"
                        placeholder="Contoh: 19850312201001"
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700">
                    Mata Pelajaran yang Diampu
                    <input type="text" name="subject" value="{{ old('subject', $teacher?->subject) }}" required maxlength="100"
                        placeholder="Contoh: Fisika, Matematika"
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700 sm:col-span-2">
                    Email Akun Guru
                    <input type="email" name="email" value="{{ old('email', $teacher?->user?->email) }}" required
                        placeholder="Contoh: guru.fisika@cakrawala.test"
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700">
                    Kata Sandi {{ $teacher ? '(Kosongkan jika tidak diubah)' : '' }}
                    <input type="password" name="password" {{ $teacher ? '' : 'required' }} minlength="8"
                        placeholder="Minimal 8 karakter"
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700">
                    Konfirmasi Kata Sandi
                    <input type="password" name="password_confirmation" {{ $teacher ? '' : 'required' }} minlength="8"
                        placeholder="Ulangi kata sandi"
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700">
                    No. WhatsApp / HP <span class="font-normal text-slate-400">(opsional)</span>
                    <input type="text" name="phone" value="{{ old('phone', $teacher?->phone) }}" maxlength="30"
                        placeholder="Contoh: 081234567890"
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                </label>

                <label class="space-y-2 text-xs sm:text-sm font-black text-slate-700">
                    Status Akun
                    <select name="status" required
                        class="w-full rounded-2xl border-2 border-indigo-100 bg-slate-50/50 px-4 py-3 font-semibold text-slate-900 outline-none focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                        <option value="active" @selected(old('status', $teacher?->status ?? 'active') === 'active')>Aktif</option>
                        <option value="inactive" @selected(old('status', $teacher?->status) === 'inactive')>Tidak Aktif</option>
                    </select>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.guru.index') }}" 
                    class="rounded-2xl border-2 border-slate-200 bg-slate-100 px-5 py-3 text-xs font-black text-slate-600 hover:bg-slate-200 transition-all">
                    Batal
                </a>
                <button type="submit" 
                    class="rounded-2xl bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 px-6 py-3 text-xs font-black text-white shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-blue-800 transition-all">
                    {{ $teacher ? 'Perbarui Data Guru' : 'Simpan Data Guru' }}
                </button>
            </div>
        </form>

    </main>

    @include('components.footerMobile_admin')

</body>

</html>
