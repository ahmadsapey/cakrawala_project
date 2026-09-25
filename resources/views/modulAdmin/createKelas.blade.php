<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>{{ $classroom ? 'Edit Kelas' : 'Tambah Kelas' }} | Cakrawala Educentre</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="min-h-screen bg-slate-100 pb-28 font-sans text-slate-800 antialiased">
@include('components.headerAdmin')
<main class="mx-auto max-w-2xl space-y-6 px-4 py-8 sm:px-6 lg:px-12">
	<div class="rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm"><p class="text-xs font-black uppercase tracking-wider text-indigo-700">Modul Admin</p><h1 class="mt-2 text-2xl font-black text-slate-900">{{ $classroom ? 'Edit Kelas' : 'Tambah Kelas' }}</h1></div>
	@if ($errors->any())<div class="rounded-2xl border border-rose-200 bg-rose-50 p-5 text-sm text-rose-700"><ul class="list-disc space-y-1 pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
	<form method="POST" action="{{ $classroom ? route('admin.kelas.update', $classroom) : route('admin.kelas.store') }}" class="space-y-5 rounded-3xl border border-indigo-100 bg-white p-6 shadow-sm sm:p-8">
		@csrf @if ($classroom) @method('PUT') @endif
		<label class="block text-sm font-bold">Guru Pengampu<select name="teacher_id" required class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3"><option value="">Pilih guru</option>@foreach ($teachers as $teacher)<option value="{{ $teacher->id }}" @selected(old('teacher_id', $classroom?->teacher_id) == $teacher->id)>{{ $teacher->user?->name }} · {{ $teacher->subject }}</option>@endforeach</select></label>
		<label class="block text-sm font-bold">Nama Kelas<input name="name" value="{{ old('name', $classroom?->name) }}" required class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3"></label>
		<div class="grid gap-5 sm:grid-cols-2"><label class="block text-sm font-bold">Tingkat<input name="grade_level" value="{{ old('grade_level', $classroom?->grade_level) }}" required class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3"></label><label class="block text-sm font-bold">Bagian/Link pertemuan<input name="section" value="{{ old('section', $classroom?->section) }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3"></label></div>
		<label class="block text-sm font-bold">Deskripsi<textarea name="description" rows="4" class="mt-2 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">{{ old('description', $classroom?->description) }}</textarea></label>
		<button class="w-full rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-black text-white hover:bg-indigo-700">{{ $classroom ? 'Simpan Perubahan' : 'Buat Kelas' }}</button>
	</form>
</main>
@include('components.footerMobile_admin')
</body></html>
