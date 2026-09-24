<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengerjaan Kuis: {{ $quiz->title }} | Cakrawala Educentre</title>
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

<body class="bg-gradient-to-br from-indigo-50/50 via-sky-50/30 to-purple-50/50 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-28">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-8 p-4 sm:p-6 md:space-y-10 md:p-8 lg:px-12">

        <!-- Header: Judul & Timer Mundur dengan Gradien Modern -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 p-6 sm:p-8 text-white shadow-xl flex flex-wrap items-center justify-between gap-4">
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/15 blur-2xl"></div>
            <div class="relative z-10 space-y-2">
                <span class="inline-block rounded-full bg-white/20 px-3.5 py-1 text-xs font-bold uppercase tracking-widest backdrop-blur-md">
                    {{ $quiz->classroom?->name ?? 'Kuis Evaluasi' }}
                </span>
                <h1 class="text-xl sm:text-2xl font-black tracking-tight">{{ $quiz->title }}</h1>
                <p class="text-xs sm:text-sm font-medium text-indigo-100">Jawab setiap pertanyaan dengan teliti sebelum waktu habis.</p>
            </div>
            
            <div class="relative z-10 px-5 py-3 bg-white/15 border border-white/30 rounded-2xl flex items-center space-x-3 text-white shadow-lg backdrop-blur-md">
                <svg class="w-5 h-5 animate-pulse text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex flex-col">
                    <span class="text-[10px] font-extrabold text-indigo-100 uppercase tracking-wider">Sisa Waktu</span>
                    <span id="quiz-timer" class="text-base sm:text-lg font-black tracking-wider text-white">
                        {{ sprintf('%02d:00', $quiz->duration_minutes ?? 15) }}
                    </span>
                </div>
            </div>
        </div>

        @if($questions->isEmpty())
            <div class="bg-white/80 backdrop-blur-sm p-12 rounded-3xl border border-indigo-100 text-center space-y-4 shadow-sm">
                <span class="text-4xl">⚠️</span>
                <p class="text-slate-700 font-extrabold text-sm">Belum ada butir soal pada kuis ini.</p>
                <a href="{{ route('siswa.tugas') }}"
                    class="inline-block px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl font-black text-xs shadow-md shadow-indigo-200 transition-all">Kembali ke Tugas</a>
            </div>
        @else
            <form id="quiz-form" action="{{ route('siswa.pengerjaan.submit', $quiz) }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="duration_seconds" id="duration_seconds" value="0">

                <!-- Progress Bar Ujian -->
                <div class="space-y-3 bg-white/80 backdrop-blur-sm p-6 rounded-3xl border border-indigo-100 shadow-sm">
                    <div class="flex items-center justify-between text-xs font-black">
                        <span id="question-indicator" class="text-slate-700 uppercase tracking-wider">Soal Ke 1 dari {{ $questions->count() }}</span>
                        <span id="progress-percent" class="text-indigo-600 font-extrabold">0% Terjawab</span>
                    </div>
                    <!-- Progress Line dengan Gradien -->
                    <div class="w-full bg-slate-100 border border-slate-200 rounded-full h-3.5 overflow-hidden p-0.5">
                        <div id="progress-fill" class="bg-gradient-to-r from-indigo-600 to-purple-600 h-full rounded-full transition-all duration-500"
                            style="width: 0%"></div>
                    </div>
                </div>

                <!-- Soal Cards Container -->
                @foreach ($questions as $index =>$question)
                    <div id="question-card-{{ $index }}" class="question-step {{ $index === 0 ? '' : 'hidden' }} space-y-5">
                        <!-- Kotak Soal -->
                        <div class="bg-white/85 backdrop-blur-sm p-6 sm:p-8 rounded-3xl border border-indigo-100 shadow-sm space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="inline-block px-3.5 py-1.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-black text-xs rounded-xl uppercase tracking-wider shadow-2xs">
                                    SOAL NO. {{ $index + 1 }}
                                </span>
                                <span class="text-xs font-extrabold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-xl">Poin: 1</span>
                            </div>
                            <p class="text-sm sm:text-base font-bold text-slate-900 leading-relaxed whitespace-pre-line pt-2">
                                {{ $question->question_text }}
                            </p>
                        </div>

                        <!-- Pilihan Jawaban (Options) -->
                        <div class="space-y-3.5">
                            @foreach ($question->options as $optKey =>$optVal)
                                @php
                                    $letter = is_string($optKey) && !is_numeric($optKey) ? strtoupper($optKey) : chr(65 + (int)$optKey);
                                @endphp
                                <label for="opt-{{ $question->id }}-{{$letter }}" class="option-label block cursor-pointer group">
                                    <input type="radio" id="opt-{{ $question->id }}-{{$letter }}"
                                        name="answers[{{ $question->id }}]" value="{{ $letter }}" class="sr-only peer"
                                        data-question-idx="{{ $index }}" onchange="handleOptionSelect({{ $index }})">
                                    <div class="bg-white/80 backdrop-blur-sm p-4.5 sm:p-5 rounded-2xl border-2 border-slate-200 shadow-2xs flex items-center justify-between group-hover:border-indigo-400 group-hover:bg-indigo-50/20 transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-50/80 peer-checked:shadow-md relative overflow-hidden">
                                        <div class="absolute left-0 top-0 bottom-0 w-2 bg-indigo-600 hidden peer-checked:block"></div>
                                        <div class="flex items-center space-x-4 w-full">
                                            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 border border-slate-200 flex items-center justify-center font-black text-xs shrink-0 peer-checked:bg-gradient-to-br peer-checked:from-indigo-600 peer-checked:to-purple-600 peer-checked:text-white peer-checked:border-0 shadow-2xs transition-all">
                                                {{ $letter }}
                                            </div>
                                            <span class="text-xs sm:text-sm font-bold text-slate-700 group-hover:text-slate-900 peer-checked:font-extrabold peer-checked:text-indigo-950 flex-1">
                                                {{ $optVal }}
                                            </span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Navigasi Tombol (Kembali & Simpan/Lanjut) -->
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <button type="button" id="btn-prev" onclick="navigateQuestion(-1)"
                        class="py-4 bg-white/80 backdrop-blur-sm border-2 border-slate-200 text-slate-600 hover:bg-slate-50 font-black text-xs rounded-2xl shadow-2xs transition-all text-center">
                        ← Sebelumnya
                    </button>
                    <button type="button" id="btn-next" onclick="navigateQuestion(1)"
                        class="py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-xs rounded-2xl shadow-md shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                        <span id="btn-next-text">Simpan & Lanjut</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Navigasi Lembar Jawaban (Pagination Soal) -->
                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-3xl border border-indigo-100 shadow-sm space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-xs font-black uppercase tracking-wider text-slate-700">Navigasi Lembar Jawaban</h4>
                        <span class="text-[11px] font-bold text-slate-400">Klik nomor untuk melompat</span>
                    </div>
                    <div class="grid grid-cols-5 sm:grid-cols-10 gap-2.5">
                        @foreach ($questions as $idx =>$q)
                            <button type="button" id="nav-btn-{{ $idx }}" onclick="goToQuestion({{ $idx }})"
                                class="py-3 font-black text-xs rounded-xl border transition-all text-center shadow-2xs {{ $idx === 0 ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md shadow-indigo-200 border-0' : 'bg-white text-slate-600 border-slate-200 hover:bg-indigo-50/50 hover:text-indigo-600' }}">
                                {{ $idx + 1 }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button Bar -->
                <div class="pt-2">
                    <button type="submit"
                        onclick="return confirm('Apakah kamu yakin ingin menyelesaikan kuis ini? Jawaban tidak dapat diubah setelah dikirim.');"
                        class="w-full py-4.5 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-black text-xs sm:text-sm rounded-2xl shadow-lg shadow-emerald-200 transition-all flex items-center justify-center space-x-2.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Selesaikan & Kumpulkan Ujian 🚀</span>
                    </button>
                </div>

            </form>
        @endif

    </div>

    @include('components.footerSiswa')
    @include('components.footerMobile_siswa')

    <script>
        const totalQuestions = {{ $questions->count() }};
        let currentIndex = 0;
        let answeredQuestions = new Set();
        let secondsLeft = {{ ($quiz->duration_minutes ?? 15) * 60 }};
        let elapsedSeconds = 0;

        function updateProgress() {
            const answeredCount = answeredQuestions.size;
            const percent = totalQuestions > 0 ? Math.round((answeredCount / totalQuestions) * 100) : 0;
            const progressPercentEl = document.getElementById('progress-percent');
            const progressFillEl = document.getElementById('progress-fill');
            const questionIndicatorEl = document.getElementById('question-indicator');

            if (progressPercentEl) progressPercentEl.innerText = `${percent}% Terjawab`;
            if (progressFillEl) progressFillEl.style.width = `${percent}%`;
            if (questionIndicatorEl) questionIndicatorEl.innerText = `Soal Ke ${currentIndex + 1} dari ${totalQuestions}`;
        }

        function showQuestion(index) {
            if (index < 0 || index >= totalQuestions) return;

            // Hide current
            document.getElementById(`question-card-${currentIndex}`)?.classList.add('hidden');

            // Update nav-btn previous
            const prevNavBtn = document.getElementById(`nav-btn-${currentIndex}`);
            if (prevNavBtn) {
                if (answeredQuestions.has(currentIndex)) {
                    prevNavBtn.className = "py-3 font-black text-xs rounded-xl border bg-indigo-50 text-indigo-700 border-indigo-200 shadow-2xs";
                } else {
                    prevNavBtn.className = "py-3 font-black text-xs rounded-xl border bg-white text-slate-600 border-slate-200 hover:bg-indigo-50/50 hover:text-indigo-600 shadow-2xs";
                }
            }

            // Set new index
            currentIndex = index;
            document.getElementById(`question-card-${currentIndex}`)?.classList.remove('hidden');

            // Update new nav-btn
            const currentNavBtn = document.getElementById(`nav-btn-${currentIndex}`);
            if (currentNavBtn) {
                currentNavBtn.className = "py-3 font-black text-xs rounded-xl border bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md shadow-indigo-200 border-0";
            }

            // Update Next button label
            const nextText = document.getElementById('btn-next-text');
            if (nextText) {
                if (currentIndex === totalQuestions - 1) {
                    nextText.innerText = "Selesai / Review";
                } else {
                    nextText.innerText = "Simpan & Lanjut";
                }
            }

            const btnPrev = document.getElementById('btn-prev');
            if (btnPrev) {
                btnPrev.disabled = (currentIndex === 0);
                if (currentIndex === 0) {
                    btnPrev.classList.add('opacity-40', 'cursor-not-allowed');
                } else {
                    btnPrev.classList.remove('opacity-40', 'cursor-not-allowed');
                }
            }

            updateProgress();
        }

        function navigateQuestion(delta) {
            const target = currentIndex + delta;
            if (target >= 0 && target < totalQuestions) {
                showQuestion(target);
            }
        }

        function goToQuestion(index) {
            showQuestion(index);
        }

        function handleOptionSelect(questionIndex) {
            answeredQuestions.add(questionIndex);
            updateProgress();
        }

        // Timer
        const timerElement = document.getElementById('quiz-timer');
        const durationInput = document.getElementById('duration_seconds');

        const timerInterval = setInterval(() => {
            secondsLeft--;
            elapsedSeconds++;
            if (durationInput) durationInput.value = elapsedSeconds;

            if (secondsLeft <= 0) {
                clearInterval(timerInterval);
                alert('Waktu ujian telah habis! Jawaban Anda akan dikumpulkan otomatis.');
                document.getElementById('quiz-form').submit();
                return;
            }

            const m = Math.floor(secondsLeft / 60);
            const s = secondsLeft % 60;
            if (timerElement) {
                timerElement.innerText = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
            }
        }, 1000);

        // Initial setup
        document.addEventListener('DOMContentLoaded', () => {
            showQuestion(0);
        });
    </script>
</body>

</html>