<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin | Cakrawala Educentre</title>
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

<body class="min-h-screen bg-gradient-to-br from-indigo-50/50 via-slate-50 to-blue-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

    @include('components.headerAdmin')

    <!-- Container Utama -->
    <main class="mx-auto flex w-full max-w-6xl flex-col space-y-6 px-4 py-8 sm:px-6 lg:px-12">

        <!-- Section 1: Ikhtisar Cakrawala -->
        <div class="space-y-3 pt-2">
            <div class="flex items-center justify-between px-1">
                <h2 class="text-xs font-black uppercase tracking-[0.18em] text-indigo-700 bg-indigo-50 border border-indigo-200 px-3 py-1.5 rounded-xl shadow-2xs">Ikhtisar Cakrawala</h2>
                <span class="text-xs font-bold text-slate-500">Ringkasan Sistem Akademik</span>
            </div>

            <!-- Grid 4 Kartu Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- Kartu 1: siswa -->
                <a href="{{ route('admin.siswa.index') }}"
                    class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-indigo-100 shadow-sm p-6 space-y-3 hover:border-indigo-300 transition-all">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-[11px] font-black text-slate-400 uppercase tracking-wider">Siswa</span>
                        <div class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">
                            {{ number_format($totalStudents ?? 0) }}</div>
                    </div>
                </a>

                <!-- Kartu 2: Total Guru -->
                <a href="{{ route('admin.guru.index') }}"
                    class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-indigo-100 shadow-sm p-6 space-y-3 hover:border-indigo-300 transition-all">
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-[11px] font-black text-slate-400 uppercase tracking-wider">Total Guru</span>
                        <div class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">
                            {{ number_format($totalTeachers ?? 0) }}</div>
                    </div>
                </a>

                <!-- Kartu 3: Pembayaran -->
                <a href="{{ route('admin.pembayaran') }}"
                    class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-indigo-100 shadow-sm p-6 space-y-3 hover:border-indigo-300 transition-all">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-[11px] font-black text-slate-400 uppercase tracking-wider">Pembayaran {{ $currentMonthName ?? 'Terkonfirmasi' }}</span>
                        <div class="text-lg sm:text-xl font-black text-slate-900 tracking-tight mt-1">Rp
                            {{ number_format($paidAmount ?? 0, 0, ',', '.') }}</div>
                    </div>
                </a>

                <!-- Kartu 4: Tunggakan -->
                <a href="{{ route('admin.pembayaran', ['status' => 'pending']) }}"
                    class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-indigo-100 shadow-sm p-6 space-y-3 hover:border-indigo-300 transition-all">
                    <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-[11px] font-black text-slate-400 uppercase tracking-wider">Menunggu / Pending</span>
                        <div class="text-lg sm:text-xl font-black text-rose-600 tracking-tight mt-1">Rp
                            {{ number_format($totalPending ?? 0, 0, ',', '.') }}</div>
                    </div>
                </a>

            </div>
        </div>

        <!-- Section 2: Aktivitas Terbaru -->
        <div class="space-y-3">
            <div class="px-1 flex items-center justify-between">
                <h2 class="text-xs font-black uppercase tracking-wider text-slate-700">Aktivitas Terbaru</h2>
                <span class="text-xs font-bold text-slate-500">Log sistem real-time</span>
            </div>

            <div class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-indigo-100 shadow-sm p-6 sm:p-8 space-y-4">
                @forelse ($recentActivities ?? [] as $activity)
                    <div class="flex items-center justify-between pb-4 border-b-2 border-slate-100 last:border-0 last:pb-0">
                        <div class="flex items-center space-x-4 overflow-hidden">
                            @if ($activity['type'] === 'student')
                                <div class="w-11 h-11 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-200 flex items-center justify-center flex-shrink-0 font-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @elseif ($activity['type'] === 'payment')
                                <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center flex-shrink-0 font-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @else
                                <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center flex-shrink-0 font-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                            <div class="space-y-1 overflow-hidden">
                                <h4 class="text-xs sm:text-sm font-black text-slate-900 truncate">{{ $activity['title'] }}</h4>
                                <p class="text-xs text-slate-500 font-bold truncate">{{ $activity['subtitle'] }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-slate-400 font-bold flex-shrink-0 pl-3">{{ $activity['time'] }}</span>
                    </div>
                @empty
                    <div class="text-center py-12 text-slate-400 space-y-1">
                        <p class="text-sm font-black text-slate-800">Belum ada aktivitas baru terdeteksi.</p>
                        <p class="text-xs font-bold text-slate-500">Aktivitas siswa, guru, dan pembayaran akan muncul di sini.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </main>

    @include('components.footerMobile_admin')

</body>

</html>