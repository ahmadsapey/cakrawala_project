<header class="sticky top-0 z-50 hidden border-b border-slate-200/80 bg-[#F8FAFC]/95 backdrop-blur-md md:block">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-8 px-4 sm:px-6 lg:px-12">
        <a href="{{ route('admin.home') }}" class="flex shrink-0 items-center gap-2.5" aria-label="Cakrawala Admin - Dashboard">
            <img src="{{ asset('storage/logoCakrawala.png') }}" alt="Logo Cakrawala" class="h-8 w-8 object-contain">
            <span class="text-sm font-bold tracking-tight text-slate-800">Cakrawala</span>
            <span class="rounded bg-slate-100 px-1.5 py-0.5 text-[8px] font-bold uppercase tracking-wide text-slate-500">Admin Portal</span>
        </a>

        <nav class="ml-auto flex items-center justify-end gap-1" aria-label="Navigasi admin">
            <a href="{{ route('admin.home') }}" class="inline-flex items-center gap-2 rounded-xl {{ request()->routeIs('admin.home') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-semibold transition-colors hover:bg-indigo-50 hover:text-indigo-600" @if (request()->routeIs('admin.home')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 13h8V3H3v10Zm10 8h8V11h-8v10ZM3 21h8v-6H3v6Zm10-12h8V3h-8v6Z"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.siswa') }}" class="inline-flex items-center gap-2 rounded-xl {{ request()->routeIs('admin.siswa') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-medium transition-colors hover:bg-indigo-50 hover:text-indigo-600" @if (request()->routeIs('admin.siswa')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="8" r="3" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21v-1a6 6 0 0 1 12 0v1m3-10a3 3 0 1 1-2.5 2.9M18 21v-1a5 5 0 0 0-2.5-4.33"/></svg>
                Mahasiswa
            </a>
            <a href="{{ route('admin.guru') }}" class="inline-flex items-center gap-2 rounded-xl {{ request()->routeIs('admin.guru') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-medium transition-colors hover:bg-indigo-50 hover:text-indigo-600" @if (request()->routeIs('admin.guru')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="7" r="3" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 21v-1.5a7 7 0 0 1 14 0V21m-7-5v5"/></svg>
                Guru
            </a>
            <a href="{{ route('admin.pembayaran') }}" class="inline-flex items-center gap-2 rounded-xl {{ request()->routeIs('admin.pembayaran') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-medium transition-colors hover:bg-indigo-50 hover:text-indigo-600" @if (request()->routeIs('admin.pembayaran')) aria-current="page" @endif>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><rect width="18" height="13" x="3" y="5.5" rx="2" stroke-width="1.8"/><path stroke-linecap="round" stroke-width="1.8" d="M3 10h18M7 15h3"/></svg>
                Pembayaran
            </a>
        </nav>
    </div>
</header>
