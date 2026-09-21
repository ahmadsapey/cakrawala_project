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

<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerAdmin')

    <!-- Container Utama -->
    <div
        class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-5 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header Halaman -->
        <div class="flex flex-col justify-between gap-4 pt-2 sm:flex-row sm:items-end">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Pembayaran</h1>
                <p class="text-xs text-slate-500 mt-1">Verifikasi dan kelola tagihan serta riwayat transaksi siswa.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-bold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Kolom Pencarian -->
        <form method="GET" action="{{ route('admin.pembayaran') }}"
            class="bg-white rounded-2xl border-2 border-slate-300 shadow-sm p-3.5 flex items-center space-x-3">
            @if (request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="text-slate-400 flex-shrink-0">
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
                    class="text-xs font-bold text-slate-400 hover:text-slate-600">Reset</a>
            @endif
        </form>

        <!-- Filter Tab (Semua, Lunas, Menunggu, Ditolak) -->
        <div class="flex items-center space-x-2 overflow-x-auto no-scrollbar">
            <a href="{{ route('admin.pembayaran', array_filter(['search' => request('search')])) }}"
                class="px-5 py-2.5 {{ !request('status') ? 'bg-indigo-600 text-white font-extrabold border-indigo-700 shadow-md' : 'bg-white border-2 border-slate-300 text-slate-700 font-bold hover:bg-slate-50' }} text-xs rounded-xl flex-shrink-0 transition-all">
                Semua
            </a>
            <a href="{{ route('admin.pembayaran', array_filter(['status' => 'confirmed', 'search' => request('search')])) }}"
                class="px-5 py-2.5 {{ request('status') === 'confirmed' ? 'bg-indigo-600 text-white font-extrabold border-indigo-700 shadow-md' : 'bg-white border-2 border-slate-300 text-slate-700 font-bold hover:bg-slate-50' }} text-xs rounded-xl flex-shrink-0 transition-all">
                Lunas
            </a>
            <a href="{{ route('admin.pembayaran', array_filter(['status' => 'pending', 'search' => request('search')])) }}"
                class="px-5 py-2.5 {{ request('status') === 'pending' ? 'bg-indigo-600 text-white font-extrabold border-indigo-700 shadow-md' : 'bg-white border-2 border-slate-300 text-slate-700 font-bold hover:bg-slate-50' }} text-xs rounded-xl flex-shrink-0 transition-all">
                Menunggu Konfirmasi
            </a>
            <a href="{{ route('admin.pembayaran', array_filter(['status' => 'rejected', 'search' => request('search')])) }}"
                class="px-5 py-2.5 {{ request('status') === 'rejected' ? 'bg-indigo-600 text-white font-extrabold border-indigo-700 shadow-md' : 'bg-white border-2 border-slate-300 text-slate-700 font-bold hover:bg-slate-50' }} text-xs rounded-xl flex-shrink-0 transition-all">
                Ditolak
            </a>
        </div>

        <!-- Daftar Kartu Pembayaran -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($payments as $payment)
                <div
                    class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-4.5 flex flex-col justify-between space-y-3 hover:border-indigo-600 transition-all">
                    <div class="flex items-center justify-between space-x-3">
                        <div class="flex items-center space-x-3.5 min-w-0">
                            <div
                                class="w-12 h-12 rounded-xl {{ $payment->status === 'confirmed' ? 'bg-indigo-100 text-indigo-700 border-indigo-300' : ($payment->status === 'rejected' ? 'bg-rose-100 text-rose-700 border-rose-300' : 'bg-amber-100 text-amber-700 border-amber-300') }} border flex items-center justify-center flex-shrink-0 font-bold shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div class="space-y-0.5 truncate">
                                <div class="flex items-center space-x-2">
                                    <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">
                                        {{ $payment->student?->user?->name ?? 'Siswa' }}</h3>
                                    <span class="text-xs font-extrabold text-indigo-700">Rp
                                        {{ number_format($payment->amount, 0, ',', '.') }}</span>
                                </div>
                                <p class="text-xs text-slate-600 font-medium truncate">{{ $payment->invoice_number }} •
                                    {{ $payment->description ?? 'Pembayaran' }}
                                    ({{ $payment->created_at?->format('d M Y') }})</p>
                            </div>
                        </div>
                        <span
                            class="px-3 py-1 {{ $payment->status === 'confirmed' ? 'bg-emerald-100 border-emerald-300 text-emerald-800' : ($payment->status === 'rejected' ? 'bg-rose-100 border-rose-300 text-rose-800' : 'bg-amber-100 border-amber-300 text-amber-800') }} border text-xs font-extrabold rounded-lg flex-shrink-0">
                            {{ $payment->status === 'confirmed' ? 'Lunas' : ($payment->status === 'rejected' ? 'Ditolak' : 'Menunggu') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-100 pt-3 text-xs">
                        <span class="text-slate-500 font-medium truncate">NISN: {{ $payment->student?->nisn ?? '-' }}</span>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if ($payment->status === 'pending')
                                <form method="POST" action="{{ route('admin.pembayaran.confirm', $payment) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="rounded-lg bg-emerald-600 px-3 py-1.5 font-bold text-white hover:bg-emerald-700 shadow-sm transition">Konfirmasi</button>
                                </form>
                                <form method="POST" action="{{ route('admin.pembayaran.reject', $payment) }}"
                                    onsubmit="return confirm('Tolak pembayaran ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="rounded-lg bg-rose-50 px-3 py-1.5 font-bold text-rose-600 hover:bg-rose-100 transition">Tolak</button>
                                </form>
                            @elseif ($payment->status === 'confirmed')
                                <span class="text-emerald-700 font-bold text-[11px]">✓ Dikonfirmasi
                                    {{ $payment->confirmed_at ? $payment->confirmed_at->format('d/m/Y') : '' }}</span>
                            @else
                                <span class="text-rose-600 font-bold text-[11px]">Ditolak</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full rounded-2xl border-2 border-dashed border-slate-300 bg-white p-12 text-center text-xs font-semibold text-slate-400">
                    Tidak ada data pembayaran yang sesuai kriteria.
                </div>
            @endforelse
        </div>

        @if ($payments->hasPages())
            <div class="pt-4">
                {{ $payments->links() }}
            </div>
        @endif

    </div>

    @include('components.footerMobile_admin')

</body>

</html>