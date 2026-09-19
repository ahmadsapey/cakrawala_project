<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kelola Landing Page | Cakrawala Educentre</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = { theme: { extend: { colors: { primary: '#4F46E5', branddark: '#0B0F19' } } } };
	</script>
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased pb-28">
	@include('components.headerAdmin')

	<main class="mx-auto flex min-h-screen w-full max-w-md flex-col gap-6 p-4 sm:p-6 md:max-w-7xl md:gap-8 md:p-8 lg:px-12">
		<header class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
			<div>
				<p class="text-xs font-black uppercase tracking-wider text-indigo-600">Konten publik</p>
				<h1 class="mt-1 text-2xl font-black tracking-tight text-slate-900">Kelola Landing Page</h1>
				<p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-500">Perubahan di sini langsung dipakai oleh kartu Program & Modul Pilihan dan Paket Layanan di halaman utama.</p>
			</div>
			<a href="{{ url('/') }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 shadow-sm transition hover:border-indigo-300 hover:text-indigo-600">
				Lihat landing page
			</a>
		</header>

		@if (session('status'))
			<div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700" role="status">{{ session('status') }}</div>
		@endif

		@if ($errors->any())
			<div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
				<p class="font-bold">Periksa kembali input konten.</p>
				<ul class="mt-1 list-inside list-disc">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<section class="grid gap-6 lg:grid-cols-2">
			@foreach (['program' => 'Program & Modul Pilihan', 'package' => 'Paket Layanan'] as $type => $heading)
				<form action="{{ route('admin.landing.store') }}" method="POST" class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
					@csrf
					<input type="hidden" name="type" value="{{ $type }}">
					<div class="flex items-center justify-between gap-3">
						<div>
							<h2 class="text-base font-black text-slate-900">Tambah {{ $heading }}</h2>
							<p class="mt-1 text-xs text-slate-500">Isi data yang akan tampil sebagai kartu baru.</p>
						</div>
						<span class="rounded-full bg-indigo-50 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-indigo-600">{{ $type }}</span>
					</div>
					<div class="mt-5 grid gap-4">
						<div class="grid gap-4 sm:grid-cols-2">
							<label class="text-xs font-bold text-slate-600">Badge<input name="badge" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500" placeholder="INTERAKTIF"></label>
							<label class="text-xs font-bold text-slate-600">Urutan<input type="number" name="sort_order" value="{{ $type === 'program' ? $programs->count() + 1 : $packages->count() + 1 }}" min="0" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500"></label>
						</div>
						<label class="text-xs font-bold text-slate-600">Judul<input name="title" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500" placeholder="Nama konten"></label>
						<label class="text-xs font-bold text-slate-600">Deskripsi<textarea name="description" rows="2" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500" placeholder="Penjelasan singkat yang tampil di landing page"></textarea></label>
						<label class="text-xs font-bold text-slate-600">URL gambar <span class="font-normal text-slate-400">(opsional untuk paket)</span><input type="url" name="image_url" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500" placeholder="https://..."></label>
						<div class="grid gap-4 sm:grid-cols-2">
							<label class="text-xs font-bold text-slate-600">Harga<input name="price" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500" placeholder="Rp 75.000"></label>
							<label class="text-xs font-bold text-slate-600">Akhiran harga<input name="price_suffix" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500" placeholder="/bln"></label>
						</div>
						<label class="text-xs font-bold text-slate-600">Info singkat<input name="meta" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500" placeholder="4.9 | 12 Sesi Materi"></label>
						<label class="text-xs font-bold text-slate-600">Fitur<textarea name="features" rows="2" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500" placeholder="Satu fitur per baris"></textarea></label>
						<label class="text-xs font-bold text-slate-600">Label tombol<input name="cta_label" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500" placeholder="Lihat detail"></label>
						<label class="inline-flex items-center gap-2 text-xs font-bold text-slate-600"><input type="checkbox" name="is_featured" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600"> Tandai sebagai pilihan favorit</label>
						<button class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white transition hover:bg-indigo-700" type="submit">Tambah konten</button>
					</div>
				</form>
			@endforeach
		</section>

		@foreach (['programs' => 'Program & Modul Pilihan', 'packages' => 'Paket Layanan'] as $collection => $heading)
			<section class="space-y-4">
				<div class="flex items-center justify-between gap-3">
					<h2 class="text-lg font-black tracking-tight text-slate-900">{{ $heading }}</h2>
					<span class="text-xs font-semibold text-slate-400">{{ ${$collection}->count() }} konten</span>
				</div>
				<div class="grid gap-4 xl:grid-cols-2">
					@forelse (${$collection} as $content)
						<form action="{{ route('admin.landing.update', $content) }}" method="POST" class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
							@csrf
							@method('PUT')
							<input type="hidden" name="type" value="{{ $content->type }}">
							<div class="flex items-start justify-between gap-3">
								<div class="min-w-0">
									<span class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-slate-500">{{ $content->badge }}</span>
									<h3 class="mt-3 truncate text-base font-black text-slate-900">{{ $content->title }}</h3>
								</div>
								<span class="shrink-0 rounded-full {{ $content->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }} px-2.5 py-1 text-[10px] font-black">{{ $content->is_active ? 'Tampil' : 'Disembunyikan' }}</span>
							</div>
							<div class="mt-5 grid gap-4">
								<div class="grid gap-4 sm:grid-cols-2">
									<label class="text-xs font-bold text-slate-600">Badge<input name="badge" value="{{ $content->badge }}" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500"></label>
									<label class="text-xs font-bold text-slate-600">Urutan<input type="number" name="sort_order" value="{{ $content->sort_order }}" min="0" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500"></label>
								</div>
								<label class="text-xs font-bold text-slate-600">Judul<input name="title" value="{{ $content->title }}" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500"></label>
								<label class="text-xs font-bold text-slate-600">Deskripsi<textarea name="description" rows="2" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500">{{ $content->description }}</textarea></label>
								<label class="text-xs font-bold text-slate-600">URL gambar<input type="url" name="image_url" value="{{ $content->image_url }}" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500"></label>
								<div class="grid gap-4 sm:grid-cols-2">
									<label class="text-xs font-bold text-slate-600">Harga<input name="price" value="{{ $content->price }}" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500"></label>
									<label class="text-xs font-bold text-slate-600">Akhiran harga<input name="price_suffix" value="{{ $content->price_suffix }}" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500"></label>
								</div>
								<label class="text-xs font-bold text-slate-600">Info singkat<input name="meta" value="{{ $content->meta }}" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500"></label>
								<label class="text-xs font-bold text-slate-600">Fitur<textarea name="features" rows="2" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500">{{ implode("\n", $content->features ?? []) }}</textarea></label>
								<label class="text-xs font-bold text-slate-600">Label tombol<input name="cta_label" value="{{ $content->cta_label }}" class="mt-1.5 w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm font-normal outline-none focus:border-indigo-500"></label>
								<div class="flex flex-wrap items-center gap-5">
									<label class="inline-flex items-center gap-2 text-xs font-bold text-slate-600"><input type="checkbox" name="is_active" value="1" @checked($content->is_active) class="h-4 w-4 rounded border-slate-300 text-indigo-600"> Tampilkan di landing</label>
									<label class="inline-flex items-center gap-2 text-xs font-bold text-slate-600"><input type="checkbox" name="is_featured" value="1" @checked($content->is_featured) class="h-4 w-4 rounded border-slate-300 text-indigo-600"> Pilihan favorit</label>
								</div>
								<div class="flex flex-wrap gap-3">
									<button class="rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-indigo-700" type="submit">Simpan perubahan</button>
									<button form="delete-content-{{ $content->id }}" class="rounded-xl border border-rose-200 px-4 py-2.5 text-xs font-bold text-rose-600 transition hover:bg-rose-50" type="submit">Hapus</button>
								</div>
							</div>
						</form>
						<form id="delete-content-{{ $content->id }}" action="{{ route('admin.landing.destroy', $content) }}" method="POST" class="hidden">
							@csrf
							@method('DELETE')
						</form>
					@empty
						<div class="rounded-3xl border border-dashed border-slate-300 bg-white p-8 text-center text-sm text-slate-500">Belum ada konten pada bagian ini.</div>
					@endforelse
				</div>
			</section>
		@endforeach
	</main>

	@include('components.footerMobile_admin')
</body>
</html>
