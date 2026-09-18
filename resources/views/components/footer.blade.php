<footer id="contact" class="bg-[#080B13] text-slate-400 text-xs py-16 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-slate-800/80">
            <div class="space-y-4">
                <h4 class="font-bold text-white text-sm">Cakrawala PT. INDO PRESTASI UTAMA</h4>
                <p class="text-slate-500 text-xs leading-relaxed">
                    Pusat layanan konsultasi belajar, tryout online, dan pendampingan akademik terpercaya di Indonesia dengan standar mutu terbaik.
                </p>
            </div>
            <div class="space-y-3">
                <h5 class="font-bold text-white tracking-wider text-xs uppercase">LAYANAN</h5>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ url('/') }}#pricing" class="hover:text-white transition-colors">Paket Belajar</a></li>
                    <li><a href="{{ url('/') }}#pricing" class="hover:text-white transition-colors">Bimbingan Belajar</a></li>
                    <li><a href="{{ url('/') }}#pricing" class="hover:text-white transition-colors">Rasionalisasi SNBP</a></li>
                    <li><a href="{{ url('/') }}#pricing" class="hover:text-white transition-colors">Akademik Webinar</a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <h5 class="font-bold text-white tracking-wider text-xs uppercase">PERUSAHAAN</h5>
                <ul class="space-y-2 text-xs">
                        <li><a href="{{ url('/') }}#about" class="hover:text-white transition-colors">Tentang Cakrawala</a></li>
                        <li><a href="mailto:info@cakrawala.id" class="hover:text-white transition-colors">Pusat Bantuan</a></li>
                        <li><a href="{{ url('/') }}#about" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="{{ url('/') }}" class="hover:text-white transition-colors">Peta Situs</a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <h5 class="font-bold text-white tracking-wider text-xs uppercase">HUBUNGI KAMI</h5>
                <ul class="space-y-2 text-xs">
                        <li><a href="mailto:info@cakrawala.id" class="hover:text-white transition-colors">info@cakrawala.id</a></li>
                        <li><a href="tel:+6281234567890" class="hover:text-white transition-colors">+62 812-3456-7890</a></li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-between pt-8 text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} Cakrawala Educentre. Semua Hak Dilindungi.</p>
            <div class="flex space-x-6 mt-4 sm:mt-0">
                    <a href="{{ url('/') }}#about" class="hover:text-slate-300">Kebijakan Cookie</a>
                    <a href="{{ url('/') }}#about" class="hover:text-slate-300">Syarat &amp; Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
