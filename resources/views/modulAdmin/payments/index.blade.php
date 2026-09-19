<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran | Cakrawala</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#F8FAFC] pb-28 font-sans text-slate-800 antialiased">
    @include('components.headerAdmin')
    <main class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <div><p class="text-xs font-bold uppercase tracking-[0.18em] text-indigo-500">Keuangan</p><h1 class="mt-1 text-2xl font-black tracking-tight text-slate-900">Konfirmasi pembayaran</h1><p class="mt-2 text-sm text-slate-500">Periksa pembayaran yang dikirim siswa sebelum mengonfirmasi.</p></div>
        @if (session('success'))<div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>@endif
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"><div class="overflow-x-auto"><table class="w-full min-w-[780px] text-left text-sm"><thead class="border-b border-slate-100 bg-slate-50 text-xs uppercase tracking-wider text-slate-500"><tr><th class="px-5 py-4">Siswa</th><th class="px-5 py-4">Invoice</th><th class="px-5 py-4">Pembayaran</th><th class="px-5 py-4">Status</th><th class="px-5 py-4 text-right">Aksi</th></tr></thead><tbody class="divide-y divide-slate-100">
        @forelse ($payments as $payment)<tr class="hover:bg-slate-50/70"><td class="px-5 py-4"><div class="font-bold text-slate-900">{{ $payment->student->user->name }}</div><div class="text-xs text-slate-400">NISN {{ $payment->student->nisn }}</div></td><td class="px-5 py-4 text-slate-600">{{ $payment->invoice_number }}</td><td class="px-5 py-4"><div class="font-bold text-slate-900">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div><div class="text-xs text-slate-400">{{ $payment->description }}</div></td><td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $payment->status === 'confirmed' ? 'bg-emerald-50 text-emerald-600' : ($payment->status === 'rejected' ? 'bg-rose-50 text-rose-600' : 'bg-amber-50 text-amber-600') }}">{{ ucfirst($payment->status) }}</span></td><td class="px-5 py-4"><div class="flex justify-end gap-2">@if ($payment->status === 'pending')<form method="POST" action="{{ route('admin.pembayaran.confirm', $payment) }}">@csrf @method('PATCH')<button class="rounded-lg bg-emerald-600 px-3 py-2 text-xs font-bold text-white hover:bg-emerald-700">Konfirmasi</button></form><form method="POST" action="{{ route('admin.pembayaran.reject', $payment) }}">@csrf @method('PATCH')<button class="rounded-lg bg-rose-50 px-3 py-2 text-xs font-bold text-rose-600 hover:bg-rose-100">Tolak</button></form>@else<span class="text-xs font-semibold text-slate-400">Sudah diproses</span>@endif</div></td></tr>@empty<tr><td colspan="5" class="px-5 py-12 text-center text-sm text-slate-400">Belum ada pengajuan pembayaran.</td></tr>@endforelse
        </tbody></table></div>@if ($payments->hasPages())<div class="border-t border-slate-100 px-5 py-4">{{ $payments->links() }}</div>@endif</section>
    </main>
    @include('components.footerMobile_admin')
</body>
</html>
