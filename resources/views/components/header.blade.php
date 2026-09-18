<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm transition-all">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 min-h-20 flex flex-wrap items-center justify-between gap-4 py-3">
        <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0" aria-label="Cakrawala Educentre - Beranda">
            <img src="{{ asset('storage/logoCakrawala.png') }}" alt="Logo Cakrawala Educentre" class="w-12 h-12 object-contain">
            <span class="hidden sm:block text-sm font-bold tracking-wide text-slate-800 uppercase">Cakrawala Educentre</span>
        </a>

        <nav aria-label="Navigasi utama" class="flex items-center gap-1 sm:gap-2 text-sm font-medium text-slate-600">
            <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors">
                Beranda
            </a>

            <details class="relative group">
                <summary class="list-none cursor-pointer px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors">
                    <span class="inline-flex items-center gap-1">
                        Layanan
                        <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                        </svg>
                    </span>
                </summary>
                <div class="absolute right-0 mt-2 w-56 rounded-xl border border-slate-100 bg-white p-2 shadow-xl shadow-blue-100/60">
                    <a href="{{ url('/') }}#pricing" class="block rounded-lg px-3 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                        Paket Belajar
                    </a>
                    <a href="{{ url('/') }}#pricing" class="block rounded-lg px-3 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                        Bimbingan Intensif
                    </a>
                    <a href="{{ url('/') }}#pricing" class="block rounded-lg px-3 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                        Tryout Nasional
                    </a>
                    <a href="{{ url('/') }}#pricing" class="block rounded-lg px-3 py-2.5 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                        Konsultasi Privat
                    </a>
                </div>
            </details>

            <a href="{{ url('/') }}#about" class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors">
                Tentang
            </a>
            <a href="{{ url('/') }}#contact" class="px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-colors">
                Kontak
            </a>
        </nav>
    </div>
</header>
