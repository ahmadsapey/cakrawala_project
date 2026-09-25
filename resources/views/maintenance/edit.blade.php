<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $label }} | Cakrawala Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50/50 via-slate-50 to-blue-50/40 font-sans text-slate-800 antialiased">
    <header class="border-b border-slate-200/80 bg-white/90 backdrop-blur-md">
       
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="mb-6 rounded-3xl border-2 border-indigo-200 bg-white/90 p-6 shadow-sm sm:p-8">
            <p class="text-[11px] font-black uppercase tracking-[0.16em] text-indigo-600">Edit {{ $label }}</p>
            <h1 class="mt-2 text-2xl font-black tracking-tight text-slate-900">{{ $content->title }}</h1>
            <p class="mt-1 text-sm font-semibold text-slate-500">Perubahan akan langsung dipakai pada landing page.</p>
        </header>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border-2 border-rose-300 bg-rose-50 px-5 py-4 text-sm font-bold text-rose-800">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('maintenance.landing.update', $content) }}" enctype="multipart/form-data" class="rounded-3xl border-2 border-indigo-100 bg-white/90 p-6 shadow-sm sm:p-8">
            @include('maintenance._form')
        </form>
    </main>
</body>
</html>
