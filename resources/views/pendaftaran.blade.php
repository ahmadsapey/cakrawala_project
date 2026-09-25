<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Daftar sebagai siswa di Cakrawala Educentre.">
	<title>Pendaftaran Siswa | Cakrawala Educentre</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primary: '#4F46E5',
						ink: '#111827',
					}
				}
			}
		}
	</script>
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">
	<main class="relative isolate overflow-hidden px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
		<div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-96 bg-[radial-gradient(circle_at_top_right,_rgba(99,102,241,0.22),_transparent_60%),radial-gradient(circle_at_top_left,_rgba(14,165,233,0.16),_transparent_55%)]"></div>

		<div class="mx-auto max-w-6xl">
			<div class="mb-8 flex items-center justify-between gap-4">
				<a href="{{ route('landing.page') }}" class="group inline-flex items-center gap-3" aria-label="Kembali ke beranda">
					<span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-200 transition-transform group-hover:-translate-y-0.5">
						<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l-5 5 5 5M8 12h8"/>
						</svg>
					</span>
					<span class="hidden text-sm font-black uppercase tracking-wide text-slate-900 sm:block">Cakrawala Educentre</span>
				</a>
				<a href="{{ route('siswa.login') }}" class="text-sm font-bold text-indigo-600 transition-colors hover:text-indigo-800">Sudah punya akun?</a>
			</div>

			<div class="grid overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-2xl shadow-slate-300/40 lg:grid-cols-[0.85fr_1.15fr]">
				<section class="relative overflow-hidden bg-slate-950 p-7 text-white sm:p-10 lg:p-12">
					<div class="absolute -right-24 -top-24 h-64 w-64 rounded-full border-[24px] border-indigo-500/20"></div>
					<div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full border-[24px] border-sky-400/10"></div>
					<div class="relative flex h-full flex-col justify-between gap-12">
						<div class="space-y-6">
							<span class="inline-flex items-center gap-2 rounded-full border border-indigo-400/30 bg-indigo-400/10 px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.18em] text-indigo-200">
								<span class="h-2 w-2 rounded-full bg-emerald-400"></span>
								Pendaftaran siswa
							</span>
							<div class="space-y-4">
								<h1 class="max-w-md text-3xl font-black leading-tight tracking-tight sm:text-4xl">Mulai perjalanan belajarmu dari sini.</h1>
								<p class="max-w-md text-sm leading-7 text-slate-300">Buat akun siswa untuk mengakses kelas, materi, tugas, dan evaluasi belajar di Cakrawala Educentre.</p>
							</div>
						</div>
						<div class="grid gap-4 border-t border-white/10 pt-6 text-sm text-slate-300 sm:grid-cols-2">
							<div class="flex gap-3"><span class="text-emerald-400">01</span><span>Profil belajar tersimpan rapi</span></div>
							<div class="flex gap-3"><span class="text-emerald-400">02</span><span>Akses materi kapan saja</span></div>
							<div class="flex gap-3"><span class="text-emerald-400">03</span><span>Pantau tugas dan progresmu</span></div>
							<div class="flex gap-3"><span class="text-emerald-400">04</span><span>Lanjut ke proses pembayaran</span></div>
						</div>
					</div>
				</section>

				<section class="p-6 sm:p-10 lg:p-12">
					<div class="mb-8 space-y-2">
						<p class="text-xs font-black uppercase tracking-[0.2em] text-indigo-600">Formulir akun</p>
						<h2 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">Lengkapi data diri</h2>
						<p class="text-sm leading-6 text-slate-500">Gunakan data yang valid agar proses pendaftaran berjalan lancar.</p>
					</div>

					@if ($errors->any())
						<div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700" role="alert">
							<p class="font-bold">Periksa kembali data berikut:</p>
							<ul class="mt-2 list-disc space-y-1 pl-5">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form action="{{ route('siswa.register.submit') }}" method="POST" class="space-y-5">
						@csrf
						<div class="grid gap-5 sm:grid-cols-2">
							<div class="space-y-2 sm:col-span-2">
								<label for="name" class="text-sm font-bold text-slate-700">Nama lengkap</label>
								<input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" placeholder="Contoh: Rayyan Pratama" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
							</div>
							<div class="space-y-2 sm:col-span-2">
								<label for="email" class="text-sm font-bold text-slate-700">Alamat email</label>
								<input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
							</div>
							<div class="space-y-2">
								<label for="nisn" class="text-sm font-bold text-slate-700">NISN</label>
								<input id="nisn" name="nisn" type="text" value="{{ old('nisn') }}" required maxlength="20" inputmode="numeric" placeholder="Nomor induk siswa" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
							</div>
							<div class="space-y-2">
								<label for="class_name" class="text-sm font-bold text-slate-700">Kelas saat ini</label>
								<input id="class_name" name="class_name" type="text" value="{{ old('class_name') }}" required maxlength="100" placeholder="Contoh: XII IPA 1" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
							</div>
							<div class="space-y-2">
								<label for="password" class="text-sm font-bold text-slate-700">Kata sandi</label>
								<input id="password" name="password" type="password" required minlength="8" autocomplete="new-password" placeholder="Minimal 8 karakter" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
							</div>
							<div class="space-y-2">
								<label for="password_confirmation" class="text-sm font-bold text-slate-700">Konfirmasi kata sandi</label>
								<input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password" placeholder="Ulangi kata sandi" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
							</div>
						</div>

						<label class="flex items-start gap-3 pt-1 text-sm leading-6 text-slate-600">
							<input name="terms" type="checkbox" required class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
							<span>Saya menyetujui proses pendaftaran dan memastikan data yang saya masukkan sudah benar.</span>
						</label>

						<button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition hover:-translate-y-0.5 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 active:translate-y-0">
							Buat akun siswa
							<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6"/></svg>
						</button>
					</form>
				</section>
			</div>
		</div>
	</main>
</body>
</html>
