<footer class="hidden border-t border-slate-200 bg-white md:block">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 text-xs text-slate-500 sm:px-8 lg:px-12">
        <p>&copy; {{ date('Y') }} Cakrawala Educentre. Semua Hak Dilindungi.</p>
        <nav class="flex items-center gap-5" aria-label="Navigasi footer siswa">
            <a href="{{ route('siswa.home') }}" class="transition-colors hover:text-indigo-600">Beranda</a>
            <a href="{{ route('siswa.kelas') }}" class="transition-colors hover:text-indigo-600">Kelas</a>
            <a href="{{ route('siswa.materi') }}" class="transition-colors hover:text-indigo-600">Materi</a>
            <a href="{{ route('siswa.profile') }}" class="transition-colors hover:text-indigo-600">Profile</a>
        </nav>
    </div>
</footer>
