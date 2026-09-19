<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | Cakrawala Educentre</title>
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
<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24 md:pb-8">

    @include('components.hiderSiswa')

    <div class="mx-auto grid min-h-screen w-full max-w-7xl grid-cols-1 gap-6 bg-slate-100 p-4 sm:p-6 md:grid-cols-12 md:gap-8 md:px-8 lg:px-12">
        <div class="col-span-1 flex items-center justify-between pt-2 md:col-span-12">
            <div class="flex items-center space-x-3">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Avatar siswa" class="w-12 h-12 rounded-full object-cover border-2 border-indigo-600 shadow-sm">
                <div>
                    <h2 class="text-base font-extrabold text-slate-900 flex items-center space-x-1.5">
                        <span>Halo, {{ $student?->user?->name ?? 'Siswa' }}!</span>
                        <span class="text-base">👋</span>
                    </h2>
                    <p class="text-xs text-slate-600 font-semibold">{{ $student?->class_name ?? 'Kelas siswa' }} • Kurikulum Merdeka</p>
                </div>
            </div>
            <button class="w-10 h-10 rounded-xl bg-white border-2 border-slate-300 flex items-center justify-center text-slate-700 hover:bg-slate-50 shadow-sm transition-all relative">
                <span class="absolute top-2.5 right-2.5 w-2.5 h-2.5 bg-rose-500 rounded-full border border-white"></span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </button>
        </div>

        <!-- Target Belajar Minggu Ini Card -->
        <div class="relative col-span-1 rounded-2xl bg-indigo-700 border-2 border-indigo-800 p-6 text-white shadow-md md:col-span-7 flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-extrabold uppercase tracking-wider text-indigo-100">Target Belajar Minggu Ini</span>
                <span class="px-3 py-1 bg-white/20 border border-white/30 rounded-lg text-xs font-bold tracking-wider">Level 14</span>
            </div>
            
            <div class="space-y-2 mt-2">
                <div class="flex justify-between text-xs font-bold text-indigo-100">
                    <span>Progres Belajar</span>
                    <span class="font-extrabold text-amber-300">75% (6/8 Jam)</span>
                </div>
                <!-- Progress Bar -->
                <div class="w-full bg-slate-900/40 border border-indigo-400/30 rounded-full h-3 overflow-hidden p-0.5">
                    <div class="bg-amber-400 h-full rounded-full transition-all duration-500" style="width: 75%"></div>
                </div>
            </div>
        </div>

        <!-- Mata Pelajaran Section -->
        <div class="col-span-1 space-y-3 md:col-span-5">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Mata Pelajaran</h3>
                <a href="{{ route('siswa.materi') }}" class="text-xs font-bold text-indigo-600 hover:underline flex items-center space-x-0.5">
                    <span>Lihat Semua</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Grid Mata Pelajaran -->
            <div class="grid grid-cols-2 gap-3">
                @forelse ($subjects as $subject)
                    <a href="{{ route('siswa.materi', ['subject' => $subject->subject]) }}" class="bg-white p-4 rounded-2xl border-2 border-slate-200 shadow-sm hover:border-indigo-600 hover:shadow-md transition-all cursor-pointer flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 border border-indigo-300 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900 leading-tight">{{ $subject->subject }}</h4>
                            <p class="text-[11px] text-slate-500 font-medium mt-0.5">{{ $subject->materials_count }} Materi</p>
                        </div>
                    </a>
                @empty
                    <p class="col-span-2 rounded-2xl border-2 border-dashed border-slate-300 bg-white p-4 text-xs font-semibold text-slate-500 text-center">Belum ada mata pelajaran yang diterbitkan guru.</p>
                @endforelse
            </div>
        </div>

        <!-- Kelas Interaktif Hari Ini -->
        <div class="col-span-1 space-y-3 md:col-span-7">
            <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Kelas Interaktif Hari Ini</h3>
            @forelse ($classrooms as $classroom)
                <div class="space-y-4 rounded-2xl border-2 border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between text-xs">
                        <span class="flex items-center space-x-1.5 rounded-lg bg-indigo-100 border border-indigo-300 px-3 py-1 font-extrabold text-indigo-700">
                            <span class="h-2 w-2 rounded-full bg-indigo-600"></span>
                            <span>KELAS GURU</span>
                        </span>
                        <span class="font-bold text-slate-600">{{ $classroom->grade_level }}{{ $classroom->section ? ' · '.$classroom->section : '' }}</span>
                    </div>

                    <div>
                        <h4 class="text-base font-extrabold text-slate-900">{{ $classroom->name }}</h4>
                        <p class="mt-1 text-xs font-semibold text-slate-600">{{ $classroom->subject }}</p>
                    </div>

                    <div class="flex items-center justify-between border-t-2 border-slate-200 pt-3">
                        <div>
                            <h5 class="text-xs font-extrabold text-slate-900">{{ $classroom->teacher?->user?->name ?? 'Guru' }}</h5>
                            <p class="text-[11px] font-medium text-slate-500">Pelajaran {{ $classroom->subject }}</p>
                        </div>
                        <a href="{{ route('siswa.kelas.show', $classroom) }}" class="inline-flex items-center space-x-1.5 rounded-xl bg-indigo-600 border border-indigo-700 px-4 py-2 text-xs font-extrabold text-white shadow-md transition-all hover:bg-indigo-700">
                            <span>Masuk Kelas</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-white p-6 text-center text-xs font-semibold text-slate-500">Belum ada kelas yang dibuat guru.</div>
            @endforelse
        </div>

        <!-- Rekomendasi Belajar -->
        <div class="col-span-1 space-y-3 md:col-span-5">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Rekomendasi Belajar</h3>
                <a href="{{ route('siswa.materi') }}" class="text-xs font-bold text-indigo-600 hover:underline flex items-center space-x-0.5">
                    <span>Lainnya</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 gap-3">
                @foreach ($videoRecommendations as $video)
                    <article class="rounded-2xl border-2 border-slate-200 bg-white p-3.5 shadow-sm transition-all hover:border-indigo-600 hover:shadow-md">
                        <div class="flex h-24 items-center justify-center rounded-xl bg-indigo-100 border border-indigo-300 text-indigo-700">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m10 8 6 4-6 4V8Z"/><rect width="18" height="14" x="3" y="5" rx="2"/></svg>
                        </div>
                        <p class="mt-3 text-[10px] font-extrabold uppercase tracking-wider text-indigo-700">{{ $video->subject }}</p>
                        <h4 class="mt-1 line-clamp-2 text-xs font-bold leading-snug text-slate-900">{{ $video->title }}</h4>
                        <p class="mt-2 line-clamp-2 text-[11px] font-medium leading-relaxed text-slate-600">{{ $video->summary ?: 'Video pembelajaran dari guru.' }}</p>
                        <p class="mt-3 text-[10px] font-semibold text-slate-500">Dari {{ $video->teacher?->user?->name ?? 'Guru' }}</p>
                        <a href="{{ $video->video_url }}" target="_blank" rel="noopener" class="mt-3 inline-flex text-xs font-bold text-indigo-600 hover:underline">Tonton video</a>
                    </article>
                @endforeach
                @foreach ($recommendations as $recommendation)
                    <article class="rounded-2xl border-2 border-slate-200 bg-white p-3.5 shadow-sm transition-all hover:border-indigo-600 hover:shadow-md">
                        <p class="text-[10px] font-extrabold uppercase tracking-wider text-indigo-700">{{ $recommendation->subject }}</p>
                        <h4 class="mt-2 line-clamp-2 text-xs font-bold leading-snug text-slate-900">{{ $recommendation->title }}</h4>
                        @if ($recommendation->summary)
                            <p class="mt-2 line-clamp-3 text-[11px] font-medium leading-relaxed text-slate-600">{{ $recommendation->summary }}</p>
                        @endif
                        <p class="mt-3 text-[10px] font-semibold text-slate-500">Dari {{ $recommendation->teacher?->user?->name ?? 'Guru' }}</p>
                        @if ($recommendation->resource_url)
                            <a href="{{ $recommendation->resource_url }}" target="_blank" rel="noopener" class="mt-3 inline-flex text-xs font-bold text-indigo-600 hover:underline">Buka rekomendasi</a>
                        @endif
                    </article>
                @endforeach
                @if ($videoRecommendations->isEmpty() && $recommendations->isEmpty())
                    <p class="col-span-2 rounded-2xl border-2 border-dashed border-slate-300 bg-white p-4 text-xs font-semibold text-slate-500 text-center">Belum ada video rekomendasi dari guru.</p>
                @endif
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>