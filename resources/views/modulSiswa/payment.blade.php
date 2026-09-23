<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran & Tagihan | Cakrawala Educentre</title>
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
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                    Administrasi & Konfirmasi Pembayaran
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                    <span>Pembayaran Layanan Pendidikan</span>
                    <span>💳</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 font-medium mt-1">
                    Pilih paket bimbingan belajar, sesi privat, atau tryout, lalu lakukan konfirmasi transfer resmi.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-slate-600">
                    Siswa: <strong class="text-slate-900">{{ $student?->user?->name ?? 'Siswa Demo' }}</strong>
                </span>
            </div>
        </div>

        @if (session('success'))
            <div class="flex items-center gap-3 rounded-2xl border border-emerald-300 bg-emerald-50 px-5 py-4 text-xs sm:text-sm font-bold text-emerald-800 shadow-sm">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl border border-rose-300 bg-rose-50 px-5 py-4 text-xs sm:text-sm font-semibold text-rose-800 shadow-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Pilihan Cepat Paket Belajar -->
        <div class="space-y-3">
            <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center justify-between">
                <span>Pilih Paket & Layanan Unggulan</span>
                <span class="text-xs font-semibold text-slate-500">Klik paket untuk mengisi form otomatis</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div onclick="selectPackage('Les Privat 1-on-1 (4 Sesi)', 396000)" class="cursor-pointer bg-white p-4 rounded-2xl border-2 border-slate-200 hover:border-indigo-600 hover:shadow-md transition-all space-y-2 group">
                    <span class="px-2 py-0.5 rounded text-[10px] font-black bg-indigo-50 text-indigo-700 border border-indigo-200">LES PRIVAT</span>
                    <h3 class="text-sm font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors">Privat 1-on-1 Intensif</h3>
                    <p class="text-xs text-slate-500">4 sesi tatap muka / online bersama tutor master pilihan.</p>
                    <div class="pt-2 text-sm font-black text-indigo-600">Rp 396.000</div>
                </div>

                <div onclick="selectPackage('Bimbel Terpadu Semester Gasal', 750000)" class="cursor-pointer bg-white p-4 rounded-2xl border-2 border-slate-200 hover:border-indigo-600 hover:shadow-md transition-all space-y-2 group">
                    <span class="px-2 py-0.5 rounded text-[10px] font-black bg-blue-50 text-blue-700 border border-blue-200">BIMBEL TERPADU</span>
                    <h3 class="text-sm font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors">Bimbel Kelas Reguler</h3>
                    <p class="text-xs text-slate-500">Kelas komprehensif pendalaman materi sekolah + e-learning.</p>
                    <div class="pt-2 text-sm font-black text-indigo-600">Rp 750.000</div>
                </div>

                <div onclick="selectPackage('Tryout Akbar CBT MAN IC & UTBK', 50000)" class="cursor-pointer bg-white p-4 rounded-2xl border-2 border-amber-300 hover:border-amber-500 hover:shadow-md transition-all space-y-2 group bg-amber-50/20">
                    <span class="px-2 py-0.5 rounded text-[10px] font-black bg-amber-100 text-amber-800 border border-amber-300">MAN IC & UTBK</span>
                    <h3 class="text-sm font-extrabold text-slate-900 group-hover:text-amber-700 transition-colors">Tiket Tryout CBT Akbar</h3>
                    <p class="text-xs text-slate-500">Simulasi ujian sistem CBT, analisis IRT & ranking nasional.</p>
                    <div class="pt-2 text-sm font-black text-amber-700">Rp 50.000</div>
                </div>

                <div onclick="selectPackage('Program Calistung & Pengayaan', 250000)" class="cursor-pointer bg-white p-4 rounded-2xl border-2 border-slate-200 hover:border-indigo-600 hover:shadow-md transition-all space-y-2 group">
                    <span class="px-2 py-0.5 rounded text-[10px] font-black bg-emerald-50 text-emerald-700 border border-emerald-200">CALISTUNG</span>
                    <h3 class="text-sm font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors">Calistung & Dasar Sains</h3>
                    <p class="text-xs text-slate-500">Metode belajar ramah anak dengan modul latihan interaktif.</p>
                    <div class="pt-2 text-sm font-black text-indigo-600">Rp 250.000</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Form Konfirmasi Pembayaran -->
            <div class="lg:col-span-7 bg-white rounded-2xl border-2 border-slate-200 p-6 space-y-5">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="text-base font-extrabold text-slate-900">Form Pengajuan Pembayaran</h3>
                    <p class="text-xs text-slate-500 mt-1">Masukkan nominal dan keterangan paket yang Anda transfer.</p>
                </div>

                <form method="POST" action="{{ route('siswa.payment.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="description" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">
                            Keperluan / Nama Paket <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="description" name="description" value="{{ old('description') }}" required placeholder="Contoh: Bimbel Terpadu Semester Gasal" class="w-full rounded-xl border-2 border-slate-200 px-4 py-2.5 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:outline-none transition-all">
                    </div>

                    <div>
                        <label for="amount" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">
                            Nominal Transfer (Rp) <span class="text-rose-500">*</span>
                        </label>
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}" min="1" required placeholder="750000" class="w-full rounded-xl border-2 border-slate-200 px-4 py-2.5 text-xs sm:text-sm font-semibold text-slate-900 focus:border-indigo-600 focus:outline-none transition-all">
                        <span class="text-[11px] text-slate-500 mt-1 block">Pastikan nominal transfer sesuai bukti mutasi rekening.</span>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full rounded-xl bg-indigo-600 hover:bg-indigo-700 px-5 py-3 text-xs sm:text-sm font-extrabold text-white shadow-lg shadow-indigo-600/25 transition-all">
                            Kirim Konfirmasi Pembayaran &rarr;
                        </button>
                    </div>
                </form>
            </div>

            <!-- Rekening Tujuan & Informasi -->
            <div class="lg:col-span-5 space-y-4">
                <div class="bg-gradient-to-br from-indigo-900 to-slate-900 text-white rounded-2xl p-6 space-y-4 shadow-md">
                    <span class="text-[11px] font-black uppercase tracking-wider text-indigo-300">Rekening Resmi Pembayaran</span>
                    <h4 class="text-base font-extrabold">PT INDO PRESTASI UTAMA</h4>
                    <p class="text-xs text-indigo-100 leading-relaxed">
                        Silakan transfer biaya layanan bimbingan belajar Cakrawala ke salah satu rekening resmi berikut:
                    </p>

                    <div class="space-y-3 pt-1">
                        <div class="bg-white/10 rounded-xl p-3 border border-white/15">
                            <div class="text-[11px] font-bold text-indigo-200">Bank Central Asia (BCA)</div>
                            <div class="text-base font-black tracking-wider text-white select-all">8290-123-456</div>
                            <div class="text-[10px] text-slate-300">a.n. PT INDO PRESTASI UTAMA</div>
                        </div>

                        <div class="bg-white/10 rounded-xl p-3 border border-white/15">
                            <div class="text-[11px] font-bold text-indigo-200">Bank Mandiri</div>
                            <div class="text-base font-black tracking-wider text-white select-all">137-00-1928374-1</div>
                            <div class="text-[10px] text-slate-300">a.n. PT INDO PRESTASI UTAMA</div>
                        </div>
                    </div>

                    <div class="pt-1 text-[11px] text-indigo-200 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>Konfirmasi diproses maksimal 1x24 jam kerja oleh Admin.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pembayaran Siswa -->
        <div class="bg-white rounded-2xl border-2 border-slate-200 p-6 space-y-4">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center justify-between">
                <span>Riwayat Tagihan & Pembayaran</span>
                <span class="text-xs font-semibold text-slate-500">{{ $payments->count() }} Transaksi</span>
            </h3>

            <div class="divide-y divide-slate-100">
                @forelse ($payments as $payment)
                    <div class="py-3.5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-mono font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded border border-indigo-100">
                                    {{ $payment->invoice_number }}
                                </span>
                                <span class="text-xs text-slate-400 font-medium">
                                    {{ $payment->created_at ? $payment->created_at->format('d M Y, H:i') : '-' }}
                                </span>
                            </div>
                            <h4 class="text-sm font-extrabold text-slate-900">{{ $payment->description }}</h4>
                            <div class="text-xs font-bold text-slate-600">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="self-start sm:self-center">
                            @if ($payment->status === 'confirmed')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Lunas / Terkonfirmasi
                                </span>
                            @elseif ($payment->status === 'rejected')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-extrabold bg-rose-100 text-rose-800 border border-rose-300">
                                    Ditolak
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-extrabold bg-amber-100 text-amber-800 border border-amber-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Menunggu Verifikasi Admin
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-xs font-semibold text-slate-500">
                        Belum ada riwayat pengajuan pembayaran.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

    <script>
        function selectPackage(name, price) {
            document.getElementById('description').value = name;
            document.getElementById('amount').value = price;
            document.getElementById('description').focus();
        }
    </script>
</body>

</html>
