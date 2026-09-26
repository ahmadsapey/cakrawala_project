<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $classroom ? 'Edit Kelas' : 'Tambah Kelas' }} | Cakrawala Educentre</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('components.fonts')
</head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
    @include('components.headerAdmin')

    <main class="mx-auto max-w-3xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
        <div class="flex items-center justify-between rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm sm:p-8">
            <div>
                <p class="text-xs font-black uppercase tracking-wider text-indigo-700">Modul Admin</p>
                <h1 class="mt-2 text-2xl font-black text-slate-900">{{ $classroom ? 'Edit Kelas' : 'Tambah Kelas Baru' }}</h1>
                <p class="mt-1 text-sm font-semibold text-slate-500">Lengkapi informasi pengajar, mata pelajaran, ruang, dan jadwal kelas.</p>
            </div>
            <a href="{{ route('admin.kelas.index') }}" class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-100 transition">
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 p-5 text-sm text-rose-700">
                <p class="font-bold mb-2">Terjadi kesalahan pada input:</p>
                <ul class="list-disc space-y-1 pl-5 text-xs font-semibold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ $classroom ? route('admin.kelas.update', $classroom) : route('admin.kelas.store') }}" class="space-y-6 rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm sm:p-8">
            @csrf
            @if ($classroom) @method('PUT') @endif

            <!-- Bagian 1: Data Utama Kelas -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-50 text-xs font-black text-indigo-600">1</span>
                    <h2 class="text-sm font-black uppercase tracking-wider text-slate-800">Informasi Kelas & Pengampu</h2>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="block text-xs font-bold text-slate-700" for="name">
                        Nama Kelas <span class="text-rose-500">*</span>
                        <input id="name" name="name" value="{{ old('name', $classroom?->name) }}" required placeholder="Contoh: 7A, 10 IPA 1, Digital Kreatif" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </label>

                    <label class="block text-xs font-bold text-slate-700" for="grade_level">
                        Tingkat / Jenjang <span class="text-rose-500">*</span>
                        <input id="grade_level" name="grade_level" value="{{ old('grade_level', $classroom?->grade_level) }}" required placeholder="Contoh: 7, 8, 9, 10, Umum" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </label>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="block text-xs font-bold text-slate-700" for="teacher_id">
                        Guru Pengampu / Wali Kelas <span class="text-rose-500">*</span>
                        <select id="teacher_id" name="teacher_id" required class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                            <option value="">Pilih guru pengampu</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @selected(old('teacher_id', $classroom?->teacher_id) == $teacher->id)>
                                    {{ $teacher->user?->name }} ({{ $teacher->subject }})
                                </option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block text-xs font-bold text-slate-700" for="subject">
                        Mata Pelajaran
                        <input id="subject" name="subject" value="{{ old('subject', $classroom?->subject) }}" list="subject-list" placeholder="Contoh: Bahasa Indonesia, Fisika, Digital Kreatif" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                        <datalist id="subject-list">
                            @foreach ($subjects as $s)
                                <option value="{{ $s->name }}"></option>
                            @endforeach
                            @foreach ($teachers->pluck('subject')->filter()->unique() as $ts)
                                <option value="{{ $ts }}"></option>
                            @endforeach
                        </datalist>
                    </label>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700" for="section">
                        Ruang / Sesi Pembelajaran
                        <input id="section" name="section" value="{{ old('section', $classroom?->section) }}" placeholder="Contoh: Ruang 7A, Lab Komputer, Gedung B - EL5-E2" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </label>
                </div>
            </div>

            <!-- Bagian 2: Jadwal & Tautan Pembelajaran -->
            <div class="space-y-4 border-t border-slate-100 pt-5">
                <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-50 text-xs font-black text-indigo-600">2</span>
                    <h2 class="text-sm font-black uppercase tracking-wider text-slate-800">Jadwal & Waktu Belajar</h2>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <label class="block text-xs font-bold text-slate-700" for="day_of_week">
                        Hari Belajar
                        <select id="day_of_week" name="day_of_week" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                            <option value="">Pilih Hari</option>
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                <option value="{{ $day }}" @selected(old('day_of_week', $schedule?->day_of_week) == $day)>{{ $day }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block text-xs font-bold text-slate-700" for="start_time">
                        Jam Mulai
                        <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $schedule?->start_time) }}" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </label>

                    <label class="block text-xs font-bold text-slate-700" for="end_time">
                        Jam Selesai
                        <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $schedule?->end_time) }}" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </label>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700" for="online_meeting_url">
                        Tautan Kelas Online / Meeting (Opsional)
                        <input type="url" id="online_meeting_url" name="online_meeting_url" value="{{ old('online_meeting_url', $classroom?->online_meeting_url ?? $schedule?->online_meeting_url) }}" placeholder="https://meet.google.com/xxx-xxxx-xxx atau tautan Zoom" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                    </label>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full rounded-2xl bg-indigo-600 px-5 py-3.5 text-sm font-black text-white hover:bg-indigo-700 shadow-md transition-all">
                    {{ $classroom ? 'Simpan Perubahan Kelas' : 'Buat Kelas' }}
                </button>
            </div>
        </form>
    </main>

    @include('components.footerMobile_admin')
</body>
</html>
