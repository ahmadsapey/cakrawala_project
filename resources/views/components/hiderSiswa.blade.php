<header class="sticky top-0 z-50 hidden border-b border-slate-200/80 bg-[#F8FAFC]/95 backdrop-blur-md md:block">
	<div class="mx-auto flex min-h-20 max-w-7xl items-center gap-8 px-6 py-3 sm:px-8 lg:px-12">
		<a href="{{ url('/') }}" class="flex shrink-0 items-center gap-3" aria-label="Cakrawala - Beranda">
			<img src="{{ asset('storage/logoCakrawala.png') }}" alt="Logo Cakrawala" class="h-10 w-10 object-contain">
			<span class="text-xl font-bold tracking-tight text-indigo-600">Cakrawala</span>
		</a>

		<nav class="ml-auto flex flex-1 items-center justify-end gap-1" aria-label="Navigasi siswa">
			<a href="{{ route('siswa.home') }}" class="inline-flex items-center gap-1.5 rounded-xl {{ request()->routeIs('siswa.home') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} px-3 py-2 text-sm font-medium transition-colors" @if (request()->routeIs('siswa.home')) aria-current="page" @endif>
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9Z"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 21v-6h6v6"/>
				</svg>
				Beranda
			</a>
			<a href="{{ route('siswa.kelas') }}" class="inline-flex items-center gap-1.5 rounded-xl {{ request()->routeIs('siswa.kelas*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} px-3 py-2 text-sm font-medium transition-colors">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<rect width="13" height="9" x="3" y="7" rx="2"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m16 10 5-3v10l-5-3"/>
				</svg>
				Kelas
			</a>
			<a href="{{ route('siswa.materi') }}" class="inline-flex items-center gap-1.5 rounded-xl {{ request()->routeIs('siswa.materi') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} px-3 py-2 text-sm font-medium transition-colors">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
				</svg>
				Modul & Bank Soal
			</a>
			<a href="{{ route('siswa.tryout') }}" class="inline-flex items-center gap-1.5 rounded-xl {{ request()->routeIs('siswa.tryout*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} px-3 py-2 text-sm font-medium transition-colors">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
				</svg>
				Tryout CBT
				<span class="rounded-full bg-emerald-100 px-1.5 py-0.5 text-[10px] font-bold text-emerald-700">MAN IC</span>
			</a>
			<a href="{{ route('siswa.jadwal') }}" class="inline-flex items-center gap-1.5 rounded-xl {{ request()->routeIs('siswa.jadwal') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} px-3 py-2 text-sm font-medium transition-colors">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
				</svg>
				Jadwal
			</a>
			<a href="{{ route('siswa.tugas') }}" class="inline-flex items-center gap-1.5 rounded-xl {{ request()->routeIs('siswa.tugas') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} px-3 py-2 text-sm font-medium transition-colors">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
				</svg>
				Tugas & Kuis
			</a>
			<a href="{{ route('siswa.payment.create') }}" class="inline-flex items-center gap-1.5 rounded-xl {{ request()->routeIs('siswa.payment*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} px-3 py-2 text-sm font-medium transition-colors">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
				</svg>
				Pembayaran
			</a>
			<a href="{{ route('siswa.profile') }}" class="inline-flex items-center gap-1.5 rounded-xl {{ request()->routeIs('siswa.profile*') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }} px-3 py-2 text-sm font-medium transition-colors">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<circle cx="12" cy="7" r="3.5"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 21v-1.5a5.5 5.5 0 0 1 11 0V21"/>
				</svg>
				Profil
			</a>

			<a href="{{ route('siswa.pengaturan') }}" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl {{ request()->routeIs('siswa.pengaturan') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500' }} transition-colors hover:bg-indigo-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/30" aria-label="Buka pengaturan" title="Pengaturan">
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 001.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
				</svg>
			</a>
		</nav>
	</div>
</header>

@include('components.headerSiswa')
