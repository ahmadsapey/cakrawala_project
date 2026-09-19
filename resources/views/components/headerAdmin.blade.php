<header class="sticky top-0 z-50 hidden border-b border-slate-200/80 bg-[#F8FAFC]/95 backdrop-blur-md md:block">
    <div class="mx-auto flex min-h-20 max-w-7xl items-center justify-between gap-8 px-4 sm:px-6 lg:px-12">
        <a href="{{ route('admin.home') }}" class="group flex shrink-0 items-center gap-3" aria-label="Cakrawala Admin - Dashboard">
            <span class="flex h-10 w-10 items-center justify-center rounded-2xl border border-indigo-100 bg-white shadow-sm transition-transform group-hover:-rotate-3">
                <img src="{{ asset('storage/logoCakrawala.png') }}" alt="Logo Cakrawala" class="h-7 w-7 object-contain">
            </span>
            <span class="flex flex-col gap-0.5">
                <span class="text-sm font-black tracking-tight text-slate-900">Cakrawala</span>
                <span class="text-[9px] font-bold uppercase tracking-[0.16em] text-slate-400">Admin Portal</span>
            </span>
        </a>

        <nav class="flex items-center gap-1 rounded-2xl border border-slate-200/80 bg-slate-100/80 p-1" aria-label="Navigasi admin">
            <a href="{{ route('admin.home') }}" class="inline-flex items-center gap-2 rounded-xl px-3.5 py-2.5 text-sm font-semibold transition-all {{ request()->routeIs('admin.home') ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200/70' : 'text-slate-500 hover:bg-white/70 hover:text-slate-800' }}" @if (request()->routeIs('admin.home')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 13h8V3H3v10Zm10 8h8V11h-8v10ZM3 21h8v-6H3v6Zm10-12h8V3h-8v6Z"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="inline-flex items-center gap-2 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.siswa.*') ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200/70' : 'text-slate-500 hover:bg-white/70 hover:text-slate-800' }}" @if (request()->routeIs('admin.siswa.*')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="8" r="3" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21v-1a6 6 0 0 1 12 0v1m3-10a3 3 0 1 1-2.5 2.9M18 21v-1a5 5 0 0 0-2.5-4.33"/></svg>
                Mahasiswa
            </a>
            <a href="{{ route('admin.guru.index') }}" class="inline-flex items-center gap-2 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.guru.*') ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200/70' : 'text-slate-500 hover:bg-white/70 hover:text-slate-800' }}" @if (request()->routeIs('admin.guru.*')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="7" r="3" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 21v-1.5a7 7 0 0 1 14 0V21m-7-5v5"/></svg>
                Guru
            </a>
            <a href="{{ route('admin.pembayaran') }}" class="inline-flex items-center gap-2 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.pembayaran') ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200/70' : 'text-slate-500 hover:bg-white/70 hover:text-slate-800' }}" @if (request()->routeIs('admin.pembayaran')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><rect width="18" height="13" x="3" y="5.5" rx="2" stroke-width="1.8"/><path stroke-linecap="round" stroke-width="1.8" d="M3 10h18M7 15h3"/></svg>
                Pembayaran
            </a>
            <a href="{{ route('admin.landing.index') }}" class="inline-flex items-center gap-2 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.landing.*') ? 'bg-white text-indigo-600 shadow-sm ring-1 ring-slate-200/70' : 'text-slate-500 hover:bg-white/70 hover:text-slate-800' }}" @if (request()->routeIs('admin.landing.*')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5h16v14H4zM8 9h8M8 13h5"/></svg>
                Landing
            </a>
        </nav>
    </div>
</header>
