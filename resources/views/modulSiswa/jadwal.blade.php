<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Belajar & Agenda | Cakrawala Educentre</title>
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
</head>

<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2 border-b border-slate-200 pb-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-bold mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Agenda Terjadwal Siswa
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                    <span>Jadwal Bimbel & Sesi Belajar</span>
                    <span>📅</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 font-medium mt-1">
                    Jadwal terpadu sesi privat 1-on-1, kelas bimbel reguler, dan simulasi Tryout CBT.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('siswa.payment.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-600/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    <span>Daftar Sesi Baru</span>
                </a>
            </div>
        </div>

        <!-- Filter Kategori Jadwal -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1" id="filter-container">
            <button onclick="filterSchedule('all')" class="schedule-tab px-4 py-2 bg-indigo-600 text-white font-extrabold border border-indigo-700 text-xs rounded-xl shrink-0 transition-all shadow-sm" data-category="all">
                Semua Jadwal ({{ $schedules->count() }})
            </button>
            <button onclick="filterSchedule('privat')" class="schedule-tab px-4 py-2 bg-white text-slate-700 border-2 border-slate-200 font-bold hover:bg-slate-50 text-xs rounded-xl shrink-0 transition-all" data-category="privat">
                Sesi Privat (1-on-1)
            </button>
            <button onclick="filterSchedule('bimbel')" class="schedule-tab px-4 py-2 bg-white text-slate-700 border-2 border-slate-200 font-bold hover:bg-slate-50 text-xs rounded-xl shrink-0 transition-all" data-category="bimbel">
                Kelas Bimbel & MAN IC
            </button>
            <button onclick="filterSchedule('tryout')" class="schedule-tab px-4 py-2 bg-white text-slate-700 border-2 border-slate-200 font-bold hover:bg-slate-50 text-xs rounded-xl shrink-0 transition-all" data-category="tryout">
                Tryout CBT Akbar
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Utama: Agenda Mingguan -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <span>Daftar Sesi Pekan Ini</span>
                    </h2>
                    <span class="text-xs text-slate-500 font-medium">Zona Waktu: WIB</span>
                </div>

                <div class="space-y-3" id="schedule-list">
                    @forelse ($schedules as $item)
                        <div class="schedule-card bg-white p-5 rounded-2xl border-2 border-slate-200 hover:border-indigo-600 hover:shadow-md transition-all space-y-4" data-category="{{ $item['category'] }}">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <div class="flex items-center gap-2.5">
                                    <span class="px-2.5 py-1 text-[11px] font-extrabold rounded-lg border {{ $item['badge_color'] }}">
                                        {{ $item['category_label'] }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-500">
                                        {{ $item['type'] }}
                                    </span>
                                </div>
                                <span class="self-start sm:self-auto text-xs font-extrabold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 rounded-full">
                                    {{ $item['status'] }}
                                </span>
                            </div>

                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">{{ $item['title'] }}</h3>
                                <p class="text-xs text-slate-600 font-semibold mt-1">Tutor: <span class="text-indigo-600">{{ $item['tutor'] }}</span></p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3 border-t border-slate-100 text-xs text-slate-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span class="font-bold text-slate-800">{{ $item['day'] }}, {{ $item['time'] }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="truncate">{{ $item['location'] }}</span>
                                </div>
                            </div>

                            @if($item['category'] === 'tryout')
                                <div class="pt-2">
                                    <a href="{{ route('siswa.tryout') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                                        Buka Portal Tryout CBT
                                        <svg class="w-3.5 h-3.5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-white p-8 text-center text-xs font-semibold text-slate-500">
                            Belum ada jadwal sesi belajar yang aktif.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Kolom Samping: Kelas Terdaftar & Tenggat Waktu -->
            <div class="space-y-6">
                <!-- Card Kelas Aktif -->
                <div class="bg-white rounded-2xl border-2 border-slate-200 p-5 space-y-4">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center justify-between">
                        <span>Kelas Aktif Kamu</span>
                        <a href="{{ route('siswa.kelas') }}" class="text-xs text-indigo-600 font-bold hover:underline">Semua</a>
                    </h3>

                    <div class="space-y-3">
                        @forelse ($classrooms as $cls)
                            <a href="{{ route('siswa.kelas.show', $cls) }}" class="block p-3 rounded-xl bg-slate-50 hover:bg-indigo-50/50 border border-slate-200 transition-all">
                                <h4 class="text-xs font-extrabold text-slate-900 leading-snug">{{ $cls->name }}</h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ $cls->subject }} · {{ $cls->grade_level }}</p>
                            </a>
                        @empty
                            <p class="text-xs text-slate-500">Belum terdaftar di kelas manapun.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Card Tryout Mendatang -->
                <div class="bg-white rounded-2xl border-2 border-slate-200 p-5 space-y-4">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center justify-between">
                        <span>Tryout & Kuis Aktif</span>
                        <a href="{{ route('siswa.tryout') }}" class="text-xs text-indigo-600 font-bold hover:underline">Ikuti</a>
                    </h3>

                    <div class="space-y-3">
                        @forelse ($tryouts as $to)
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-extrabold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800">CBT</span>
                                    <span class="text-[10px] text-slate-500 font-bold">{{ $to->duration_minutes }} Menit</span>
                                </div>
                                <h4 class="text-xs font-bold text-slate-900 mt-1.5">{{ $to->title }}</h4>
                                <div class="mt-2 pt-2 border-t border-slate-200/60 flex items-center justify-between">
                                    <span class="text-[10px] text-slate-500 font-medium">Batas: {{ $to->due_at ? \Carbon\Carbon::parse($to->due_at)->format('d M, H:i') : 'Fleksibel' }}</span>
                                    <a href="{{ route('siswa.pengerjaan', $to) }}" class="text-[11px] font-bold text-indigo-600 hover:text-indigo-800">Kerjakan &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-500">Belum ada tryout aktif saat ini.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Bantuan Layanan Privat -->
                <div class="bg-gradient-to-br from-indigo-900 to-slate-900 rounded-2xl p-5 text-white space-y-3 shadow-lg">
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-300">Konsultasi Jadwal</span>
                    <h4 class="text-sm font-extrabold leading-snug">Butuh Mengubah Waktu Belajar atau Request Guru Datang?</h4>
                    <p class="text-xs text-indigo-100 leading-relaxed">
                        Tim Customer Service & Koordinator Akademik Cakrawala siap membantu penyesuaian jadwal sesi privat Anda.
                    </p>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Cakrawala%2C%20saya%20ingin%20konsultasi%20jadwal%20belajar" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-extrabold rounded-xl transition-all">
                        <span>Hubungi CS via WhatsApp</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

    <script>
        function filterSchedule(category) {
            const tabs = document.querySelectorAll('.schedule-tab');
            tabs.forEach(tab => {
                if (tab.getAttribute('data-category') === category) {
                    tab.className = 'schedule-tab px-4 py-2 bg-indigo-600 text-white font-extrabold border border-indigo-700 text-xs rounded-xl shrink-0 transition-all shadow-sm';
                } else {
                    tab.className = 'schedule-tab px-4 py-2 bg-white text-slate-700 border-2 border-slate-200 font-bold hover:bg-slate-50 text-xs rounded-xl shrink-0 transition-all';
                }
            });

            const cards = document.querySelectorAll('.schedule-card');
            cards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>
