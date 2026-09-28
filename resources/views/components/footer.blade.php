@php
    $footerContent = $footerContent ?? null;
    $themeContent = $themeContent ?? null;
    $theme = $themeContent?->features ?? [
        'body_bg' => $themeContent?->badge ?? '#F8FAFC',
        'body_text' => $themeContent?->meta ?? '#1E293B',
        'cta_bg' => $themeContent?->price ?? '#0B0F19',
        'cta_text' => $themeContent?->price_suffix ?? '#FFFFFF',
        'footer_bg' => $themeContent?->cta_label ?? '#080B13',
        'footer_text' => $themeContent?->image_url ?? '#94A3B8',
    ];
    $footerBg = $theme['footer_bg'] ?? '#080B13';
    $footerText = $theme['footer_text'] ?? '#94A3B8';
@endphp

<footer id="contact" class="text-xs py-16 border-t border-slate-800/80 transition-colors duration-300" style="background-color: {{ $footerBg }}; color: {{ $footerText }};">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-slate-800/80">
            <div class="space-y-4">
                <h4 class="font-bold text-sm" style="color: {{ $footerText }}; filter: brightness(1.25);">{{ $footerContent?->title ?? 'Cakrawala PT. INDO PRESTASI UTAMA' }}</h4>
                <p class="text-xs leading-relaxed opacity-80" style="color: {{ $footerText }};">
                    {{ $footerContent?->description ?? 'Pusat layanan konsultasi belajar, tryout online, dan pendampingan akademik terpercaya di Indonesia dengan standar mutu terbaik.' }}
                </p>
            </div>
            <div class="space-y-3">
                <h5 class="font-bold tracking-wider text-xs uppercase" style="color: {{ $footerText }}; filter: brightness(1.25);">LAYANAN</h5>
                <ul class="space-y-2 text-xs opacity-90">
                    <li><a href="{{ url('/') }}#pricing" class="hover:underline transition-colors">Paket Belajar</a></li>
                    <li><a href="{{ url('/') }}#pricing" class="hover:underline transition-colors">Bimbingan Belajar</a></li>
                    <li><a href="{{ url('/') }}#pricing" class="hover:underline transition-colors">Rasionalisasi SNBP</a></li>
                    <li><a href="{{ url('/') }}#pricing" class="hover:underline transition-colors">Akademik Webinar</a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <h5 class="font-bold tracking-wider text-xs uppercase" style="color: {{ $footerText }}; filter: brightness(1.25);">PERUSAHAAN</h5>
                <ul class="space-y-2 text-xs opacity-90">
                    <li><a href="{{ url('/') }}#about" class="hover:underline transition-colors">Tentang Cakrawala</a></li>
                    <li><a href="mailto:info@cakrawala.id" class="hover:underline transition-colors">Pusat Bantuan</a></li>
                    <li><a href="{{ url('/') }}#about" class="hover:underline transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="{{ url('/') }}" class="hover:underline transition-colors">Peta Situs</a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <h5 class="font-bold tracking-wider text-xs uppercase" style="color: {{ $footerText }}; filter: brightness(1.25);">HUBUNGI KAMI</h5>
                <ul class="space-y-2 text-xs opacity-90">
                    <li><a href="mailto:{{ $footerContent?->meta ?? 'info@cakrawala.id' }}" class="hover:underline transition-colors">{{ $footerContent?->meta ?? 'info@cakrawala.id' }}</a></li>
                    <li><a href="tel:{{ $footerContent?->cta_label ?? '+6281234567890' }}" class="hover:underline transition-colors">{{ $footerContent?->cta_label ?? '+62 812-3456-7890' }}</a></li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-between pt-8 text-xs opacity-80" style="color: {{ $footerText }};">
            <p>&copy; {{ date('Y') }} {{ $brandContent?->title ?? 'Cakrawala Educentre' }}. Semua Hak Dilindungi.</p>
            <div class="flex space-x-6 mt-4 sm:mt-0">
                <a href="{{ url('/') }}#about" class="hover:underline">Kebijakan Cookie</a>
                <a href="{{ url('/') }}#about" class="hover:underline">Syarat &amp; Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
