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
<body class="bg-gradient-to-br from-indigo-50/60 via-slate-50 to-purple-50/50 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-32">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-4xl flex-col space-y-6 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="bg-white/85 backdrop-blur-md p-6 sm:p-7 rounded-3xl border border-indigo-100 shadow-sm flex items-center justify-between gap-4">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-indigo-600 bg-indigo-50 border border-indigo-100 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Pengaturan</span>
                <h1 class="mt-2 text-xl sm:text-2xl font-black tracking-tight text-slate-900">Edit Profil Siswa</h1>
                <p class="text-xs font-bold text-slate-500 mt-1">Perbarui data diri dan akun belajar Anda.</p>
            </div>
            <a href="{{ route('siswa.profile') }}" class="px-4 py-2.5 bg-white border border-indigo-200 rounded-2xl text-xs font-black text-indigo-600 hover:bg-indigo-50 transition-all shrink-0 shadow-2xs">
                Kembali
            </a>
        </div>

        <!-- Notifikasi Error Validasi -->
        @if ($errors->any())
            <div class="p-5 bg-rose-50 border border-rose-200 text-rose-800 rounded-3xl text-xs font-bold space-y-1.5 shadow-sm">
                <p class="font-black uppercase tracking-wider">Perhatian:</p>
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form Input Data Pengguna -->
        <form method="POST" action="{{ route('siswa.profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Bagian Foto Profil & Ringkasan Akun -->
            <div class="bg-white/85 backdrop-blur-md p-6 sm:p-7 rounded-3xl border border-indigo-100 shadow-sm space-y-4">
                <h3 class="text-xs font-black text-slate-500 uppercase tracking-wider">Foto & Informasi Akun</h3>
                
                <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-5 pt-2">
                    <div class="w-20 h-20 rounded-2xl bg-indigo-50 text-indigo-700 border border-indigo-200 flex items-center justify-center font-black text-2xl shrink-0 shadow-2xl">
                        {{ strtoupper(substr($user?->name ?? 'S', 0, 2)) }}
                    </div>
                    <div class="text-center sm:text-left space-y-1">
                        <h4 class="text-base font-black text-slate-900">{{ $user?->name ?? 'Siswa' }}</h4>
                        <p class="text-xs text-slate-500 font-bold">{{ $user?->email ?? '-' }}</p>
                        <p class="text-[11px] text-indigo-600 font-black pt-1">Format gambar: JPG, PNG (Maks. 2MB)</p>
                    </div>
                </div>
            </div>

            <!-- Card Utama Input Form -->
            <div class="bg-white/85 backdrop-blur-md p-6 sm:p-7 rounded-3xl border border-indigo-100 shadow-sm space-y-5">
                
                <!-- Input 1: Nama Lengkap -->
                <div class="space-y-1.5">
                    <label for="name" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Nama Lengkap *</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-indigo-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}" required class="w-full bg-white text-xs sm:text-sm font-bold text-slate-900 pl-11 pr-4 py-3 border border-indigo-100 rounded-2xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all shadow-2xs">
                    </div>
                </div>

                <!-- Input 2: NISN -->
                <div class="space-y-1.5">
                    <label for="nisn" class="block text-xs font-black text-slate-700 uppercase tracking-wider">NISN *</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-indigo-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                        </span>
                        <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $student?->nisn) }}" required class="w-full bg-white text-xs sm:text-sm font-bold text-slate-900 pl-11 pr-4 py-3 border border-indigo-100 rounded-2xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all shadow-2xs">
                    </div>
                </div>

                <!-- Input 3: Alamat Email -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Alamat Email *</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-indigo-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email', $user?->email) }}" required class="w-full bg-white text-xs sm:text-sm font-bold text-slate-900 pl-11 pr-4 py-3 border border-indigo-100 rounded-2xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all shadow-2xs">
                    </div>
                </div>

                <!-- Input 4: Nomor Telepon / WA -->
                <div class="space-y-1.5">
                    <label for="phone" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Nomor Telepon / WhatsApp</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-indigo-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </span>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $student?->phone) }}" placeholder="08123456789" class="w-full bg-white text-xs sm:text-sm font-bold text-slate-900 pl-11 pr-4 py-3 border border-indigo-100 rounded-2xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all shadow-2xs">
                    </div>
                </div>

                <!-- Input 5: Kelas -->
                <div class="space-y-1.5">
                    <label for="class_name" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Kelas *</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-indigo-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </span>
                        <input type="text" id="class_name" name="class_name" value="{{ old('class_name', $student?->class_name) }}" required placeholder="Contoh: Kelas XI MIPA 1" class="w-full bg-white text-xs sm:text-sm font-bold text-slate-900 pl-11 pr-4 py-3 border border-indigo-100 rounded-2xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all shadow-2xs">
                    </div>
                </div>

                <!-- Input 6: Password Baru (Opsional) -->
                <div class="space-y-1.5 pt-3 border-t border-indigo-50">
                    <label for="password" class="block text-xs font-black text-slate-700 uppercase tracking-wider">Kata Sandi Baru (Opsional)</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-indigo-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </span>
                        <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah kata sandi" class="w-full bg-white text-xs sm:text-sm font-bold text-slate-900 pl-11 pr-4 py-3 border border-indigo-100 rounded-2xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none transition-all shadow-2xs">
                    </div>
                </div>

            </div>

            <!-- Tombol Simpan Perubahan -->
            <div>
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs sm:text-sm rounded-2xl shadow-lg shadow-indigo-200 transition-all text-center">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>