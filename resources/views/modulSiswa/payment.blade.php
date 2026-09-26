<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('components.fonts')
</head>
<body class="min-h-screen bg-[#F8FAFC] px-4 py-8 font-sans text-slate-800 antialiased sm:px-6">
    <main class="mx-auto max-w-2xl space-y-6">
        <div><p class="text-xs font-bold uppercase tracking-[0.18em] text-indigo-500">Administrasi siswa</p><h1 class="mt-2 text-2xl font-black tracking-tight text-slate-900">Kirim pembayaran</h1><p class="mt-2 text-sm text-slate-500">Pembayaran akan diperiksa admin sebelum dinyatakan lunas.</p></div>
        @if (session('success'))<div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>@endif
        @if ($errors->any())<div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700"><ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <form method="POST" action="{{ route('siswa.payment.store') }}" class="space-y-5 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
            @csrf
            <label class="block text-sm font-bold text-slate-700">Jumlah pembayaran<input type="number" name="amount" value="{{ old('amount') }}" min="1" required placeholder="1500000" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"></label>
            <label class="block text-sm font-bold text-slate-700">Keperluan pembayaran<input type="text" name="description" value="{{ old('description') }}" required placeholder="SPP Semester 1" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"></label>
            <button class="w-full rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 hover:bg-indigo-700">Kirim untuk dikonfirmasi</button>
        </form>
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><h2 class="font-black text-slate-900">Riwayat pengajuan</h2><div class="mt-4 space-y-3">@forelse ($payments as $payment)<div class="flex items-center justify-between gap-4 rounded-xl bg-slate-50 px-4 py-3"><div><p class="text-sm font-bold text-slate-800">{{ $payment->description }}</p><p class="text-xs text-slate-400">{{ $payment->invoice_number }} · Rp {{ number_format($payment->amount, 0, ',', '.') }}</p></div><span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $payment->status === 'confirmed' ? 'bg-emerald-50 text-emerald-600' : ($payment->status === 'rejected' ? 'bg-rose-50 text-rose-600' : 'bg-amber-50 text-amber-600') }}">{{ ucfirst($payment->status) }}</span></div>@empty<p class="text-sm text-slate-400">Belum ada pengajuan pembayaran.</p>@endforelse</div></section>
    </main>
</body>
</html>
