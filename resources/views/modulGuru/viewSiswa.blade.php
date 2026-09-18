<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa | Cakrawala Educentre</title>
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
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24 md:pb-0">

    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto min-h-screen w-full max-w-7xl space-y-6 px-4 py-6 sm:px-6 md:space-y-8 md:px-8 lg:px-12">
        <section class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-xs font-bold text-indigo-600">
                    <a href="{{ route('guru.home') }}" class="hover:text-indigo-700">Beranda</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-400">Daftar Siswa</span>
                </div>
                <h1 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">Daftar Siswa Kelas</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola absensi dan nilai siswa dalam satu halaman.</p>
            </div>
            <a href="{{ route('guru.kelas') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-600 shadow-sm transition-colors hover:border-indigo-200 hover:text-indigo-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Kelas
            </a>
        </section>

        <section class="rounded-3xl bg-indigo-600 p-5 text-white shadow-xl shadow-indigo-100 sm:p-6">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <div class="mb-2 flex flex-wrap items-center gap-2">
                        <span class="rounded-full bg-white/15 px-3 py-1 text-[10px] font-black uppercase tracking-wider text-indigo-100">Kurikulum Merdeka</span>
                        <span class="rounded-full bg-emerald-400/20 px-3 py-1 text-[10px] font-black uppercase tracking-wider text-emerald-100">Sesi Ke-12</span>
                    </div>
                    <h2 class="text-lg font-black sm:text-xl">Kelas XI - IPA 2: Fisika Modern</h2>
                    <p class="mt-1 text-xs text-indigo-100">Tahun Ajaran 2026/2027 • Semester Ganjil</p>
                </div>
                <div class="grid grid-cols-3 gap-3 sm:gap-6 lg:min-w-[360px]">
                    <div class="border-r border-indigo-400/50 pr-3"><p class="text-2xl font-black">36</p><p class="text-[10px] text-indigo-100">Total siswa</p></div>
                    <div class="border-r border-indigo-400/50 pr-3"><p class="text-2xl font-black text-emerald-300">32</p><p class="text-[10px] text-indigo-100">Hadir</p></div>
                    <div><p class="text-2xl font-black text-amber-300">04</p><p class="text-[10px] text-indigo-100">Belum absen</p></div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm"><p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Kehadiran hari ini</p><div class="mt-2 flex items-end justify-between"><span class="text-2xl font-black text-slate-900">88.9%</span><span class="text-xs font-bold text-emerald-600">+4.2%</span></div><div class="mt-3 h-2 rounded-full bg-slate-100"><div class="h-full w-[89%] rounded-full bg-emerald-500"></div></div></div>
            <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm"><p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Nilai belum diinput</p><div class="mt-2 flex items-end justify-between"><span class="text-2xl font-black text-slate-900">8 siswa</span><span class="text-xs font-bold text-amber-600">Perlu tindakan</span></div><p class="mt-3 text-xs text-slate-500">Dari tugas Praktikum Efek Fotolistrik</p></div>
            <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm"><p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Rata-rata kelas</p><div class="mt-2 flex items-end justify-between"><span class="text-2xl font-black text-indigo-600">84.6</span><span class="text-xs font-bold text-slate-400">Skala 100</span></div><p class="mt-3 text-xs text-slate-500">Naik 3.8 poin dari sesi sebelumnya</p></div>
        </section>

        <section class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">
            <div class="flex flex-col gap-4 border-b border-slate-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                <div><h2 class="text-base font-black text-slate-900">Semua Siswa</h2><p class="mt-1 text-xs text-slate-500">Pilih status kehadiran dan kelola nilai setiap siswa.</p></div>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <label class="relative"><span class="sr-only">Cari siswa</span><input type="search" placeholder="Cari nama siswa..." class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-xs outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 sm:w-56"><svg class="absolute left-3 top-3 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.35-5.15a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z"/></svg></label>
                    <button type="button" class="rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-bold text-white shadow-md shadow-indigo-100 transition hover:bg-indigo-700">Simpan Absensi</button>
                </div>
            </div>

            @php
                $students = [
                    ['name' => 'Rayyan Pratama', 'nisn' => '0019283912', 'avatar' => 'RP', 'attendance' => 'Hadir', 'grade' => '88'],
                    ['name' => 'Bintang Cakrawala', 'nisn' => '0082718291', 'avatar' => 'BC', 'attendance' => 'Hadir', 'grade' => '-'],
                    ['name' => 'Siti Aulia Putri', 'nisn' => '0038172645', 'avatar' => 'SA', 'attendance' => 'Izin', 'grade' => '91'],
                    ['name' => 'Fajar Ramadhan', 'nisn' => '0046291820', 'avatar' => 'FR', 'attendance' => 'Belum Absen', 'grade' => '-'],
                    ['name' => 'Nabila Zahra', 'nisn' => '0073628194', 'avatar' => 'NZ', 'attendance' => 'Hadir', 'grade' => '86'],
                    ['name' => 'Dimas Saputra', 'nisn' => '0027183649', 'avatar' => 'DS', 'attendance' => 'Sakit', 'grade' => '79'],
                ];
            @endphp

            <div class="hidden overflow-x-auto md:block">
                <table class="w-full min-w-[760px] text-left">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase tracking-wider text-slate-400"><tr><th class="px-6 py-4">Siswa</th><th class="px-4 py-4">Status Absensi</th><th class="px-4 py-4">Nilai Terakhir</th><th class="px-6 py-4 text-right">Aksi</th></tr></thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($students as $student)
                            <tr class="transition-colors hover:bg-indigo-50/30">
                                <td class="px-6 py-4"><div class="flex items-center gap-3"><div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-xs font-black text-indigo-600">{{ $student['avatar'] }}</div><div><p class="text-sm font-bold text-slate-900">{{ $student['name'] }}</p><p class="text-[10px] text-slate-400">NISN: {{ $student['nisn'] }}</p></div></div></td>
                                <td class="px-4 py-4"><select class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"><option {{ $student['attendance'] === 'Hadir' ? 'selected' : '' }}>Hadir</option><option {{ $student['attendance'] === 'Izin' ? 'selected' : '' }}>Izin</option><option {{ $student['attendance'] === 'Sakit' ? 'selected' : '' }}>Sakit</option><option {{ $student['attendance'] === 'Belum Absen' ? 'selected' : '' }}>Belum Absen</option></select></td>
                                <td class="px-4 py-4"><span class="text-sm font-black {{ $student['grade'] === '-' ? 'text-slate-300' : 'text-indigo-600' }}">{{ $student['grade'] }}</span></td>
                                <td class="px-6 py-4"><div class="flex justify-end"><a href="{{ route('guru.input-nilai') }}" class="inline-flex items-center gap-2 rounded-lg border border-indigo-100 px-3 py-2 text-xs font-bold text-indigo-600 transition hover:bg-indigo-50"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-1-1v2m-4.5 5.5 8-8a2.121 2.121 0 0 1 3 3l-8 8L7 15l.5-3.5Z"/></svg>Input Nilai</a></div></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="space-y-3 p-4 md:hidden">
                @foreach ($students as $student)
                    <article class="rounded-2xl border border-slate-100 p-4 shadow-sm">
                        <div class="flex items-start justify-between gap-3"><div class="flex items-center gap-3"><div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-xs font-black text-indigo-600">{{ $student['avatar'] }}</div><div><h3 class="text-sm font-bold text-slate-900">{{ $student['name'] }}</h3><p class="text-[10px] text-slate-400">NISN: {{ $student['nisn'] }}</p></div></div><span class="text-sm font-black text-indigo-600">{{ $student['grade'] }}</span></div>
                        <div class="mt-4 flex items-center gap-2"><select class="min-w-0 flex-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 outline-none"><option {{ $student['attendance'] === 'Hadir' ? 'selected' : '' }}>Hadir</option><option {{ $student['attendance'] === 'Izin' ? 'selected' : '' }}>Izin</option><option {{ $student['attendance'] === 'Sakit' ? 'selected' : '' }}>Sakit</option><option {{ $student['attendance'] === 'Belum Absen' ? 'selected' : '' }}>Belum Absen</option></select><a href="{{ route('guru.input-nilai') }}" class="rounded-lg bg-indigo-600 px-3 py-2 text-xs font-bold text-white">Input Nilai</a></div>
                    </article>
                @endforeach
            </div>
        </section>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>
