<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Guru | Cakrawala Educentre</title>
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
    @include('components.fonts')
</head>
<body class="min-h-screen bg-gradient-to-br from-teal-50/50 via-slate-50 to-emerald-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-teal-500 selection:text-white">
    @include('components.headerGuru')
    @include('components.headerGuru_mobile')

    <main class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        
        <!-- Header Halaman -->
        <div class="sticky top-16 z-40 flex flex-col justify-between gap-4 rounded-3xl border border-teal-100 bg-white/95 p-6 shadow-md shadow-slate-200/60 backdrop-blur-md sm:flex-row sm:items-end sm:p-7">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-teal-700 bg-teal-50 border border-teal-100 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Modul Guru</span>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Kelas yang Anda Ajar</h1>
                <p class="mt-1.5 text-xs sm:text-sm font-bold text-slate-500">Daftar kelas yang ditugaskan oleh Admin untuk Anda ampu.</p>
            </div>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-xs font-bold text-emerald-800 shadow-xs">
                {{ session('success') }}
            </div>
        @endif

        <!-- Daftar Kelas Grid -->
        <section class="rounded-3xl border border-teal-100 bg-white/60 p-2 shadow-xs sm:p-3">
            <div class="grid max-h-[calc(100vh-18rem)] min-h-[18rem] gap-4 overflow-y-auto pr-1 sm:max-h-[calc(100vh-16rem)] md:grid-cols-2 lg:grid-cols-3">
                @forelse ($classrooms as $classroom)
                    <article class="rounded-3xl border border-teal-100 bg-white/85 p-6 shadow-xs backdrop-blur-md transition-all hover:border-teal-600 hover:shadow-md flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <span class="rounded-xl bg-teal-50 border border-teal-200 px-3 py-1 text-xs font-extrabold text-teal-800 shadow-2xs">{{ Str::title($classroom->subject) }}</span>
                                <h2 class="mt-2.5 text-base sm:text-lg font-black text-slate-900 leading-snug">{{ Str::title($classroom->name) }}</h2>
                            </div>
                            <span class="shrink-0 text-xs font-bold text-slate-600 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-xl shadow-2xs">{{ $classroom->grade_level }}</span>
                        </div>

                        <!-- Info Guru & Jadwal -->
                        <div class="space-y-1.5 pt-1 border-t border-slate-100">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-700">
                                <span class="inline-flex h-5 w-5 items-center justify-center rounded-lg bg-teal-100 text-teal-800 text-[10px] font-black shrink-0">
                                    {{ strtoupper(substr($classroom->teacher?->user?->name ?? 'G', 0, 1)) }}
                                </span>
                                <span class="truncate">Guru: {{ $classroom->teacher?->user?->name ? Str::title($classroom->teacher->user->name) : 'Belum ditentukan' }}</span>
                            </div>

                            @if ($classroom->schedules->isNotEmpty())
                                @php $sch = $classroom->schedules->first(); @endphp
                                <div class="flex items-center gap-1.5 text-xs font-bold text-teal-700 bg-teal-50/80 border border-teal-200/60 rounded-xl px-2.5 py-1 w-fit">
                                    <svg class="w-3.5 h-3.5 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>{{ $sch->day_of_week }}, {{ substr($sch->start_time, 0, 5) }} - {{ substr($sch->end_time, 0, 5) }} WIB</span>
                                </div>
                            @else
                                <div class="flex items-center gap-1.5 text-[11px] font-bold text-slate-400">
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Jadwal fleksibel / belum diatur</span>
                                </div>
                            @endif
                        </div>

                        @if ($classroom->section)
                            <p class="text-xs font-bold text-teal-700 truncate">Rombel: {{ $classroom->section }}</p>
                        @endif
                        @if ($classroom->description)
                            <p class="line-clamp-2 text-xs font-semibold leading-relaxed text-slate-500">{{ $classroom->description }}</p>
                        @endif

                        <!-- Ringkasan Statistik -->
                        <div class="flex items-center gap-2 pt-2 text-[11px] font-bold text-slate-500 border-t border-slate-100">
                            <span class="rounded-lg bg-slate-50 px-2 py-0.5 border border-slate-200/60">{{ $classroom->students_count ?? 0 }} Siswa</span>
                            <span class="rounded-lg bg-slate-50 px-2 py-0.5 border border-slate-200/60">{{ $classroom->materials_count ?? 0 }} Materi</span>
                            <span class="rounded-lg bg-slate-50 px-2 py-0.5 border border-slate-200/60">{{ $classroom->assignments_count ?? 0 }} Tugas</span>
                        </div>
                    </div>
                    
                    <div class="mt-5 border-t border-slate-200 pt-4">
                        <a href="{{ route('guru.kelas.learning', $classroom) }}" class="block w-full rounded-2xl bg-teal-600 border border-teal-700 px-4 py-2.5 text-center text-xs font-black text-white transition-all hover:bg-teal-700 shadow-2xs">Masuk Pembelajaran</a>
                    </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-white/80 px-5 py-12 text-center text-xs font-bold text-slate-400 md:col-span-2 lg:col-span-3">
                        Belum ada kelas yang ditugaskan oleh Admin kepada Anda.
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    @include('components.footerGuru')
    @include('components.footerGuru_mobile')
</body>
</html>