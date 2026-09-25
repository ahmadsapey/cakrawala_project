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

<body class="min-h-screen bg-gradient-to-br from-indigo-50/50 via-slate-50 to-blue-50/40 pb-32 font-sans text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">

    @include('components.headerAdmin')

    <!-- Container Utama -->
    <main class="mx-auto flex w-full max-w-6xl flex-col space-y-6 px-4 py-8 sm:px-6 lg:px-12">

        <!-- Header Halaman -->
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pt-2">
            <div>
                <span class="text-xs font-black uppercase tracking-[0.18em] text-indigo-700 bg-indigo-50 border border-indigo-200 px-3 py-1.5 rounded-xl inline-block shadow-2xs">Modul Admin</span>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Manajemen Guru</h1>
                <p class="text-xs sm:text-sm text-slate-600 font-bold mt-1">Kelola data tenaga pengajar dan penugasan mata pelajaran.</p>
            </div>
            <a href="{{ route('admin.guru.create') }}"
                class="rounded-2xl bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 px-5 py-3 text-center text-xs font-black text-white shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-blue-800 transition-all inline-flex items-center justify-center gap-2">
                <span class="text-base leading-none font-bold">+</span> Tambah Guru
            </a>
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
        <form method="GET" action="{{ route('admin.guru.index') }}"
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
                placeholder="Cari nama guru, NIP, atau mata pelajaran..."
                class="w-full bg-transparent text-xs sm:text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none">
            @if (request('search'))
                <a href="{{ route('admin.guru.index', array_filter(['status' => request('status')])) }}"
                    class="text-xs font-black text-indigo-600 hover:text-indigo-800 bg-indigo-50 border border-indigo-200 px-3 py-1.5 rounded-xl">Reset</a>
            @endif
        </form>

        <!-- Filter Tab (Semua, Aktif, Tidak Aktif) -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-1 scrollbar-none">
            <a href="{{ route('admin.guru.index', array_filter(['search' => request('search')])) }}"
                class="px-5 py-3 {{ !request('status') ? 'bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 text-white shadow-sm' : 'bg-white/90 border-2 border-indigo-200 text-slate-700 hover:bg-indigo-50/50' }} font-black text-xs rounded-2xl flex-shrink-0 transition-all">
                Semua Guru
            </a>
            <a href="{{ route('admin.guru.index', array_filter(['status' => 'active', 'search' => request('search')])) }}"
                class="px-5 py-3 {{ request('status') === 'active' ? 'bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 text-white shadow-sm' : 'bg-white/90 border-2 border-indigo-200 text-slate-700 hover:bg-indigo-50/50' }} font-black text-xs rounded-2xl flex-shrink-0 transition-all">
                Guru Aktif
            </a>
            <a href="{{ route('admin.guru.index', array_filter(['status' => 'inactive', 'search' => request('search')])) }}"
                class="px-5 py-3 {{ request('status') === 'inactive' ? 'bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 text-white shadow-sm' : 'bg-white/90 border-2 border-indigo-200 text-slate-700 hover:bg-indigo-50/50' }} font-black text-xs rounded-2xl flex-shrink-0 transition-all">
                Tidak Aktif
            </a>
        </div>

        <!-- Daftar Kartu Guru -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($teachers as $teacher)
                <div
                    class="bg-white/90 backdrop-blur-md rounded-3xl border-2 border-indigo-100 shadow-sm p-6 flex flex-col justify-between space-y-4 hover:border-indigo-300 transition-all">
                    <div class="flex items-center justify-between space-x-3">
                        <div class="flex items-center space-x-4 min-w-0">
                            <div
                                class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-200 text-indigo-700 flex items-center justify-center font-black text-xs flex-shrink-0">
                                {{ strtoupper(substr($teacher->user?->name ?? 'G', 0, 2)) }}
                            </div>
                            <div class="space-y-1 truncate">
                                <h3 class="text-sm sm:text-base font-black text-slate-900 truncate">
                                    {{ $teacher->user?->name ?? 'Guru' }}</h3>
                                <p class="text-xs text-slate-500 font-bold truncate">NIP: {{ $teacher->nip ?? '-' }} •
                                    {{ $teacher->subject ?? 'Umum' }}</p>
                            </div>
                        </div>
                        <span
                            class="px-3 py-1.5 {{ $teacher->status === 'active' ? 'bg-emerald-50 border-emerald-300 text-emerald-800' : 'bg-rose-50 border-rose-300 text-rose-800' }} border text-xs font-black rounded-xl flex-shrink-0">
                            {{ $teacher->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between border-t-2 border-slate-100 pt-4 text-xs">
                        <span class="text-slate-500 font-bold truncate">{{ $teacher->user?->email }}</span>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('admin.guru.show', $teacher) }}"
                                class="rounded-xl border-2 border-indigo-200 px-3 py-2 font-black text-indigo-700 hover:bg-indigo-50 transition-all">Detail</a>
                            <a href="{{ route('admin.guru.edit', $teacher) }}"
                                class="rounded-xl bg-indigo-50 border border-indigo-200 px-3 py-2 font-black text-indigo-700 hover:bg-indigo-100 transition-all">Edit</a>
                            <form method="POST" action="{{ route('admin.guru.destroy', $teacher) }}"
                                onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-xl bg-rose-50 border border-rose-200 px-3 py-2 font-black text-rose-700 hover:bg-rose-100 transition-all">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full rounded-3xl border-2 border-dashed border-slate-300 bg-white/85 backdrop-blur-md p-12 text-center text-xs font-bold text-slate-500 shadow-2xs space-y-1">
                    <p class="text-base font-black text-slate-800">Tidak ada data guru yang sesuai kriteria.</p>
                    <p class="text-xs font-bold text-slate-500">Coba ubah kata kunci pencarian atau filter status.</p>
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
                class="w-14 h-14 bg-gradient-to-r from-indigo-600 to-blue-700 border-2 border-indigo-700 hover:from-indigo-700 hover:to-blue-800 text-white rounded-full shadow-lg shadow-indigo-300 flex items-center justify-center transition-all hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>

    </main>

    @include('components.footerMobile_admin')

</body>

</html>