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
    @include('components.fonts')
</head>
<body class="bg-gradient-to-br from-indigo-50/60 via-slate-50 to-purple-50/50 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-32">

    @include('components.hiderSiswa')

    <div class="mx-auto flex w-full max-w-7xl flex-col space-y-8 p-4 sm:p-6 md:p-8 lg:px-12">
        
        <!-- HERO SECTION: Profil & Ringkasan Aktivitas Belajar -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 pt-2">
            
            <!-- Profil Sapaan (Kolom Kiri - 5 Span) -->
            <div class="md:col-span-5 bg-white/85 backdrop-blur-md p-6 sm:p-7 rounded-3xl border border-indigo-100 shadow-sm flex flex-col justify-between space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Avatar siswa" class="w-14 h-14 rounded-2xl object-cover border-2 border-indigo-200 shadow-sm shrink-0">
                        <div>
                            <h2 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">
                                Halo, {{ $student?->user?->name ?? 'Siswa' }}!
                            </h2>
                            <p class="text-xs text-indigo-600 font-extrabold mt-0.5 tracking-wide uppercase">{{ $student?->class_name ?? 'Kelas siswa' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-indigo-50">
                    <span class="text-xs font-extrabold text-slate-500">Kurikulum Merdeka</span>
                    <button class="w-10 h-10 rounded-2xl bg-indigo-50/80 border border-indigo-100 flex items-center justify-center text-indigo-600 hover:bg-indigo-100/50 shadow-2xs transition-all relative">
                        <span class="absolute top-2.5 right-2.5 w-2.5 h-2.5 bg-rose-500 rounded-full border border-white"></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Ringkasan Statistik Belajar Card (7 Span) -->
            <div class="md:col-span-7 relative rounded-3xl bg-gradient-to-r from-indigo-600 to-purple-600 p-6 sm:p-7 text-white shadow-lg shadow-indigo-200 flex flex-col justify-between overflow-hidden border border-indigo-500/30">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <span class="text-xs font-black uppercase tracking-wider text-indigo-100">Ringkasan Aktivitas Belajar</span>
                    <span class="px-3.5 py-1.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl text-xs font-black tracking-wider">Semester Aktif</span>
                </div>
                
                <div class="grid grid-cols-2 gap-3 relative z-10 pt-2">
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/15 text-center">
                        <span class="block text-[10px] font-bold text-indigo-100 uppercase tracking-wider">Mata Pelajaran</span>
                        <span class="text-base sm:text-lg font-black text-white mt-0.5 block">{{ count($subjects) }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/15 text-center">
                        <span class="block text-[10px] font-bold text-indigo-100 uppercase tracking-wider">Rekomendasi</span>
                        <span class="text-base sm:text-lg font-black text-amber-300 mt-0.5 block">{{ count($videoRecommendations) + count($recommendations) }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- SECTION: Mata Pelajaran (Slider Horizontal Utama) -->
        <div class="space-y-4 pt-2">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-xs font-black text-slate-500 uppercase tracking-wider">Mata Pelajaran</h3>
                <div class="flex items-center space-x-3">
                    <span class="text-[11px] font-bold text-slate-400">&rarr;</span>
                    <a href="{{ route('siswa.materi') }}" class="text-xs font-black text-indigo-600 hover:text-indigo-700 flex items-center space-x-1">
                        <span>Lainnya</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Container Scroll Horizontal Mata Pelajaran -->
            <div class="flex overflow-x-auto space-x-4 pb-3 pt-1 snap-x scrollbar-thin">
                @forelse ($subjects as $subject)
                    <a href="{{ route('siswa.materi', ['subject' => $subject->subject]) }}" class="w-[260px] sm:w-[280px] shrink-0 snap-start bg-white/85 backdrop-blur-sm p-4 rounded-3xl border border-indigo-100 shadow-sm hover:border-indigo-300 hover:shadow-md transition-all cursor-pointer flex items-center space-x-4 group">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-100 flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-indigo-600 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div class="min-w-0 pr-2">
                            <h4 class="text-xs font-black text-slate-900 group-hover:text-indigo-600 transition-colors leading-tight truncate">{{ $subject->subject }}</h4>
                            <p class="text-[11px] text-slate-500 font-bold mt-1">{{ $subject->materials_count }} Materi</p>
                        </div>
                    </a>
                @empty
                    <div class="w-full rounded-3xl border border-indigo-100 bg-white/85 backdrop-blur-sm p-6 text-xs font-bold text-slate-500 text-center shadow-sm">Belum ada mata pelajaran yang diterbitkan guru.</div>
                @endforelse
            </div>
        </div>

        <!-- SECTION: Rekomendasi Belajar (Slider Horizontal) -->
        <div class="space-y-4 pt-2">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-xs font-black text-slate-500 uppercase tracking-wider">Rekomendasi Belajar</h3>
                <div class="flex items-center space-x-3">
                    <span class="text-[11px] font-bold text-slate-400">&rarr;</span>
                    <a href="{{ route('siswa.materi') }}" class="text-xs font-black text-indigo-600 hover:text-indigo-700 flex items-center space-x-1">
                        <span>Lainnya</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Container Scroll Horizontal untuk Rekomendasi -->
            <div class="flex overflow-x-auto space-x-4 pb-3 pt-1 snap-x scrollbar-thin">
                @foreach ($videoRecommendations as $video)
                    <article class="w-[280px] sm:w-[300px] shrink-0 snap-start rounded-3xl border border-indigo-100 bg-white/85 backdrop-blur-sm p-4 shadow-sm transition-all hover:border-indigo-300 hover:shadow-md flex flex-col justify-between">
                        <div>
                            <div class="flex h-28 items-center justify-center rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 shadow-2xs">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m10 8 6 4-6 4V8Z"/><rect width="18" height="14" x="3" y="5" rx="2"/></svg>
                            </div>
                            <p class="mt-3 text-[10px] font-black uppercase tracking-wider text-indigo-600">{{ $video->subject }}</p>
                            <h4 class="mt-1 line-clamp-2 text-xs font-black leading-snug text-slate-900">{{ $video->title }}</h4>
                            <p class="mt-1.5 line-clamp-2 text-[11px] font-bold leading-relaxed text-slate-600">{{ $video->summary ?: 'Video pembelajaran dari guru.' }}</p>
                        </div>
                        <div class="pt-3 mt-3 border-t border-indigo-50">
                            <p class="text-[10px] font-bold text-slate-400 truncate">Dari {{ $video->teacher?->user?->name ?? 'Guru' }}</p>
                            <a href="{{ $video->video_url }}" target="_blank" rel="noopener" class="mt-1 inline-flex text-xs font-black text-indigo-600 hover:underline">Tonton video</a>
                        </div>
                    </article>
                @endforeach
                @foreach ($recommendations as $recommendation)
                    <article class="w-[280px] sm:w-[300px] shrink-0 snap-start rounded-3xl border border-indigo-100 bg-white/85 backdrop-blur-sm p-4 shadow-sm transition-all hover:border-indigo-300 hover:shadow-md flex flex-col justify-between">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-wider text-indigo-600">{{ $recommendation->subject }}</p>
                            <h4 class="mt-1.5 line-clamp-2 text-xs font-black leading-snug text-slate-900">{{ $recommendation->title }}</h4>
                            @if ($recommendation->summary)
                                <p class="mt-1.5 line-clamp-3 text-[11px] font-bold leading-relaxed text-slate-600">{{ $recommendation->summary }}</p>
                            @endif
                        </div>
                        <div class="pt-3 mt-3 border-t border-indigo-50">
                            <p class="text-[10px] font-bold text-slate-400 truncate">Dari {{ $recommendation->teacher?->user?->name ?? 'Guru' }}</p>
                            @if ($recommendation->resource_url)
                                <a href="{{ $recommendation->resource_url }}" target="_blank" rel="noopener" class="mt-1 inline-flex text-xs font-black text-indigo-600 hover:underline">Buka rekomendasi</a>
                            @endif
                        </div>
                    </article>
                @endforeach
                @if ($videoRecommendations->isEmpty() && $recommendations->isEmpty())
                    <div class="w-full rounded-3xl border border-indigo-100 bg-white/85 backdrop-blur-sm p-6 text-xs font-bold text-slate-500 text-center shadow-sm">Belum ada video rekomendasi dari guru.</div>
                @endif
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

</body>
</html>