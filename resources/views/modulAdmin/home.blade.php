<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin | Cakrawala Educentre</title>
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
<body class="bg-[#F8FAFC] text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.headerAdmin')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-md flex-col space-y-6 bg-[#F8FAFC] p-4 sm:p-6 md:max-w-7xl md:space-y-8 md:p-8 lg:px-12">

        <!-- Section 1: Ikhtisar Cakrawala -->
        <div class="space-y-3 pt-2">
            <h2 class="text-xs font-black uppercase tracking-wider text-slate-400 px-1">Ikhtisar Cakrawala</h2>
            
            <!-- Grid 4 Kartu Statistik -->
            <div class="grid grid-cols-2 gap-3">
                
                <!-- Kartu 1: Mahasiswa -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-2">
                    <div class="w-9 h-9 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Mahasiswa</span>
                        <div class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">245</div>
                    </div>
                </div>

                <!-- Kartu 2: Total Guru -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-2">
                    <div class="w-9 h-9 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Guru</span>
                        <div class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">32</div>
                    </div>
                </div>

                <!-- Kartu 3: Pembayaran Juli -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-2">
                    <div class="w-9 h-9 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pembayaran Juli</span>
                        <div class="text-base sm:text-lg font-black text-slate-900 tracking-tight">Rp 125.5M</div>
                    </div>
                </div>

                <!-- Kartu 4: Tunggakan -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 space-y-2">
                    <div class="w-9 h-9 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tunggakan</span>
                        <div class="text-base sm:text-lg font-black text-rose-600 tracking-tight">Rp 12.3M</div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Section 2: Aktivitas Terbaru -->
        <div class="space-y-3">
            <h2 class="text-xs font-black uppercase tracking-wider text-slate-400 px-1">Aktivitas Terbaru</h2>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-4">
                
                <!-- Aktivitas 1 -->
                <div class="flex items-center justify-between pb-3.5 border-b border-slate-50">
                    <div class="flex items-center space-x-3.5 overflow-hidden">
                        <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0 font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div class="space-y-0.5 overflow-hidden">
                            <h4 class="text-xs font-black text-slate-900 truncate">Mahasiswa baru terda...</h4>
                            <p class="text-[10px] text-slate-400 font-medium truncate">Budi Santoso - XI IPA 2</p>
                        </div>
                    </div>
                    <span class="text-[10px] text-slate-400 font-medium flex-shrink-0 pl-2">10 menit yang lalu</span>
                </div>

                <!-- Aktivitas 2 -->
                <div class="flex items-center justify-between pb-3.5 border-b border-slate-50">
                    <div class="flex items-center space-x-3.5 overflow-hidden">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="space-y-0.5 overflow-hidden">
                            <h4 class="text-xs font-black text-slate-900 truncate">Pembayaran SPP diteri...</h4>
                            <p class="text-[10px] text-slate-400 font-medium truncate">Invoice #INV-2026-0692</p>
                        </div>
                    </div>
                    <span class="text-[10px] text-slate-400 font-medium flex-shrink-0 pl-2">45 menit yang lalu</span>
                </div>

                <!-- Aktivitas 3 -->
                <div class="flex items-center justify-between pb-3.5 border-b border-slate-50">
                    <div class="flex items-center space-x-3.5 overflow-hidden">
                        <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div class="space-y-0.5 overflow-hidden">
                            <h4 class="text-xs font-black text-slate-900 truncate">Guru baru ditambahkan</h4>
                            <p class="text-[10px] text-slate-400 font-medium truncate">Ahmad Fauzi S.Pd - Matematika</p>
                        </div>
                    </div>
                    <span class="text-[10px] text-slate-400 font-medium flex-shrink-0 pl-2">2 jam yang lalu</span>
                </div>

                <!-- Aktivitas 4 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3.5 overflow-hidden">
                        <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div class="space-y-0.5 overflow-hidden">
                            <h4 class="text-xs font-black text-slate-900 truncate">Tunggakan Terdeteksi</h4>
                            <p class="text-[10px] text-slate-400 font-medium truncate">Laporan Praktikum Rayyan</p>
                        </div>
                    </div>
                    <span class="text-[10px] text-slate-400 font-medium flex-shrink-0 pl-2">3 jam yang lalu</span>
                </div>

            </div>
        </div>

    </div>

    @include('components.footerMobile_admin')

</body>
</html>