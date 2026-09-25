<header class="sticky top-0 z-50 hidden border-b border-slate-200/80 bg-[#F8FAFC]/95 backdrop-blur-md md:block">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6">
        <a href="{{ url('/') }}" class="flex items-center gap-2.5" aria-label="Cakrawala - Beranda">
            <img src="{{ asset('images/logoCakrawala.png') }}" alt="Logo Cakrawala" class="h-8 w-8 object-contain">
            <span class="text-sm font-bold tracking-tight text-indigo-600">Cakrawala</span>
            <span class="rounded bg-amber-50 px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-amber-600">Tutorial Portal</span>
        </a>

        <nav class="ml-auto flex items-center gap-1" aria-label="Navigasi guru">
            <a href="{{ route('guru.home') }}" class="inline-flex items-center gap-2 rounded-xl {{ request()->routeIs('guru.home') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-semibold transition-colors hover:bg-indigo-100 hover:text-indigo-600" @if (request()->routeIs('guru.home')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 21v-6h6v6"/></svg>
                Beranda
            </a>
            <a href="{{ route('guru.kelas') }}" class="inline-flex items-center gap-2 rounded-xl {{ request()->routeIs('guru.kelas*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-medium transition-colors hover:bg-indigo-50 hover:text-indigo-600 focus:bg-indigo-50 focus:text-indigo-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><rect width="13" height="9" x="3" y="7" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16 10 5-3v10l-5-3"/></svg>
                Kelas
            </a>
            <details class="group relative">
                <summary class="inline-flex cursor-pointer list-none items-center gap-2 rounded-xl {{ request()->routeIs('guru.material.*') || request()->routeIs('guru.tugas.*') || request()->routeIs('guru.kuis.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-medium transition-colors hover:bg-indigo-50 hover:text-indigo-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5.5v16M8 7h8m-8 4h8"/></svg>
                    Materi
                    <svg class="h-4 w-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/></svg>
                </summary>
                <div class="absolute right-0 mt-2 w-52 rounded-2xl border border-slate-100 bg-white p-2 shadow-xl shadow-indigo-100/50">
                    <a href="{{ route('guru.tugas.tambah') }}" class="flex items-center justify-between rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-600 transition-colors hover:bg-indigo-50 hover:text-indigo-600"><span>Tambah Tugas</span><span class="text-[10px] text-slate-400">Tugas</span></a>
                    <a href="{{ route('guru.kuis.tambah') }}" class="flex items-center justify-between rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-600 transition-colors hover:bg-indigo-50 hover:text-indigo-600"><span>Tambah Kuis</span><span class="text-[10px] text-slate-400">Kuis</span></a>
                </div>
            </details>
            <details class="group relative">
                <summary class="inline-flex cursor-pointer list-none items-center gap-2 rounded-xl {{ request()->routeIs('guru.koreksi.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-medium transition-colors hover:bg-indigo-50 hover:text-indigo-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m8 12 2.5 2.5L16 9"/></svg>
                    Koreksi
                    <svg class="h-4 w-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/></svg>
                </summary>
                <div class="absolute right-0 mt-2 w-52 rounded-2xl border border-slate-100 bg-white p-2 shadow-xl shadow-indigo-100/50">
                    <a href="{{ route('guru.koreksi.kuis') }}" class="flex items-center justify-between rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-600 transition-colors hover:bg-indigo-50 hover:text-indigo-600"><span>Koreksi Kuis</span><span class="text-[10px] text-slate-400">Kuis</span></a>
                    <a href="{{ route('guru.koreksi.tugas') }}" class="flex items-center justify-between rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-600 transition-colors hover:bg-indigo-50 hover:text-indigo-600"><span>Koreksi Tugas</span><span class="text-[10px] text-slate-400">Tugas</span></a>
                </div>
            </details>
        </nav>

        <a href="{{ route('guru.home') }}" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-slate-500 transition-colors hover:bg-indigo-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/30" aria-label="Buka pengaturan" title="Pengaturan">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 2.37c.94 1.543-.826 3.31-2.37 0a1.724 1.724 0 00-2.573 0a1.724 1.724 0 00-2.573 1.066c-.94 1.543-.826 3.31 2.37 2.37a1.724 1.724 0 001.065-2.572c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426-1.756-2.924-1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-.826 3.31-2.37 2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c.94-1.543-.826-3.31-2.37-2.37a1.724 1.724 0 00-2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </a>
    </div>
</header>
