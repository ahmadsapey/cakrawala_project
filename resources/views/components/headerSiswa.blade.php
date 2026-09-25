<header class="sticky top-0 z-50 border-b border-slate-200/80 bg-[#F8FAFC]/95 backdrop-blur-md md:hidden">
	<div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6 sm:px-8 lg:px-12">
		<a href="{{ url('/') }}" class="flex items-center gap-3" aria-label="Cakrawala - Beranda">
			<img src="{{ $brandContent?->image_url ?? asset('images/logoCakrawala.png') }}" alt="Logo {{ $brandContent?->title ?? 'Cakrawala' }}" class="h-10 w-10 object-contain">
			<span class="text-xl font-bold tracking-tight text-indigo-600">{{ $brandContent?->title ?? 'Cakrawala' }}</span>
		</a>

		<a href="{{ route('siswa.pengaturan') }}" class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition-colors hover:bg-indigo-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/30" aria-label="Buka pengaturan" title="Pengaturan">
			<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
			</svg>
		</a>
	</div>
</header>
