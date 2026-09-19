<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Guru | Cakrawala</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#F8FAFC] pb-28 font-sans text-slate-800 antialiased">
    @include('components.headerAdmin')
    <main class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end"><div><p class="text-xs font-bold uppercase tracking-[0.18em] text-indigo-500">Data akademik</p><h1 class="mt-1 text-2xl font-black tracking-tight text-slate-900">Manajemen Guru / Dosen</h1></div><a href="{{ route('admin.guru.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition hover:bg-indigo-700"><span class="text-lg leading-none">+</span> Tambah guru</a></div>
        @if (session('success'))<div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>@endif
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"><div class="overflow-x-auto"><table class="w-full min-w-[720px] text-left text-sm"><thead class="border-b border-slate-100 bg-slate-50 text-xs uppercase tracking-wider text-slate-500"><tr><th class="px-5 py-4">Guru / Dosen</th><th class="px-5 py-4">NIP</th><th class="px-5 py-4">Mata pelajaran</th><th class="px-5 py-4">Status</th><th class="px-5 py-4 text-right">Aksi</th></tr></thead><tbody class="divide-y divide-slate-100">
        @forelse ($teachers as $teacher)<tr class="hover:bg-slate-50/70"><td class="px-5 py-4"><div class="font-bold text-slate-900">{{ $teacher->user->name }}</div><div class="text-xs text-slate-400">{{ $teacher->user->email }}</div></td><td class="px-5 py-4 text-slate-600">{{ $teacher->nip }}</td><td class="px-5 py-4 text-slate-600">{{ $teacher->subject }}</td><td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $teacher->status === 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">{{ $teacher->status === 'active' ? 'Aktif' : 'Tidak aktif' }}</span></td><td class="px-5 py-4"><div class="flex justify-end gap-2"><a href="{{ route('admin.guru.show', $teacher) }}" class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50">Detail</a><a href="{{ route('admin.guru.edit', $teacher) }}" class="rounded-lg bg-indigo-50 px-3 py-2 text-xs font-bold text-indigo-600 hover:bg-indigo-100">Edit</a><form method="POST" action="{{ route('admin.guru.destroy', $teacher) }}" onsubmit="return confirm('Hapus data guru ini?')">@csrf @method('DELETE')<button class="rounded-lg bg-rose-50 px-3 py-2 text-xs font-bold text-rose-600 hover:bg-rose-100">Hapus</button></form></div></td></tr>@empty<tr><td colspan="5" class="px-5 py-12 text-center text-sm text-slate-400">Belum ada data guru.</td></tr>@endforelse
        </tbody></table></div>@if ($teachers->hasPages())<div class="border-t border-slate-100 px-5 py-4">{{ $teachers->links() }}</div>@endif</section>
    </main>
    @include('components.footerMobile_admin')
</body>
</html>
