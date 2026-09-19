<footer class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200/80 bg-white/95 shadow-[0_-4px_16px_rgba(15,23,42,0.06)] backdrop-blur-md md:hidden" aria-label="Navigasi guru">
	<nav class="mx-auto grid h-[76px] max-w-lg grid-cols-4 items-center px-3" aria-label="Menu utama guru">
		<a href="{{ route('guru.home') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('guru.home') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors hover:text-indigo-600 focus:text-indigo-600">
			<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9Z"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 21v-6h6v6"/>
			</svg>
			<span class="text-[11px] font-medium">Beranda</span>
		</a>

		<a href="{{ route('guru.kelas') }}" class="flex h-full flex-col items-center justify-center gap-1 {{ request()->routeIs('guru.kelas*') ? 'text-indigo-600' : 'text-slate-500' }} transition-colors hover:text-indigo-600 focus:text-indigo-600">
			<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<rect width="13" height="9" x="3" y="7" rx="2"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16 10 5-3v10l-5-3"/>
			</svg>
			<span class="text-[11px] font-semibold">Kelas Ajar</span>
		</a>

		<details class="group relative flex h-full flex-col items-center justify-center {{ request()->routeIs('guru.material.create') || request()->routeIs('guru.tugas.*') || request()->routeIs('guru.kuis.*') ? 'text-indigo-600' : 'text-slate-500' }}">
			<summary class="list-none flex cursor-pointer flex-col items-center justify-center gap-1 transition-colors hover:text-indigo-600 focus:text-indigo-600">
			<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5.5v16M8 7h8m-8 4h8"/>
			</svg>
			<span class="text-[11px] font-medium">Materi</span>
			</summary>
			<div class="absolute bottom-[66px] right-0 w-40 rounded-2xl border border-slate-100 bg-white p-2 text-left shadow-xl shadow-indigo-100/50">
				
				<a href="{{ route('guru.tugas.tambah') }}" class="block rounded-xl px-3 py-2 text-[11px] font-semibold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Tambah Tugas</a>
				<a href="{{ route('guru.kuis.tambah') }}" class="block rounded-xl px-3 py-2 text-[11px] font-semibold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Tambah Kuis</a>
			</div>
		</details>

		<details class="group relative flex h-full flex-col items-center justify-center {{ request()->routeIs('guru.koreksi.*') ? 'text-indigo-600' : 'text-slate-500' }}">
			<summary class="list-none flex cursor-pointer flex-col items-center justify-center gap-1 transition-colors hover:text-indigo-600 focus:text-indigo-600">
			<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m8 12 2.5 2.5L16 9"/>
			</svg>
			<span class="text-[11px] font-medium">Koreksi</span>
			</summary>
			<div class="absolute bottom-[66px] right-0 w-40 rounded-2xl border border-slate-100 bg-white p-2 text-left shadow-xl shadow-indigo-100/50">
				<a href="{{ route('guru.koreksi.kuis') }}" class="block rounded-xl px-3 py-2 text-[11px] font-semibold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Koreksi Kuis</a>
				<a href="{{ route('guru.koreksi.tugas') }}" class="block rounded-xl px-3 py-2 text-[11px] font-semibold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">Koreksi Tugas</a>
			</div>
		</details>
	</nav>
</footer>
