<footer class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200/80 bg-white/95 shadow-[0_-4px_16px_rgba(15,23,42,0.06)] backdrop-blur-md md:hidden" aria-label="Navigasi siswa">
	<nav class="mx-auto grid h-[72px] max-w-lg grid-cols-5 items-center px-2" aria-label="Menu utama siswa">
		<a href="{{ route('siswa.home') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('siswa.home') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors" @if (request()->routeIs('siswa.home')) aria-current="page" @endif>
			<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9Z"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 21v-6h6v6"/>
			</svg>
			<span class="text-[10px] font-medium">Beranda</span>
		</a>

		<a href="{{ route('siswa.jadwal') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('siswa.jadwal') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors hover:text-indigo-600">
			<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
			</svg>
			<span class="text-[10px] font-medium">Jadwal</span>
		</a>

		<a href="{{ route('siswa.tryout') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('siswa.tryout*') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors hover:text-indigo-600">
			<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
			</svg>
			<span class="text-[10px] font-medium">Tryout</span>
		</a>

		<a href="{{ route('siswa.materi') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('siswa.materi') || request()->routeIs('siswa.tugas') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors hover:text-indigo-600">
			<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
			</svg>
			<span class="text-[10px] font-medium">Modul</span>
		</a>

		<a href="{{ route('siswa.profile') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('siswa.profile*') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors hover:text-indigo-600">
			<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<circle cx="12" cy="7" r="3.5"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 21v-1.5a5.5 5.5 0 0 1 11 0V21"/>
			</svg>
			<span class="text-[10px] font-medium">Profil</span>
		</a>
	</nav>
</footer>
