<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Guru | Cakrawala Educentre</title>
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
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Guru</h1>
                <p class="text-xs text-slate-500 mt-1">Kelola data tenaga pengajar dan penugasan mata pelajaran.</p>
            </div>
            <a href="{{ route('admin.guru.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-extrabold text-white shadow-md transition hover:bg-indigo-700">
                <span class="text-base leading-none">+</span> Tambah Guru
            </a>
        </div>

        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-bold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Kolom Pencarian -->
        <form method="GET" action="{{ route('admin.guru.index') }}"
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
                placeholder="Cari nama guru, NIP, atau mata pelajaran..."
                class="w-full bg-transparent text-xs sm:text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none">
            @if (request('search'))
                <a href="{{ route('admin.guru.index', array_filter(['status' => request('status')])) }}"
                    class="text-xs font-bold text-slate-400 hover:text-slate-600">Reset</a>
            @endif
        </form>

        <!-- Filter Tab (Semua, Aktif, Tidak Aktif) -->
        <div class="flex items-center space-x-2 overflow-x-auto no-scrollbar">
            <a href="{{ route('admin.guru.index', array_filter(['search' => request('search')])) }}"
                class="px-5 py-2.5 {{ !request('status') ? 'bg-indigo-600 text-white font-extrabold border-indigo-700 shadow-md' : 'bg-white border-2 border-slate-300 text-slate-700 font-bold hover:bg-slate-50' }} text-xs rounded-xl flex-shrink-0 transition-all">
                Semua
            </a>
            <a href="{{ route('admin.guru.index', array_filter(['status' => 'active', 'search' => request('search')])) }}"
                class="px-5 py-2.5 {{ request('status') === 'active' ? 'bg-indigo-600 text-white font-extrabold border-indigo-700 shadow-md' : 'bg-white border-2 border-slate-300 text-slate-700 font-bold hover:bg-slate-50' }} text-xs rounded-xl flex-shrink-0 transition-all">
                Aktif
            </a>
            <a href="{{ route('admin.guru.index', array_filter(['status' => 'inactive', 'search' => request('search')])) }}"
                class="px-5 py-2.5 {{ request('status') === 'inactive' ? 'bg-indigo-600 text-white font-extrabold border-indigo-700 shadow-md' : 'bg-white border-2 border-slate-300 text-slate-700 font-bold hover:bg-slate-50' }} text-xs rounded-xl flex-shrink-0 transition-all">
                Tidak Aktif
            </a>
        </div>

        <!-- Daftar Kartu Guru -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($teachers as $teacher)
                <div
                    class="bg-white rounded-2xl border-2 border-slate-200 shadow-sm p-4.5 flex flex-col justify-between space-y-3 hover:border-indigo-600 transition-all">
                    <div class="flex items-center justify-between space-x-3">
                        <div class="flex items-center space-x-3.5 min-w-0">
                            <div
                                class="w-12 h-12 rounded-xl bg-indigo-100 border border-indigo-300 text-indigo-700 flex items-center justify-center font-extrabold text-sm flex-shrink-0">
                                {{ strtoupper(substr($teacher->user?->name ?? 'G', 0, 2)) }}
                            </div>
                            <div class="space-y-0.5 truncate">
                                <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate">
                                    {{ $teacher->user?->name ?? 'Guru' }}</h3>
                                <p class="text-xs text-slate-600 font-semibold truncate">NIP: {{ $teacher->nip ?? '-' }} •
                                    {{ $teacher->subject ?? 'Umum' }}</p>
                            </div>
                        </div>
                        <span
                            class="px-3 py-1 {{ $teacher->status === 'active' ? 'bg-emerald-100 border-emerald-300 text-emerald-800' : 'bg-rose-100 border-rose-300 text-rose-800' }} border text-xs font-extrabold rounded-lg flex-shrink-0">
                            {{ $teacher->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-100 pt-3 text-xs">
                        <span class="text-slate-400 font-medium truncate">{{ $teacher->user?->email }}</span>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('admin.guru.show', $teacher) }}"
                                class="rounded-lg border border-slate-200 px-2.5 py-1.5 font-bold text-slate-600 hover:bg-slate-50">Detail</a>
                            <a href="{{ route('admin.guru.edit', $teacher) }}"
                                class="rounded-lg bg-indigo-50 px-2.5 py-1.5 font-bold text-indigo-600 hover:bg-indigo-100">Edit</a>
                            <form method="POST" action="{{ route('admin.guru.destroy', $teacher) }}"
                                onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-lg bg-rose-50 px-2.5 py-1.5 font-bold text-rose-600 hover:bg-rose-100">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full rounded-2xl border-2 border-dashed border-slate-300 bg-white p-12 text-center text-xs font-semibold text-slate-400">
                    Tidak ada data guru yang sesuai kriteria.
                </div>
            @endforelse
        </div>

        @if ($teachers->hasPages())
            <div class="pt-4">
                {{ $teachers->links() }}
            </div>
        @endif

        <!-- Tombol Floating Action (Tambah Guru) -->
        <div class="fixed bottom-24 right-4 z-50 md:bottom-8 md:right-8 lg:right-12">
            <a href="{{ route('admin.guru.create') }}"
                class="w-14 h-14 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow-lg shadow-indigo-300 flex items-center justify-center transition-all hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>

    </div>

    @include('components.footerMobile_admin')

</body>

</html>