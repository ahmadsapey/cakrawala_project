<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Absensi {{ $classroom->name }} | Cakrawala Educentre</title>
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

    <main class="mx-auto max-w-6xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        
        <!-- Header & Filter Tanggal -->
        <div class="sticky top-16 z-40 flex flex-col justify-between gap-6 rounded-3xl border border-teal-100 bg-white/95 p-6 shadow-md shadow-slate-200/60 backdrop-blur-md sm:flex-row sm:items-end sm:p-8">
            <div>
                <a href="{{ route('guru.kelas.learning', $classroom) }}" class="text-xs font-black uppercase tracking-wider text-teal-700 hover:text-teal-900 transition-colors">&larr; Kembali ke kelas</a>
                <span class="mt-4 block text-xs font-black uppercase tracking-[0.18em] text-teal-700 bg-teal-50 border border-teal-100 px-3 py-1.5 rounded-xl w-max shadow-2xs">Kehadiran Siswa</span>
                <h1 class="mt-2 text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">{{ $classroom->name }}</h1>
                <p class="mt-1 text-xs sm:text-sm font-bold text-slate-500">{{ $classroom->subject }} · {{ $classroom->grade_level }}{{ $classroom->section ? ' · ' . $classroom->section : '' }}</p>
            </div>
            
            <form method="GET" action="{{ route('guru.kelas.absensi', $classroom) }}" class="flex flex-col sm:flex-row items-end gap-2.5">
                <label for="date" class="w-full sm:w-auto text-xs font-black uppercase tracking-wider text-slate-700">
                    Tanggal Absensi
                    <input id="date" name="date" type="date" value="{{ $date }}" class="mt-1.5 block w-full rounded-2xl border border-teal-100 bg-white px-3.5 py-3 text-xs sm:text-sm font-bold text-slate-900 outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-500/20 transition-all shadow-2xs">
                </label>
                <button type="submit" class="w-full sm:w-auto rounded-2xl bg-teal-600 border border-teal-700 px-5 py-3 text-xs font-black text-white shadow-md shadow-teal-200 transition-all hover:bg-teal-700">Tampilkan</button>
            </form>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-xs font-bold text-emerald-800 shadow-xs" role="status">{{ session('success') }}</div>
        @endif

        <!-- Notifikasi Error Validasi -->
        @if ($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-xs font-bold text-rose-700 shadow-xs" role="alert">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $statusLabels = ['present' => 'Hadir', 'late' => 'Terlambat', 'excused' => 'Izin', 'absent' => 'Alpa'];
            $statusStyles = [
                'present' => 'border-emerald-200 bg-emerald-50 text-emerald-700', 
                'late' => 'border-amber-200 bg-amber-50 text-amber-700', 
                'excused' => 'border-sky-200 bg-sky-50 text-sky-700', 
                'absent' => 'border-rose-200 bg-rose-50 text-rose-700'
            ];
        @endphp

        <!-- Form Absensi Siswa -->
        <form method="POST" action="{{ route('guru.kelas.absensi.store', $classroom) }}" class="space-y-5">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">

            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Daftar Siswa</h2>
                    <p class="mt-0.5 text-xs font-semibold text-slate-500">{{ $students->count() }} siswa terdaftar di kelas ini</p>
                </div>
                @if ($students->isNotEmpty())
                    <button type="submit" class="rounded-2xl bg-gradient-to-r from-teal-600 to-emerald-700 px-5 py-3 text-xs font-black text-white shadow-lg shadow-teal-200 transition-all hover:from-teal-700 hover:to-emerald-800">Simpan Absensi</button>
                @endif
            </div>

            @if ($students->isEmpty())
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white/80 p-12 text-center shadow-2xs">
                    <p class="text-base font-black text-slate-800">Belum ada siswa di kelas ini</p>
                    <p class="mt-2 text-xs font-semibold text-slate-500">Tambahkan siswa ke kelas terlebih dahulu agar absensi dapat dikelola.</p>
                </div>
            @else
                <div class="overflow-hidden rounded-3xl border border-teal-100 bg-white/85 backdrop-blur-md shadow-xs">
                    <!-- Header Tabel Tetap (Sticky) -->
                    <div class="hidden grid-cols-[minmax(0,1fr)_10rem] gap-4 border-b border-slate-200 bg-slate-50 px-6 py-3.5 text-xs font-black uppercase tracking-wider text-slate-500 sm:grid">
                        <span>Nama Siswa</span>
                        <span>Status Kehadiran</span>
                    </div>

                    <!-- Kontainer Daftar Siswa dengan Scroll Vertikal -->
                    <div class="max-h-[520px] overflow-y-auto divide-y divide-slate-100 pr-1">
                        @foreach ($students as $student)
                            @php
                                $currentStatus = old('attendance.' . $student->id, $attendance->get($student->id)?->status ?? 'absent');
                            @endphp
                            <div class="grid gap-3 px-5 py-4 sm:grid-cols-[minmax(0,1fr)_10rem] sm:items-center sm:gap-4 sm:px-6 hover:bg-teal-50/30 transition-colors">
                                <div class="flex min-w-0 items-center gap-3.5">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-teal-50 border border-teal-100 text-xs font-black text-teal-700 shadow-2xs">
                                        {{ strtoupper(substr($student->user->name ?? '?', 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="truncate text-xs sm:text-sm font-black text-slate-900">{{ $student->user->name ?? 'Nama tidak tersedia' }}</p>
                                        <p class="mt-0.5 text-[11px] font-semibold text-slate-500">NISN {{ $student->nisn }} · {{ $student->class_name }}</p>
                                    </div>
                                </div>
                                <label class="sm:block">
                                    <span class="mb-1.5 block text-[10px] font-black uppercase tracking-wider text-slate-400 sm:hidden">Status kehadiran</span>
                                    <select name="attendance[{{ $student->id }}]" class="w-full rounded-2xl border px-3.5 py-2.5 text-xs font-black outline-none transition-all shadow-2xs focus:ring-2 focus:ring-teal-500/20 {{ $statusStyles[$currentStatus] ?? $statusStyles['absent'] }}">
                                        @foreach ($statusLabels as $value => $label)
                                            <option value="{{ $value }}" @selected($currentStatus === $value)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </form>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>