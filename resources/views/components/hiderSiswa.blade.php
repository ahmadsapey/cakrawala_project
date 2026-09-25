<header class="sticky top-0 z-50 hidden border-b border-slate-200/80 bg-[#F8FAFC]/95 backdrop-blur-md md:block">
	<div class="mx-auto flex min-h-20 max-w-7xl items-center gap-8 px-6 py-3 sm:px-8 lg:px-12">
		<a href="{{ url('/') }}" class="flex shrink-0 items-center gap-3" aria-label="Cakrawala - Beranda">
			<img src="{{ asset('images/logoCakrawala.png') }}" alt="Logo Cakrawala" class="h-10 w-10 object-contain">
			<span class="text-xl font-bold tracking-tight text-indigo-600">Cakrawala</span>
		</a>

		<nav class="ml-auto flex flex-1 items-center justify-end gap-1" aria-label="Navigasi siswa">
			<a href="{{ route('siswa.home') }}" class="inline-flex items-center gap-2 rounded-xl {{ request()->routeIs('siswa.home') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-semibold transition-colors hover:bg-indigo-100 hover:text-indigo-600" @if (request()->routeIs('siswa.home')) aria-current="page" @endif>
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9Z"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 21v-6h6v6"/>
				</svg>
				Beranda
			</a>
			<a href="{{ route('siswa.kelas') }}" class="inline-flex items-center gap-2 rounded-xl {{ request()->routeIs('siswa.kelas') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-medium transition-colors hover:bg-indigo-50 hover:text-indigo-600 focus:bg-indigo-50 focus:text-indigo-600">
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<rect width="13" height="9" x="3" y="7" rx="2"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16 10 5-3v10l-5-3"/>
				</svg>
				Kelas
			</a>
			<details class="group relative">
				<summary class="list-none inline-flex cursor-pointer items-center gap-2 rounded-xl {{ request()->routeIs('siswa.materi') || request()->routeIs('siswa.tugas') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-medium transition-colors hover:bg-indigo-50 hover:text-indigo-600">
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<rect width="14" height="19" x="5" y="2.5" rx="2"/>
					<path stroke-linecap="round" stroke-width="1.8" d="M9 18.5h6"/>
				</svg>
				Materi & Tugas
				<svg class="h-4 w-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/></svg>
				</summary>
				<div class="absolute right-0 mt-2 w-52 rounded-2xl border border-slate-100 bg-white p-2 shadow-xl shadow-indigo-100/50">
					<a href="{{ route('siswa.materi') }}" class="flex items-center justify-between rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-600 transition-colors hover:bg-indigo-50 hover:text-indigo-600">
						<span>Materi & Modul</span><span class="text-[10px] text-slate-400">Belajar</span>
					</a>
					<a href="{{ route('siswa.tugas') }}" class="flex items-center justify-between rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-600 transition-colors hover:bg-indigo-50 hover:text-indigo-600">
						<span>Tugas Siswa</span><span class="text-[10px] text-slate-400">Evaluasi</span>
					</a>
				</div>
			</details>
			<a href="{{ route('siswa.profile') }}" class="inline-flex items-center gap-2 rounded-xl {{ request()->routeIs('siswa.profile*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} px-4 py-2.5 text-sm font-medium transition-colors hover:bg-indigo-50 hover:text-indigo-600 focus:bg-indigo-50 focus:text-indigo-600">
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<circle cx="12" cy="7" r="3.5"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 21v-1.5a5.5 5.5 0 0 1 11 0V21"/>
				</svg>
				Profile
			</a>

			<a href="{{ route('siswa.pengaturan') }}" class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ request()->routeIs('siswa.pengaturan') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} transition-colors hover:bg-indigo-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/30" aria-label="Buka pengaturan" title="Pengaturan">
				<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 2.37c.94 1.543-.826 3.31-2.37 0a1.724 1.724 0 00-2.573 0a1.724 1.724 0 00-2.573 1.066c-.94 1.543-.826 3.31 2.37 2.37a1.724 1.724 0 001.065-2.572c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426-1.756-2.924-1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-.826 3.31-2.37 2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
				</svg>
			</a>
        </nav>
	</div>
</header>

@include('components.headerSiswa')
