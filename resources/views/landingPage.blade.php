<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rasionalisasi Prodi SNBP | Cakrawala Educentre</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        branddark: '#0B0F19',
                    }
                }
            }
        }
    </script>
    <style>
        /* Sembunyikan scrollbar untuk tampilan card bergulir yang bersih */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .neon-card {
            transition: border-color 300ms ease, box-shadow 300ms ease, transform 300ms ease;
        }

        .neon-card:hover,
        .neon-card:focus-within,
        .neon-card:active {
            border-color: #38bdf8;
            box-shadow: 0 0 0 1px #38bdf8, 0 0 18px rgba(14, 165, 233, 0.48), 0 0 36px rgba(37, 99, 235, 0.3);
        }
    </style>
    @include('components.fonts')
</head>
@php
    $hero = $contents->get('hero', collect())->first();
    $sections = $contents->get('section', collect());
    $pricingSection = $sections->firstWhere('sort_order', 1);
    $cta = $contents->get('cta', collect())->first();
    $featureImages = $programs->filter(fn ($program) => filled($program->image_url))->values();
    $themeContent = $themeContent ?? $contents->get('theme', collect())->first();

    $theme = $themeContent?->features ?? [
        'body_bg' => $themeContent?->badge ?? '#F8FAFC',
        'body_text' => $themeContent?->meta ?? '#1E293B',
        'header_bg' => '#FFFFFF',
        'header_text' => '#1E293B',
        'card_bg' => '#FFFFFF',
        'card_text' => '#0F172A',
        'cta_bg' => $themeContent?->price ?? '#0B0F19',
        'cta_text' => $themeContent?->price_suffix ?? '#FFFFFF',
        'footer_bg' => $themeContent?->cta_label ?? '#080B13',
        'footer_text' => $themeContent?->image_url ?? '#94A3B8',
    ];
    $bodyBg = $theme['body_bg'] ?? '#F8FAFC';
    $bodyText = $theme['body_text'] ?? '#1E293B';
    $headerBg = $theme['header_bg'] ?? '#FFFFFF';
    $headerText = $theme['header_text'] ?? '#1E293B';
    $cardBg = $theme['card_bg'] ?? '#FFFFFF';
    $cardText = $theme['card_text'] ?? '#0F172A';
    $ctaBg = $theme['cta_bg'] ?? '#0B0F19';
    $ctaText = $theme['cta_text'] ?? '#FFFFFF';
    $footerBg = $theme['footer_bg'] ?? '#080B13';
    $footerText = $theme['footer_text'] ?? '#94A3B8';
@endphp

