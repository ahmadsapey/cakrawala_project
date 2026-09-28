<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Landing Page | Cakrawala Educentre</title>
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
    @include('components.fonts')
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50/50 via-slate-50 to-blue-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">
    
    <!-- Header Maintenance / Content Manager -->
    <header class="border-b-2 border-indigo-200 bg-white/90 backdrop-blur-md sticky top-0 z-40">
        <div class="mx-auto flex min-h-20 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-12">
            <a href="{{ route('maintenance.landing.index') }}" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl border-2 border-indigo-200 bg-indigo-50 text-base font-black text-indigo-700 shadow-2xs">C</span>
                <span>
                    <span class="block text-sm font-black tracking-tight text-slate-900">Cakrawala Maintenance</span>
                    <span class="block text-[10px] font-black uppercase tracking-[0.16em] text-slate-400">Landing Content Manager</span>
                </span>
            </a>
            <a href="{{ route('landing.page') }}" target="_blank" rel="noopener" 
                class="rounded-2xl border-2 border-indigo-200 bg-indigo-50 px-4 py-2.5 text-xs font-black text-indigo-700 hover:bg-indigo-100 transition-all inline-flex items-center gap-1.5 shadow-2xs">
                Buka Website <span>↗</span>
            </a>
        </div>
    </header>

    <main class="mx-auto flex w-full max-w-7xl flex-col gap-6 px-4 py-8 sm:px-6 lg:px-12">
        
        <!-- Header Halaman -->
        <header class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 sm:p-8 shadow-sm">
            <div>
                <span class="inline-block rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-black uppercase tracking-[0.18em] text-indigo-700 shadow-2xs">Konten Website</span>
                <h1 class="mt-3 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Kelola Landing Page</h1>
                <p class="mt-1 text-xs sm:text-sm font-bold text-slate-600">Edit semua teks, kartu program, paket, harga, gambar, dan CTA yang tampil di halaman depan.</p>
            </div>
            <a href="{{ route('landing.page') }}" target="_blank" rel="noopener" 
                class="rounded-2xl border-2 border-indigo-200 bg-indigo-50 px-5 py-3 text-center text-xs font-black text-indigo-700 hover:bg-indigo-100 transition-all inline-flex items-center justify-center gap-2 shrink-0">
                Lihat Landing Page <span aria-hidden="true">↗</span>
            </a>
        </header>

        @if (session('status'))
            <div class="rounded-2xl border-2 border-emerald-300 bg-emerald-50 px-5 py-4 text-xs sm:text-sm font-bold text-emerald-800 shadow-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl border-2 border-rose-300 bg-rose-50 px-5 py-4 text-xs sm:text-sm font-bold text-rose-800 shadow-sm">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $layers = [
                'hero' => ['label' => 'Layer 1 · Hero + Program & Modul', 'description' => 'Pilihan belajar utama dan kartu program yang tampil di hero.'],
                'package' => ['label' => 'Layer 2 · Online Schedule + Paket', 'description' => 'Judul schedule, harga, fitur, dan paket belajar.'],
                'visual' => ['label' => 'Layer 3 · Colossal Gambar', 'description' => 'Kumpulan gambar besar yang bergulir otomatis.'],
                'cta' => ['label' => 'Layer 4 · CTA Prestasi', 'description' => 'Ajakan terakhir untuk menaikkan prestasi.'],
                'footer' => ['label' => 'Layer 5 · Footer', 'description' => 'Identitas dan kontak utama pada bagian paling bawah.'],
            ];
            $groupedContents = $contents->groupBy('type');
        @endphp

        @if ($brandContent)
            <section>
                <a href="{{ route('maintenance.landing.edit', $brandContent) }}" class="group flex flex-col gap-4 rounded-3xl border-2 border-amber-200 bg-amber-50/70 p-5 shadow-sm transition-all hover:-translate-y-1 hover:border-amber-400 hover:shadow-md sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border-2 border-amber-200 bg-white p-2">
                            <img src="{{ $brandContent->image_url }}" alt="Logo {{ $brandContent->title }}" class="max-h-full max-w-full object-contain">
                        </div>
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-[0.16em] text-amber-700">Identitas global</p>
                            <h2 class="mt-1 text-base font-black text-slate-900">{{ $brandContent->title }}</h2>
                            <p class="mt-1 text-xs font-semibold text-slate-600">Logo dan nama ini dipakai di semua modul.</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-2 rounded-xl bg-amber-600 px-4 py-2.5 text-xs font-black text-white transition group-hover:bg-amber-700">Edit logo & nama <span aria-hidden="true">→</span></span>
                </a>
            </section>
        @endif

        <!-- Card Pengaturan Warna Landing Page (Body, Header, Card, CTA Banner, Footer) -->
        @php
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

        <section class="rounded-3xl border-2 border-indigo-200 bg-white/95 backdrop-blur-md p-6 sm:p-8 shadow-sm">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 border-b border-slate-100 pb-5 mb-6">
                <div>
                    <span class="inline-block rounded-xl border border-indigo-200 bg-indigo-50 px-3 py-1 text-xs font-black uppercase tracking-[0.16em] text-indigo-700 shadow-2xs">Warna & Tampilan Global</span>
                    <h2 class="mt-2 text-xl font-black text-slate-900 tracking-tight">Pengaturan Warna Seluruh Landing Page</h2>
                    <p class="mt-1 text-xs sm:text-sm font-bold text-slate-500">Edit warna background halaman, header navigasi, teks utama, card program/paket, section CTA banner, dan footer secara dinamis.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('maintenance.landing.theme.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                    <!-- 1. Warna Background Body -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Background Halaman</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="body_bg_picker" value="{{ $bodyBg }}" oninput="syncColor('body_bg', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="body_bg" id="body_bg_text" value="{{ $bodyBg }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('body_bg', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Seluruh area landing</span>
                    </div>

                    <!-- 2. Warna Teks Body Utama -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Teks Utama Halaman</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="body_text_picker" value="{{ $bodyText }}" oninput="syncColor('body_text', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="body_text" id="body_text_text" value="{{ $bodyText }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('body_text', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Judul & paragraf utama</span>
                    </div>

                    <!-- 3. Warna Background Header -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Background Header</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="header_bg_picker" value="{{ $headerBg }}" oninput="syncColor('header_bg', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="header_bg" id="header_bg_text" value="{{ $headerBg }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('header_bg', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Header navigasi atas</span>
                    </div>

                    <!-- 4. Warna Teks Header -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Teks Header & Menu</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="header_text_picker" value="{{ $headerText }}" oninput="syncColor('header_text', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="header_text" id="header_text_text" value="{{ $headerText }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('header_text', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Menu & logo di header</span>
                    </div>

                    <!-- 5. Warna Background Card -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Background Card</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="card_bg_picker" value="{{ $cardBg }}" oninput="syncColor('card_bg', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="card_bg" id="card_bg_text" value="{{ $cardBg }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('card_bg', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Kartu program & paket</span>
                    </div>

                    <!-- 6. Warna Teks Card -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Teks Card</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="card_text_picker" value="{{ $cardText }}" oninput="syncColor('card_text', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="card_text" id="card_text_text" value="{{ $cardText }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('card_text', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Semua teks di dalam card</span>
                    </div>

                    <!-- 7. Warna Background CTA Banner -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Background CTA Banner</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="cta_bg_picker" value="{{ $ctaBg }}" oninput="syncColor('cta_bg', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="cta_bg" id="cta_bg_text" value="{{ $ctaBg }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('cta_bg', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Card CTA penutup</span>
                    </div>

                    <!-- 8. Warna Teks CTA Banner -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Teks CTA Banner</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="cta_text_picker" value="{{ $ctaText }}" oninput="syncColor('cta_text', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="cta_text" id="cta_text_text" value="{{ $ctaText }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('cta_text', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Judul & deskripsi CTA</span>
                    </div>

                    <!-- 9. Warna Background Footer -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Background Footer</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="footer_bg_picker" value="{{ $footerBg }}" oninput="syncColor('footer_bg', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="footer_bg" id="footer_bg_text" value="{{ $footerBg }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('footer_bg', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Area footer paling bawah</span>
                    </div>

                    <!-- 10. Warna Teks Footer -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4 transition-all hover:border-indigo-300">
                        <label class="block text-xs font-black text-slate-700 mb-2">Teks Footer</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="footer_text_picker" value="{{ $footerText }}" oninput="syncColor('footer_text', this.value)" class="h-10 w-12 cursor-pointer rounded-xl border-2 border-slate-200 bg-white p-1">
                            <input type="text" name="footer_text" id="footer_text_text" value="{{ $footerText }}" maxlength="7" pattern="^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$" oninput="syncColor('footer_text', this.value)" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-black tracking-wider uppercase text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        </div>
                        <span class="mt-1.5 block text-[11px] font-semibold text-slate-400">Kontak & link footer</span>
                    </div>
                </div>

                <!-- Live Mini Preview -->
                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-xs font-black uppercase tracking-wider text-slate-500 mb-3">Live Preview Tampilan Landing Page</p>

                    <!-- Header Preview Bar -->
                    <div id="preview_header" class="rounded-t-2xl p-3 flex items-center justify-between border-b border-slate-200/40 transition-colors duration-300" style="background-color: {{ $headerBg }}; color: {{ $headerText }};">
                        <span class="text-xs font-extrabold uppercase">Cakrawala Educentre</span>
                        <div class="flex gap-3 text-[11px] font-semibold">
                            <span>Layanan</span>
                            <span>Tentang</span>
                            <span>Virtual</span>
                        </div>
                    </div>

                    <div id="preview_body" class="rounded-b-2xl p-4 transition-colors duration-300 shadow-inner border border-slate-200/50 space-y-3" style="background-color: {{ $bodyBg }}; color: {{ $bodyText }};">
                        <div>
                            <p class="text-xs font-black" id="preview_body_title" style="color: {{ $bodyText }};">Judul Utama Landing Page</p>
                            <p class="text-[11px] font-semibold opacity-80 mt-0.5" style="color: {{ $bodyText }};">Teks utama landing page menyesuaikan pilihan warna.</p>
                        </div>
                        
                        <!-- Mini Card Preview -->
                        <div id="preview_card" class="rounded-xl p-3 transition-colors duration-300 shadow-sm border border-slate-200/40" style="background-color: {{ $cardBg }}; color: {{ $cardText }};">
                            <p class="text-xs font-black" id="preview_card_title" style="color: {{ $cardText }};">Kartu Program & Paket</p>
                            <p class="text-[10px] font-semibold opacity-80 mt-0.5" style="color: {{ $cardText }};">Teks dan latar di dalam kartu program & paket belajar.</p>
                        </div>

                        <!-- Mini CTA Banner Preview -->
                        <div id="preview_cta" class="rounded-xl p-3 text-center transition-colors duration-300 shadow-sm" style="background-color: {{ $ctaBg }}; color: {{ $ctaText }};">
                            <p class="text-xs font-black">Section CTA Banner</p>
                            <p class="text-[10px] font-semibold opacity-80">Siap Naikkan Prestasi Akademikmu?</p>
                        </div>

                        <!-- Mini Footer Preview -->
                        <div id="preview_footer" class="rounded-xl p-3 transition-colors duration-300 text-center" style="background-color: {{ $footerBg }}; color: {{ $footerText }};">
                            <p class="text-[11px] font-bold">Footer Section · Cakrawala Educentre</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" onclick="resetDefaultColors()" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-black text-slate-600 hover:bg-slate-100 transition-colors">
                        Reset Default
                    </button>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-xs font-black text-white shadow-md hover:bg-indigo-700 transition-all hover:shadow-indigo-200">
                        Simpan Warna Landing Page
                    </button>
                </div>
            </form>
        </section>

        <script>
            function syncColor(key, value) {
                if (!value.startsWith('#')) return;
                const picker = document.getElementById(key + '_picker');
                const text = document.getElementById(key + '_text');
                if (picker) picker.value = value;
                if (text) text.value = value;
                
                if (key === 'body_bg') {
                    document.getElementById('preview_body').style.backgroundColor = value;
                } else if (key === 'body_text') {
                    document.getElementById('preview_body').style.color = value;
                    document.getElementById('preview_body_title').style.color = value;
                } else if (key === 'header_bg') {
                    document.getElementById('preview_header').style.backgroundColor = value;
                } else if (key === 'header_text') {
                    document.getElementById('preview_header').style.color = value;
                } else if (key === 'card_bg') {
                    document.getElementById('preview_card').style.backgroundColor = value;
                } else if (key === 'card_text') {
                    document.getElementById('preview_card').style.color = value;
                    document.getElementById('preview_card_title').style.color = value;
                } else if (key === 'cta_bg') {
                    document.getElementById('preview_cta').style.backgroundColor = value;
                } else if (key === 'cta_text') {
                    document.getElementById('preview_cta').style.color = value;
                } else if (key === 'footer_bg') {
                    document.getElementById('preview_footer').style.backgroundColor = value;
                } else if (key === 'footer_text') {
                    document.getElementById('preview_footer').style.color = value;
                }
            }

            function resetDefaultColors() {
                const defaults = {
                    body_bg: '#F8FAFC',
                    body_text: '#1E293B',
                    header_bg: '#FFFFFF',
                    header_text: '#1E293B',
                    card_bg: '#FFFFFF',
                    card_text: '#0F172A',
                    cta_bg: '#0B0F19',
                    cta_text: '#FFFFFF',
                    footer_bg: '#080B13',
                    footer_text: '#94A3B8'
                };
                for (const [key, val] of Object.entries(defaults)) {
                    syncColor(key, val);
                }
            }
        </script>

        <!-- Grid Layer Landing -->
        <section class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($layers as $layer => $layerInfo)
                @php
                    $group = match ($layer) {
                        'hero' => $contents->filter(fn ($content) => in_array($content->type, ['hero', 'program'], true)),
                        'package' => $contents->filter(fn ($content) => ($content->type === 'package') || ($content->type === 'section' && $content->sort_order === 1)),
                        'visual' => $contents->filter(fn ($content) => $content->type === 'program' && filled($content->image_url)),
                        default => $groupedContents->get($layer, collect()),
                    };
                    $firstContent = $group->first();
                @endphp
                <a href="{{ route('maintenance.landing.layer', $layer) }}" 
                    class="group rounded-3xl border-2 border-indigo-200 bg-white/90 backdrop-blur-md p-6 shadow-sm transition-all hover:-translate-y-1 hover:border-indigo-400 hover:shadow-md flex flex-col justify-between">
                    <div>
                        <div class="flex items-start justify-between gap-4">
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl border border-indigo-200 bg-indigo-50 text-xs font-black text-indigo-700 shadow-2xs">{{ $loop->iteration }}</span>
                            <span class="rounded-xl border border-indigo-100 bg-indigo-50/50 px-3 py-1 text-[11px] font-black text-indigo-700">{{ $group->count() }} konten</span>
                        </div>
                        <h2 class="mt-5 text-base font-black text-slate-900 tracking-tight">{{ $layerInfo['label'] }}</h2>
                        <p class="mt-1 min-h-[40px] text-xs font-bold leading-relaxed text-slate-500">{{ $layerInfo['description'] }}</p>
                    </div>
                    <div class="mt-5 flex items-center justify-between border-t-2 border-indigo-50 pt-4 text-xs font-black">
                        <span class="max-w-[80%] truncate text-slate-700 font-bold">{{ $firstContent?->title ?? 'Belum ada konten' }}</span>
                        <span class="text-indigo-600 transition group-hover:translate-x-1" aria-hidden="true">→</span>
                    </div>
                </a>
            @endforeach
        </section>

    </main>

</body>

</html>