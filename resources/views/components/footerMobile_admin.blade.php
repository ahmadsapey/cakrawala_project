<footer class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200/80 bg-white/95 shadow-[0_-4px_16px_rgba(15,23,42,0.06)] backdrop-blur-md md:hidden" aria-label="Navigasi admin">
    <nav class="mx-auto grid h-[78px] max-w-lg grid-cols-5 items-center gap-1 px-3" aria-label="Menu utama admin">
        <a href="{{ route('admin.home') }}" class="flex h-14 flex-col items-center justify-center gap-1 rounded-2xl transition-colors {{ request()->routeIs('admin.home') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600' }}" @if (request()->routeIs('admin.home')) aria-current="page" @endif>
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 13h8V3H3v10Zm10 8h8V11h-8v10ZM3 21h8v-6H3v6Zm10-12h8V3h-8v6Z"/>
            </svg>
            <span class="text-[11px] font-semibold">Dashboard</span>
        </a>

           <a href="{{ route('admin.kelas.index') }}" class="flex h-14 flex-col items-center justify-center gap-1 rounded-2xl transition-colors {{ request()->routeIs('admin.kelas.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600' }}" @if (request()->routeIs('admin.kelas.*')) aria-current="page" @endif>
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><rect width="13" height="9" x="3" y="7" rx="2" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16 10 5-3v10l-5-3"/></svg>
            <span class="text-[11px] font-medium">Kelas</span>
        </a>

        <a href="{{ route('admin.siswa.index') }}" class="flex h-14 flex-col items-center justify-center gap-1 rounded-2xl transition-colors {{ request()->routeIs('admin.siswa.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600' }}" @if (request()->routeIs('admin.siswa.*')) aria-current="page" @endif>
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="9" cy="8" r="3" stroke-width="1.8"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 21v-1a6 6 0 0 1 12 0v1m3-10a3 3 0 1 1-2.5 2.9M18 21v-1a5 5 0 0 0-2.5-4.33"/>
            </svg>
            <span class="text-[11px] font-medium">Siswa</span>
        </a>

        <a href="{{ route('admin.guru.index') }}" class="flex h-14 flex-col items-center justify-center gap-1 rounded-2xl transition-colors {{ request()->routeIs('admin.guru.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600' }}" @if (request()->routeIs('admin.guru.*')) aria-current="page" @endif>
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="7" r="3" stroke-width="1.8"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 21v-1.5a7 7 0 0 1 14 0V21m-7-5v5"/>
            </svg>
            <span class="text-[11px] font-medium">Guru</span>
        </a>

     

        <a href="{{ route('admin.pembayaran') }}" class="flex h-14 flex-col items-center justify-center gap-1 rounded-2xl transition-colors {{ request()->routeIs('admin.pembayaran') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:bg-slate-50 hover:text-indigo-600' }}" @if (request()->routeIs('admin.pembayaran')) aria-current="page" @endif>
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <rect width="18" height="13" x="3" y="5.5" rx="2" stroke-width="1.8"/>
                <path stroke-linecap="round" stroke-width="1.8" d="M3 10h18M7 15h3"/>
            </svg>
            <span class="text-[11px] font-medium">Pembayaran</span>
        </a>

        
    </nav>
</footer>
