<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pembayaran | Cakrawala Educentre</title>
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

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pt-2">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-indigo-700 bg-indigo-50 border border-indigo-200 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Modul Admin</span>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Manajemen Pembayaran</h1>
                <p class="text-xs sm:text-sm text-slate-600 font-bold mt-1">Verifikasi dan kelola tagihan serta riwayat transaksi siswa.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-2xl border-2 border-emerald-300 bg-emerald-50 px-5 py-4 text-xs sm:text-sm font-bold text-emerald-800 shadow-sm flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Kolom Pencarian -->
        <form method="GET" action="{{ route('admin.pembayaran') }}"
            class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-indigo-200 shadow-sm p-4 flex items-center space-x-3">
            @if (request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="text-indigo-500 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama siswa, No. Invoice, atau keperluan..."
                class="w-full bg-transparent text-xs sm:text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none">
            @if (request('search'))
                <a href="{{ route('admin.pembayaran', array_filter(['status' => request('status')])) }}"
                    class="text-xs font-black text-indigo-600 hover:text-indigo-800 bg-indigo-50 border border-indigo-200 px-3 py-1.5 rounded-xl">Reset</a>
            @endif
        </form>

        <!-- Filter Tab (Semua, Lunas, Menunggu, Ditolak) -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 scrollbar-none">
            <a href="{{ route('admin.pembayaran', array_filter(['search' => request('search')])) }}"
                class="px-5 py-3 {{ !request('status') ? 'bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 text-white shadow-sm' : 'bg-white/90 border-2 border-indigo-200 text-slate-700 hover:bg-indigo-50/50' }} font-black text-xs rounded-2xl flex-shrink-0 transition-all">
                Semua Pembayaran
            </a>
            <a href="{{ route('admin.pembayaran', array_filter(['status' => 'confirmed', 'search' => request('search')])) }}"
                class="px-5 py-3 {{ request('status') === 'confirmed' ? 'bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 text-white shadow-sm' : 'bg-white/90 border-2 border-indigo-200 text-slate-700 hover:bg-indigo-50/50' }} font-black text-xs rounded-2xl flex-shrink-0 transition-all">
                Lunas
            </a>
            <a href="{{ route('admin.pembayaran', array_filter(['status' => 'pending', 'search' => request('search')])) }}"
                class="px-5 py-3 {{ request('status') === 'pending' ? 'bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 text-white shadow-sm' : 'bg-white/90 border-2 border-indigo-200 text-slate-700 hover:bg-indigo-50/50' }} font-black text-xs rounded-2xl flex-shrink-0 transition-all">
                Menunggu Konfirmasi
            </a>
            <a href="{{ route('admin.pembayaran', array_filter(['status' => 'rejected', 'search' => request('search')])) }}"
                class="px-5 py-3 {{ request('status') === 'rejected' ? 'bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 text-white shadow-sm' : 'bg-white/90 border-2 border-indigo-200 text-slate-700 hover:bg-indigo-50/50' }} font-black text-xs rounded-2xl flex-shrink-0 transition-all">
                Ditolak
            </a>
        </div>

        <!-- Daftar Kartu Pembayaran -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($payments as $payment)
                <div
                    class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-indigo-100 shadow-sm p-6 flex flex-col justify-between space-y-4 hover:border-indigo-300 transition-all">
                    <div class="flex items-center justify-between space-x-3">
                        <div class="flex items-center space-x-4 min-w-0">
                            <div
                                class="w-12 h-12 rounded-2xl {{ $payment->status === 'confirmed' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($payment->status === 'rejected' ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-amber-50 text-amber-700 border-amber-200') }} border flex items-center justify-center flex-shrink-0 font-black shadow-2xs">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div class="space-y-1 truncate">
                                <div class="flex items-center space-x-2 truncate">
                                    <h3 class="text-sm sm:text-base font-black text-slate-900 truncate">
                                        {{ $payment->student?->user?->name ?? 'Siswa' }}</h3>
                                </div>
                                <p class="text-xs text-indigo-700 font-extrabold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                                <p class="text-xs text-slate-500 font-bold truncate">{{ $payment->invoice_number }} • {{ $payment->description ?? 'Pembayaran' }} ({{ $payment->created_at?->format('d M Y') }})</p>
                            </div>
                        </div>
                        <span
                            class="px-3 py-1.5 {{ $payment->status === 'confirmed' ? 'bg-emerald-50 border-emerald-300 text-emerald-800' : ($payment->status === 'rejected' ? 'bg-rose-50 border-rose-300 text-rose-800' : 'bg-amber-50 border-amber-300 text-amber-800') }} border text-xs font-black rounded-xl flex-shrink-0">
                            {{ $payment->status === 'confirmed' ? 'Lunas' : ($payment->status === 'rejected' ? 'Ditolak' : 'Menunggu') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between border-t-2 border-slate-100 pt-4 text-xs">
                        <span class="text-slate-500 font-bold truncate">NISN: {{ $payment->student?->nisn ?? '-' }}</span>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if ($payment->status === 'pending')
                                <form method="POST" action="{{ route('admin.pembayaran.confirm', $payment) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="rounded-xl bg-emerald-600 px-4 py-2 font-black text-white hover:bg-emerald-700 shadow-sm transition-all">Konfirmasi</button>
                                </form>
                                <form method="POST" action="{{ route('admin.pembayaran.reject', $payment) }}"
                                    onsubmit="return confirm('Tolak pembayaran ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="rounded-xl bg-rose-50 border border-rose-200 px-4 py-2 font-black text-rose-700 hover:bg-rose-100 transition-all">Tolak</button>
                                </form>
                            @elseif ($payment->status === 'confirmed')
                                <span class="text-emerald-700 font-black text-xs">✓ Dikonfirmasi {{ $payment->confirmed_at ? $payment->confirmed_at->format('d/m/Y') : '' }}</span>
                            @else
                                <span class="text-rose-600 font-black text-xs">Ditolak</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full rounded-3xl border-2 border-dashed border-slate-300 bg-white/85 backdrop-blur-md p-12 text-center text-xs font-bold text-slate-500 shadow-2xs space-y-1">
                    <p class="text-base font-black text-slate-800">Tidak ada data pembayaran yang sesuai kriteria.</p>
                    <p class="text-xs font-bold text-slate-500">Coba ubah kata kunci pencarian atau filter status transaksi.</p>
                </div>
            @endforelse
        </div>

        @if ($payments->hasPages())
            <div class="pt-4">
                {{ $payments->links() }}
            </div>
        @endif

    </main>

    @include('components.footerMobile_admin')

</body>

</html>