<body style="background-color: {{ $bodyBg }}; color: {{ $bodyText }}; min-height: 100vh;" class="font-sans antialiased selection:bg-indigo-500 selection:text-white transition-colors duration-300">

    @include('components.header', ['headerBg' => $headerBg, 'headerText' => $headerText, 'brandContent' => $brandContent ?? null])

    <!-- Hero Section dengan Auto-Scroll Colosal Cards -->
    <section class="relative pt-10 pb-16 lg:pt-20 lg:pb-28 overflow-hidden transition-colors duration-300" style="background-color: {{ $bodyBg }}; color: {{ $bodyText }};">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Kolom Kiri: Teks & Statistik -->
                <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 bg-indigo-50 border border-indigo-100 px-3.5 py-1.5 rounded-full text-indigo-600 text-xs font-semibold tracking-wide mx-auto lg:mx-0">
                        <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                        <span class="uppercase">{{ $hero?->badge ?? 'Pilihan Belajar Terbaik di Indonesia' }}</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.15]" style="color: {{ $bodyText }};">
                        {{ $hero?->title ?? 'Belajar Lebih Mudah dengan Cakrawala Educentre' }}
                    </h1>

                    <p class="text-base sm:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed opacity-85" style="color: {{ $bodyText }};">
                        {{ $hero?->description ?? 'Temukan cara belajar efektif, interaktif, dan fleksibel untuk menguasai berbagai materi pelajaran sesuai impianmu.' }}
                    </p>

                    
                </div>

                <!-- Kolom Kanan: Colosal Cards Bergulir Otomatis setiap 3 Detik (Hero) -->
                <div class="lg:col-span-6 relative w-full">
                    <div class="flex items-center justify-between mb-4 px-2">
                        <span class="text-xs font-bold uppercase tracking-wider opacity-75" style="color: {{ $bodyText }};">Program & Modul Pilihan</span>
                    </div>
                    
                    <div id="autoScrollHero" class="flex space-x-5 overflow-x-auto no-scrollbar pb-6 pt-2 snap-x snap-mandatory px-2 scroll-smooth-container">
                        @foreach ($programs as $program)
                            <article class="neon-card min-w-[300px] sm:min-w-[300px] p-5 rounded-3xl border border-slate-200/80 shadow-xl snap-start flex-shrink-0 transition-colors duration-300" style="background-color: {{ $cardBg }}; color: {{ $cardText }};">
                                @if ($program->image_url)
                                    <div class="h-36 bg-slate-100 rounded-2xl mb-4 overflow-hidden">
                                        <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <span class="text-[10px] uppercase font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md tracking-wider">{{ $program->badge }}</span>
                                <h4 class="font-bold text-base mt-2" style="color: {{ $cardText }};">{{ $program->title }}</h4>
                                <p class="text-xs mt-1.5 leading-relaxed opacity-80" style="color: {{ $cardText }};">{{ $program->description }}</p>
                                <div class="flex items-center space-x-2 text-xs mt-2 opacity-75" style="color: {{ $cardText }};">
                                    <span>{{ $program->meta }}</span>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs">
                                    <span class="opacity-75" style="color: {{ $cardText }};">{{ $program->price }}{{ $program->price_suffix }}</span>
                                    <span class="w-5 h-5 rounded-full bg-blue-50 text-indigo-600 flex items-center justify-center font-bold text-xs">✓</span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Pricing Section: Diubah Menjadi Colossal Grid yang Bergulir Otomatis Setiap 3 Detik -->
    <section id="pricing" class="py-24 border-y border-slate-200/60 transition-colors duration-300" style="background-color: {{ $bodyBg }}; color: {{ $bodyText }};">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            
            <div class="text-center max-w-2xl mx-auto space-y-3 mb-12">
                <span class="text-xs uppercase font-bold tracking-widest text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">{{ $pricingSection?->badge ?? 'ONLINE SCHEDULE' }}</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold" style="color: {{ $bodyText }};">{{ $pricingSection?->title ?? 'Cakrawala Educentre' }}</h2>
                <h3 class="text-base font-bold tracking-wide uppercase opacity-90" style="color: {{ $bodyText }};">{{ $pricingSection?->meta ?? 'PT. INDO PRESTASI UTAMA' }}</h3>
                <p class="text-sm leading-relaxed opacity-80" style="color: {{ $bodyText }};">{{ $pricingSection?->description ?? 'Pilihan tepat untuk mendampingi proses belajar dengan sistem terbaik dan kurikulum mutakhir dari Cakrawala Educentre.' }}</p>
            </div>

            <!-- Header Kecil Penanda Auto-Scroll Pricing -->
            <div class="flex items-center justify-between mb-4 px-2 max-w-6xl mx-auto">
                <span class="text-xs font-bold uppercase tracking-wider opacity-75" style="color: {{ $bodyText }};">Geser & Pilih Paket Layanan</span>
            </div>

            <!-- Pricing Colossal Container: Bergulir Otomatis (Auto-Scroll) & Rapi Tanpa Memanjang ke Bawah -->
            <div id="autoScrollPricing" class="flex space-x-6 overflow-x-auto no-scrollbar pb-8 pt-2 snap-x snap-mandatory px-2 scroll-smooth-container max-w-6xl mx-auto">
                @foreach ($packages as $package)
                    <article class="neon-card min-w-[280px] sm:min-w-[300px] lg:min-w-[270px] rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 snap-start flex-shrink-0 flex flex-col justify-between" style="background-color: {{ $package->is_featured ? '#4F46E5' : $cardBg }}; color: {{ $package->is_featured ? '#FFFFFF' : $cardText }};">
                        <div>
                            <span class="text-[10px] uppercase font-bold tracking-wider {{ $package->is_featured ? 'text-indigo-100 bg-white/10' : 'text-indigo-600 bg-indigo-50' }} px-2.5 py-1 rounded-md">{{ $package->badge }}</span>
                            <h4 class="font-bold text-base mt-4" style="color: {{ $package->is_featured ? '#FFFFFF' : $cardText }};">{{ $package->title }}</h4>
                            <p class="text-xs leading-relaxed mt-2 mb-5 opacity-85" style="color: {{ $package->is_featured ? '#E0E7FF' : $cardText }};">{{ $package->description }}</p>
                            <div class="mb-5">
                                <span class="text-[10px] opacity-75 block mb-0.5" style="color: {{ $package->is_featured ? '#E0E7FF' : $cardText }};">Mulai dari</span>
                                <span class="text-xl font-black" style="color: {{ $package->is_featured ? '#FFFFFF' : $cardText }};">{{ $package->price }}<span class="text-xs font-normal opacity-80">{{ $package->price_suffix }}</span></span>
                            </div>
                            <ul class="space-y-2.5 mb-6 text-xs opacity-90">
                                @foreach ($package->features ?? [] as $feature)
                                    <li class="flex items-center space-x-2" style="color: {{ $package->is_featured ? '#FFFFFF' : $cardText }};"><span class="{{ $package->is_featured ? 'text-white' : 'text-indigo-600' }} font-bold">✓</span><span>{{ $feature }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('siswa.home') }}" class="w-full py-3 rounded-xl {{ $package->is_featured ? 'bg-white text-indigo-600 hover:bg-slate-50 font-bold' : 'border border-slate-200 hover:border-indigo-600 font-medium' }} text-xs text-center transition-colors" style="color: {{ $package->is_featured ? '#4F46E5' : $cardText }};">
                            {{ $package->cta_label }}
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Visual Feature Section -->
    <section id="about" class="py-16 sm:py-24 transition-colors duration-300" style="background-color: {{ $bodyBg }}; color: {{ $bodyText }};">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
            <div id="autoScrollVisual" class="flex snap-x snap-mandatory gap-5 overflow-x-auto scroll-smooth pb-3 no-scrollbar">
                @forelse ($featureImages as $imageProgram)
                    <div class="relative h-[300px] min-w-full snap-start overflow-hidden rounded-[2rem] bg-slate-200 shadow-2xl sm:h-[420px] lg:h-[520px]">
                        <img src="{{ $imageProgram->image_url }}" alt="{{ $imageProgram->title }}" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-7 text-white sm:p-12">
                            <p class="text-xs font-black uppercase tracking-[0.2em] text-indigo-200">Cakrawala Educentre</p>
                            <h2 class="mt-2 max-w-2xl text-3xl font-black tracking-tight sm:text-5xl">{{ $imageProgram->title }}</h2>
                        </div>
                    </div>
                @empty
                    <div class="relative h-[300px] min-w-full snap-start overflow-hidden rounded-[2rem] bg-slate-200 shadow-2xl sm:h-[420px] lg:h-[520px]">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1800&q=85" alt="Cakrawala Educentre" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-7 text-white sm:p-12">
                            <p class="text-xs font-black uppercase tracking-[0.2em] text-indigo-200">Cakrawala Educentre</p>
                            <h2 class="mt-2 max-w-2xl text-3xl font-black tracking-tight sm:text-5xl">Belajar dengan ruang untuk tumbuh.</h2>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="py-16 transition-colors duration-300" style="background-color: {{ $bodyBg }}; color: {{ $bodyText }};">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="neon-card rounded-3xl p-10 sm:p-14 text-center relative overflow-hidden shadow-2xl transition-colors duration-300" style="background-color: {{ $ctaBg }}; color: {{ $ctaText }};">
                <div class="absolute -top-24 -left-24 w-80 h-80 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-purple-500/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <h3 class="text-2xl sm:text-3xl font-black tracking-tight mb-4" style="color: {{ $ctaText }};">
                    {{ $cta?->title ?? 'Siap Naikkan Prestasi Akademikmu di Cakrawala?' }}
                </h3>
                <p class="text-sm sm:text-base max-w-xl mx-auto mb-8 leading-relaxed opacity-90" style="color: {{ $ctaText }};">
                    {{ $cta?->description ?? 'Kombinasi bimbingan, sistem, dan tutor terbaik siap membantumu meraih cita-cita masuk kampus impian lewat Cakrawala Educentre.' }}
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('siswa.home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-7 py-3.5 rounded-xl shadow-lg transition-transform hover:-translate-y-0.5">
                        {{ $cta?->cta_label ?? 'Mulai Konsultasi Sekarang' }}
                    </a>
                    <a href="{{ $cta?->meta ?? 'https://wa.me/6281234567890' }}" target="_blank" rel="noopener" class="bg-white/10 hover:bg-white/20 text-white font-medium text-sm px-7 py-3.5 rounded-xl transition-colors">
                        Hubungi WhatsApp Konsultan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript untuk Auto-Scroll Otomatis Hero & Pricing setiap 3 Detik -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function setupAutoScroll(containerId, scrollAmount = 300, intervalTime = 3000) {
                const container = document.getElementById(containerId);
                if (!container) return;

                let scrollInterval;

                function startScrolling() {
                    scrollInterval = setInterval(() => {
                        if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                            container.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            container.scrollBy({ left: scrollAmount || container.clientWidth, behavior: 'smooth' });
                        }
                    }, intervalTime);
                }

                startScrolling();

                container.addEventListener("mouseenter", () => clearInterval(scrollInterval));
                container.addEventListener("mouseleave", () => startScrolling());
            }

            setupAutoScroll("autoScrollHero", 320, 3000);
            setupAutoScroll("autoScrollPricing", 290, 3000);
            setupAutoScroll("autoScrollVisual", 0, 3000);
        });
    </script>

    @include('components.footer', ['footerContent' => $footerContent, 'themeContent' => $themeContent, 'brandContent' => $brandContent ?? null])

</body>
</html>