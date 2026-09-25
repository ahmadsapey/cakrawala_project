<footer class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200/80 bg-white/95 shadow-[0_-4px_16px_rgba(15,23,42,0.06)] backdrop-blur-md md:hidden" aria-label="Navigasi siswa">
	<nav class="mx-auto grid h-[76px] max-w-lg grid-cols-4 items-center px-3" aria-label="Menu utama siswa">
		<a href="{{ route('siswa.home') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('siswa.home') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors" @if (request()->routeIs('siswa.home')) aria-current="page" @endif>
			<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9Z"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 21v-6h6v6"/>
			</svg>
			<span class="text-[11px] font-semibold">Beranda</span>
		</a>

		<a href="{{ route('siswa.kelas') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('siswa.kelas') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors hover:text-indigo-600 focus:text-indigo-600">
			<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<rect width="13" height="9" x="3" y="7" rx="2"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16 10 5-3v10l-5-3"/>
			</svg>
			<span class="text-[11px] font-medium">Kelas</span>
		</a>

		<details class="group relative flex h-full flex-col items-center justify-center {{ request()->routeIs('siswa.materi') || request()->routeIs('siswa.tugas') ? 'text-indigo-600' : 'text-slate-500' }}">
			<summary class="list-none flex cursor-pointer flex-col items-center justify-center gap-1 transition-colors hover:text-indigo-600 focus:text-indigo-600">
			<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<rect width="14" height="19" x="5" y="2.5" rx="2"/>
				<path stroke-linecap="round" stroke-width="1.8" d="M9 18.5h6"/>
			</svg>
			<span class="text-[11px] font-medium">Materi</span>
			</summary>
			<div class="absolute bottom-[66px] right-0 w-40 rounded-2xl border border-slate-100 bg-white p-2 text-left shadow-xl shadow-indigo-100/50">
				<a href="{{ route('siswa.materi') }}" class="block rounded-xl px-3 py-2 text-[11px] font-semibold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Materi</a>
				<a href="{{ route('siswa.tugas') }}" class="block rounded-xl px-3 py-2 text-[11px] font-semibold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Tugas</a>
			</div>
		</details>

		<a href="{{ route('siswa.profile') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('siswa.profile*') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors hover:text-indigo-600 focus:text-indigo-600">
			<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<circle cx="12" cy="7" r="3.5"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 21v-1.5a5.5 5.5 0 0 1 11 0V21"/>
			</svg>
			<span class="text-[11px] font-medium">Profil</span>
		</a>
	</nav>
</footer>
