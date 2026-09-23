<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-sm transition-all">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 min-h-20 flex flex-wrap items-center justify-between gap-4 py-3">
        <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0" aria-label="Cakrawala Educentre - Beranda">
            <img src="{{ asset('storage/logoCakrawala.png') }}" alt="Logo Cakrawala Educentre" class="w-11 h-11 object-contain">
            <div>
                <span class="block text-sm font-extrabold tracking-wide text-slate-900 uppercase">Cakrawala Educentre</span>
                <span class="block text-[10px] font-bold text-indigo-600 tracking-wider">MITRA BELAJAR TERINTEGRASI</span>
            </div>
        </a>

        <nav aria-label="Navigasi utama" class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm font-semibold text-slate-600">
            <a href="{{ url('/') }}" class="px-3 py-2 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                Beranda
            </a>

            <details class="relative group">
                <summary class="list-none cursor-pointer px-3 py-2 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition-colors inline-flex items-center gap-1">
                    <span>Layanan Kami</span>
                    <svg class="w-4 h-4 transition-transform group-open:rotate-180 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                    </svg>
                </summary>
                <div class="absolute right-0 mt-2 w-64 rounded-2xl border border-slate-200 bg-white p-2 shadow-2xl z-50">
                    <a href="{{ url('/') }}#layanan" class="block rounded-xl px-3 py-2.5 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                        <p class="font-extrabold text-xs text-slate-900">Les Privat (Online/Offline)</p>
                        <p class="text-[11px] text-slate-500 font-medium">Bimbingan 1-on-1 bersama tutor pilihan</p>
                    </a>
                    <a href="{{ url('/') }}#layanan" class="block rounded-xl px-3 py-2.5 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                        <p class="font-extrabold text-xs text-slate-900">Bimbingan Belajar (Bimbel)</p>
                        <p class="text-[11px] text-slate-500 font-medium">Kelas intensif kurikulum & UTBK-SNBT</p>
                    </a>
                    <a href="{{ url('/') }}#layanan" class="block rounded-xl px-3 py-2.5 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                        <p class="font-extrabold text-xs text-slate-900">Vendor & Mitra Sekolah</p>
                        <p class="text-[11px] text-slate-500 font-medium">Tryout CBT & Event MAN Insan Cendikia</p>
                    </a>
                    <a href="{{ url('/') }}#layanan" class="block rounded-xl px-3 py-2.5 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                        <p class="font-extrabold text-xs text-slate-900">Calistung & Pendalaman</p>
                        <p class="text-[11px] text-slate-500 font-medium">Fondasi dasar hingga materi esensial</p>
                    </a>
                </div>
            </details>

            <a href="{{ route('landing.tentang') }}" class="px-3 py-2 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                Tentang Kami
            </a>
            <a href="{{ url('/') }}#contact" class="px-3 py-2 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                Kontak
            </a>
            <a href="{{ route('siswa.login') }}" class="ml-2 inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-xs font-extrabold text-white shadow-sm hover:bg-indigo-700 transition-all">
                Portal LMS &rarr;
            </a>
        </nav>
    </div>
</header>
