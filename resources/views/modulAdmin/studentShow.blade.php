<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata {{ $student->user?->name }} | Cakrawala Educentre</title>
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
        <div class="flex items-center justify-between gap-4 rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 sm:p-8 shadow-sm">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-indigo-700 bg-indigo-50 border border-indigo-200 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Biodata Siswa</span>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $student->user?->name }}</h1>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('admin.siswa.index') }}" 
                    class="rounded-2xl border-2 border-indigo-200 bg-indigo-50 px-4 py-2.5 text-xs font-black text-indigo-700 hover:bg-indigo-100 transition-all">Kembali</a>
                <a href="{{ route('admin.siswa.edit', $student) }}" 
                    class="rounded-2xl bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 px-5 py-2.5 text-xs font-black text-white shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-blue-800 transition-all">Edit</a>
            </div>
        </div>

        <!-- Kartu Detail Biodata -->
        <div class="grid gap-6 rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 sm:p-8 shadow-sm sm:grid-cols-2">
            <div>
                <p class="text-xs font-black uppercase tracking-wider text-slate-400">NISN</p>
                <p class="mt-1 font-bold text-slate-900">{{ $student->nisn }}</p>
            </div>
            <div>
                <p class="text-xs font-black uppercase tracking-wider text-slate-400">Kelas</p>
                <p class="mt-1 font-bold text-slate-900">{{ $student->class_name }}</p>
            </div>
            <div>
                <p class="text-xs font-black uppercase tracking-wider text-slate-400">Asal Sekolah</p>
                <p class="mt-1 font-bold text-slate-900">{{ $student->school_name }}</p>
            </div>
            <div>
                <p class="text-xs font-black uppercase tracking-wider text-slate-400">No. HP Orang Tua</p>
                <p class="mt-1 font-bold text-slate-900">{{ $student->phone ?: '-' }}</p>
            </div>
            <div>
                <p class="text-xs font-black uppercase tracking-wider text-slate-400">Nama Wali</p>
                <p class="mt-1 font-bold text-slate-900">{{ $student->guardian_name ?: '-' }}</p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-xs font-black uppercase tracking-wider text-slate-400">Alamat</p>
                <p class="mt-1 whitespace-pre-line font-bold text-slate-900">{{ $student->address }}</p>
            </div>
            <div>
                <p class="text-xs font-black uppercase tracking-wider text-slate-400">Email Akun</p>
                <p class="mt-1 font-bold text-slate-900">{{ $student->user?->email }}</p>
            </div>
            <div>
                <p class="text-xs font-black uppercase tracking-wider text-slate-400">Status</p>
                <div class="mt-1">
                    <span class="px-3 py-1.5 {{ $student->status === 'active' ? 'bg-emerald-50 border-emerald-300 text-emerald-800' : 'bg-rose-50 border-rose-300 text-rose-800' }} border text-xs font-black rounded-xl inline-block">
                        {{ $student->status === 'active' ? 'Aktif' : 'Tidak aktif' }}
                    </span>
                </div>
            </div>
        </div>

    </main>

    @include('components.footerMobile_admin')

</body>

</html>