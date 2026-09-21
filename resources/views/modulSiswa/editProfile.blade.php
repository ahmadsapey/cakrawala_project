<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil | Cakrawala Educentre</title>
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
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="pt-2">
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Edit Profil</h1>
        <div class="pt-2 flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Edit Profil Siswa</h1>
                <p class="text-xs font-semibold text-slate-500 mt-0.5">Perbarui data diri dan akun belajar Anda.</p>
            </div>
            <a href="{{ route('siswa.profile') }}" class="px-4 py-2 bg-white border-2 border-slate-300 rounded-xl text-xs font-extrabold text-slate-700 hover:bg-slate-50 transition-all">
                Kembali
            </a>
        </div>

        <!-- Bagian Foto Profil & Tombol Ubah -->
        <div class="bg-white p-6 rounded-2xl border-2 border-slate-200 shadow-sm flex flex-col items-center justify-center space-y-3">
            <div class="relative group">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover shadow-md border-4 border-indigo-600">
                <div class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        @if ($errors->any())
            <div class="p-4 bg-rose-50 border-2 border-rose-300 text-rose-800 rounded-2xl text-xs font-bold space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form Input Data Pengguna -->
        <form method="POST" action="{{ route('siswa.profile.update') }}" class="bg-white p-6 rounded-2xl border-2 border-slate-200 shadow-sm space-y-5">
            @csrf
            @method('PUT')

            <!-- Avatar Preview -->
            <div class="flex items-center space-x-4 pb-4 border-b-2 border-slate-200">
                <div class="w-16 h-16 rounded-2xl bg-indigo-100 text-indigo-700 border-2 border-indigo-300 flex items-center justify-center font-extrabold text-xl shrink-0 shadow-sm">
                    {{ strtoupper(substr($user?->name ?? 'S', 0, 2)) }}
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900">{{ $user?->name ?? 'Siswa' }}</h3>
                    <p class="text-xs text-slate-500 font-semibold">{{ $user?->email ?? '-' }}</p>
                </div>
            </div>
            <button class="text-xs font-extrabold text-indigo-600 hover:text-indigo-800 transition-colors uppercase tracking-wider">
                Ubah Foto Profil
            </button>
        </div>

        <!-- Form Input Data Pengguna -->
        <div class="bg-white p-6 rounded-2xl border-2 border-slate-200 shadow-sm space-y-5">
            
            <!-- Input 1: Nama Lengkap -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Nama Lengkap</label>
                <label for="name" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Nama Lengkap *</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                    <input type="text" value="Bintang Cakrawala" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}" required class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>
            </div>

            <!-- Input 2: NISN -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">NISN</label>
                <label for="nisn" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">NISN *</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                    </span>
                    <input type="text" value="0082718291" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $student?->nisn) }}" required class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>
            </div>

            <!-- Input 3: Alamat Email -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Alamat Email</label>
                <label for="email" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Alamat Email *</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    <input type="email" value="bintang@cakrawala.sch.id" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    <input type="email" id="email" name="email" value="{{ old('email', $user?->email) }}" required class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>
            </div>

            <!-- Input 4: Nomor Telepon -->
            <!-- Input 4: Nomor Telepon / WA -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Nomor Telepon</label>
                <label for="phone" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Nomor Telepon / WhatsApp</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </span>
                    <input type="text" value="+62 812 3456 7890" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $student?->phone) }}" placeholder="08123456789" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>
            </div>

            <!-- Input 5: Sekolah -->
            <!-- Input 5: Kelas -->
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Sekolah</label>
                <label for="class_name" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Kelas *</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.16 3.422A12.083 12.083 0 015.84 10.578L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"/></svg>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </span>
                    <input type="text" id="class_name" name="class_name" value="{{ old('class_name', $student?->class_name) }}" required placeholder="Contoh: Kelas XI MIPA 1" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>
            </div>

                    <input type="text" value="SMA Negeri 1 Harapan Bangsa" class="w-full bg-transparent text-xs font-bold text-slate-800 pl-11 pr-4 py-3.5 focus:outline-none">
            <!-- Input 6: Password Baru (Opsional) -->
            <div class="space-y-1.5 pt-2 border-t-2 border-slate-200">
                <label for="password" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Kata Sandi Baru (Opsional)</label>
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah kata sandi" class="w-full bg-white text-xs sm:text-sm font-semibold text-slate-900 pl-11 pr-4 py-3 border-2 border-slate-300 rounded-xl focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all">
                </div>
            </div>

        </div>
            <!-- Tombol Simpan Perubahan -->
            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs sm:text-sm rounded-2xl shadow-lg shadow-indigo-200 transition-all text-center">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>

        <!-- Tombol Simpan Perubahan -->
        <div class="pt-4">
            <button class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all text-center">
                Simpan Perubahan
            </button>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>