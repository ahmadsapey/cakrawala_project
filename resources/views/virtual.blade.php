<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lokasi Cakrawala Educentre</title>
	<script src="https://cdn.tailwindcss.com"></script>
    @include('components.fonts')
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased">
	@include('components.header')

	<main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-12 lg:py-16">
		<section class="grid items-center gap-8 lg:grid-cols-[0.85fr_1.15fr] lg:gap-12">
			<div class="space-y-5">
				<span class="inline-flex rounded-full border border-indigo-200 bg-indigo-50 px-3 py-1 text-xs font-black uppercase tracking-wider text-indigo-700">
					Lokasi Kami
				</span>
				<h1 class="text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
					Temukan Cakrawala Educentre
				</h1>
				<p class="max-w-xl text-sm leading-relaxed text-slate-600 sm:text-base">
					Lihat lokasi kami di peta dan dapatkan petunjuk arah langsung melalui Google Maps.
				</p>

				<div class="space-y-3 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
					<div class="flex items-start gap-3">
						<svg class="mt-0.5 h-5 w-5 shrink-0 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s7-5.2 7-11a7 7 0 1 0-14 0c0 5.8 7 11 7 11Z"/>
							<circle cx="12" cy="10" r="2.2" stroke-width="1.8"/>
						</svg>
						<div>
							<p class="text-xs font-black uppercase tracking-wider text-slate-400">Tujuan pencarian</p>
							<p class="mt-1 text-sm font-bold text-slate-900">Cakrawala Educentre, Indonesia</p>
						</div>
					</div>
					<a href="https://www.google.com/maps/search/?api=1&query=Cakrawala+Educentre+Indonesia" target="_blank" rel="noopener noreferrer" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-colors hover:bg-indigo-700 sm:w-auto">
						Buka di Google Maps
						<span aria-hidden="true">&rarr;</span>
					</a>
				</div>
			</div>

			<div class="overflow-hidden rounded-3xl border border-slate-200 bg-white p-2 shadow-xl shadow-slate-200/70">
				<div class="aspect-[4/3] overflow-hidden rounded-2xl bg-slate-200 sm:aspect-[16/10]">
					<iframe
						title="Peta lokasi Cakrawala Educentre"
						src="https://www.google.com/maps?q=Cakrawala+Educentre+Indonesia&output=embed"
						class="h-full w-full border-0"
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade">
					</iframe>
				</div>
			</div>
		</section>
	</main>
</body>

</html>
