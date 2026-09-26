<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Maintenance | {{ $brandContent?->title ?? 'Cakrawala Educentre' }}</title>
	<script src="https://cdn.tailwindcss.com"></script>
    @include('components.fonts')
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-100 px-4 font-sans text-slate-800 antialiased">
	<main class="w-full max-w-md rounded-3xl border-2 border-slate-200 bg-white p-7 shadow-xl sm:p-9">
		<div class="mb-8 flex items-center gap-3">
			<img src="{{ $brandContent?->image_url ?? asset('images/logoCakrawala.png') }}" alt="Logo {{ $brandContent?->title ?? 'Cakrawala Educentre' }}" class="h-11 w-11 object-contain">
			<div>
				<p class="text-sm font-black uppercase tracking-tight text-slate-900">{{ $brandContent?->title ?? 'Cakrawala Educentre' }}</p>
				<p class="text-[10px] font-black uppercase tracking-[0.16em] text-indigo-600">Maintenance Portal</p>
			</div>
		</div>

		<div class="mb-7">
			<h1 class="text-2xl font-black tracking-tight text-slate-900">Login Maintenance</h1>
			<p class="mt-1 text-sm font-semibold text-slate-500">Masuk untuk mengelola konten landing page.</p>
		</div>

		@if ($errors->any())
			<div class="mb-5 rounded-xl border-2 border-rose-300 bg-rose-50 px-4 py-3 text-xs font-bold text-rose-700">{{ $errors->first() }}</div>
		@endif

		<form method="POST" action="{{ route('maintenance.login.submit') }}" class="space-y-5">
			@csrf
			<label class="block space-y-1.5 text-xs font-black uppercase tracking-wider text-slate-700">Email
				<input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-semibold normal-case tracking-normal outline-none transition focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20">
			</label>
			<label class="block space-y-1.5 text-xs font-black uppercase tracking-wider text-slate-700">Password
				<input type="password" name="password" required autocomplete="current-password" class="w-full rounded-xl border-2 border-slate-300 bg-white px-4 py-3 text-sm font-semibold normal-case tracking-normal outline-none transition focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20">
			</label>
			<button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-3.5 text-sm font-black text-white transition hover:bg-indigo-700">Masuk ke Maintenance</button>
		</form>
	</main>
</body>
</html>
