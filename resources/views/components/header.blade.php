@php
    $brandContent = $brandContent ?? null;
    $themeContent = $themeContent ?? null;
    $theme = $themeContent?->features ?? [];
    $headerBg = $headerBg ?? ($theme['header_bg'] ?? '#FFFFFF');
    $headerText = $headerText ?? ($theme['header_text'] ?? '#1E293B');
@endphp

<header class="sticky top-0 z-50 backdrop-blur-md border-b border-slate-200/40 shadow-sm transition-colors duration-300" style="background-color: {{ $headerBg }}; color: {{ $headerText }};">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 min-h-20 flex flex-wrap items-center justify-between gap-4 py-3">

        <!-- Logo & Brand -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0 group" aria-label="{{ $brandContent?->title ?? 'Cakrawala Educentre' }} - Beranda">
            <img src="{{ $brandContent?->image_url ?? asset('images/logoCakrawala.png') }}" alt="Logo {{ $brandContent?->title ?? 'Cakrawala Educentre' }}" class="w-11 h-11 object-contain transition-transform group-hover:scale-105">
            <span class="hidden sm:block text-sm font-extrabold tracking-tight uppercase" style="color: {{ $headerText }};">{{ $brandContent?->title ?? 'Cakrawala Educentre' }}</span>
        </a>

        <!-- Navigasi Utama -->
        <nav aria-label="Navigasi utama" class="hidden items-center gap-2 sm:gap-3 text-sm font-semibold md:flex" style="color: {{ $headerText }};">

            <!-- Dropdown Layanan -->
            <details class="relative group">
                <summary class="list-none cursor-pointer px-4 py-2.5 rounded-xl hover:bg-black/5 transition-all duration-200" style="color: {{ $headerText }};">
                    <span class="inline-flex items-center gap-1.5">
                        Layanan
                        <svg class="w-4 h-4 transition-transform duration-200 group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                        </svg>
                    </span>
                </summary>
                <div class="absolute right-0 mt-2 w-56 rounded-2xl border border-slate-200/40 p-2 shadow-xl backdrop-blur-sm z-50 animate-in fade-in zoom-in-95 duration-150" style="background-color: {{ $headerBg }}; color: {{ $headerText }};">
                    <a href="{{ url('/') }}#pricing" class="block rounded-xl px-3.5 py-2.5 hover:bg-black/5 transition-colors" style="color: {{ $headerText }};">
                        Paket Belajar
                    </a>
                    <a href="{{ url('/') }}#pricing" class="block rounded-xl px-3.5 py-2.5 hover:bg-black/5 transition-colors" style="color: {{ $headerText }};">
                        Konsultasi Privat
                    </a>
                </div>
            </details>

            <!-- Tautan Menu Lainnya -->
            <a href="{{ route('landing.tentang') }}" class="px-4 py-2.5 rounded-xl hover:bg-black/5 transition-all duration-200" style="color: {{ $headerText }};">
                Tentang
            </a>

            <a href="{{ url('/virtual') }}" class="px-4 py-2.5 rounded-xl hover:bg-black/5 transition-all duration-200" style="color: {{ $headerText }};">
                Virtual
            </a>

            <!-- Tombol Aksi (Login) -->
            <div class="flex items-center gap-2.5 ml-1 sm:ml-2 pl-2 sm:pl-3 border-l border-slate-200/40">
                <a href="{{ route('siswa.home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs sm:text-sm px-5 py-2.5 rounded-xl shadow-md transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0">
                    Login
                </a>
            </div>

        </nav>

        <div class="flex items-center gap-2 md:hidden">
            <details class="relative group">
                <summary class="inline-flex cursor-pointer list-none items-center gap-1.5 rounded-xl border border-slate-200/50 px-3 py-2 text-xs font-bold shadow-sm transition-colors hover:border-indigo-300" style="background-color: {{ $headerBg }}; color: {{ $headerText }};">
                    Menu
                    <svg class="h-4 w-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                    </svg>
                </summary>
                <div class="absolute right-0 z-50 mt-2 w-52 rounded-2xl border border-slate-200/40 p-2 text-sm shadow-xl" style="background-color: {{ $headerBg }}; color: {{ $headerText }};">
                    <a href="{{ url('/') }}#pricing" class="block rounded-xl px-3 py-2.5 hover:bg-black/5" style="color: {{ $headerText }};">Paket Belajar</a>
                    <a href="{{ url('/') }}#pricing" class="block rounded-xl px-3 py-2.5 hover:bg-black/5" style="color: {{ $headerText }};">Konsultasi Privat</a>
                    <a href="{{ route('landing.tentang') }}" class="block rounded-xl px-3 py-2.5 hover:bg-black/5" style="color: {{ $headerText }};">Tentang</a>
                    <a href="{{ url('/virtual') }}" class="block rounded-xl px-3 py-2.5 hover:bg-black/5" style="color: {{ $headerText }};">Virtual</a>
                </div>
            </details>

            <a href="{{ route('siswa.home') }}" class="inline-flex items-center rounded-xl bg-indigo-600 px-3.5 py-2 text-xs font-bold text-white shadow-sm transition-colors hover:bg-indigo-700">
                Login
            </a>
        </div>
    </div>
</header>