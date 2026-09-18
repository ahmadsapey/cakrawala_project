<footer class="hidden border-t border-slate-200 bg-white md:block">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-5 text-xs text-slate-500 sm:px-6">
        <p>&copy; {{ date('Y') }} Cakrawala Educentre. Semua Hak Dilindungi.</p>
        <nav class="flex items-center gap-5" aria-label="Navigasi footer guru">
            <a href="{{ route('guru.home') }}" class="transition-colors hover:text-indigo-600">Beranda</a>
            <a href="{{ route('guru.kelas') }}" class="transition-colors hover:text-indigo-600">Kelas</a>
            <a href="{{ route('guru.bahan-ajar') }}" class="transition-colors hover:text-indigo-600">Materi</a>
            <a href="{{ route('guru.koreksi.tugas') }}" class="transition-colors hover:text-indigo-600">Koreksi</a>
        </nav>
    </div>
</footer>
