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

<body class="bg-slate-100 text-slate-800 font-sans antialiased selection:bg-indigo-500 selection:text-white pb-24">

    @include('components.hiderSiswa')

    <!-- Container Utama -->
    <div
        class="mx-auto flex min-h-screen w-full max-w-7xl flex-col space-y-6 bg-slate-100 p-4 sm:p-6 md:space-y-8 md:p-8 lg:px-12">

        <!-- Header: Judul & Timer Mundur -->
        <div class="flex items-center justify-between pt-2">
            <div>
                <p class="text-xs font-extrabold uppercase tracking-wider text-indigo-700">
                    {{ $quiz->classroom?->name ?? 'Kuis Evaluasi' }}
                </p>
                <h1 class="text-base sm:text-xl font-extrabold text-slate-900 tracking-tight">{{ $quiz->title }}</h1>
            </div>
            <div
                class="px-4 py-2 bg-rose-100 border-2 border-rose-300 rounded-xl flex items-center space-x-2 text-rose-700 shadow-sm">
                <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span id="quiz-timer"
                    class="text-xs sm:text-sm font-extrabold tracking-wider">{{ sprintf('%02d:00', $quiz->duration_minutes ?? 15) }}</span>
            </div>
        </div>

        @if($questions->isEmpty())
            <div class="bg-white p-8 rounded-2xl border-2 border-slate-300 text-center space-y-4">
                <p class="text-slate-700 font-extrabold">Belum ada butir soal pada kuis ini.</p>
                <a href="{{ route('siswa.tugas') }}"
                    class="inline-block px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-xs">Kembali ke
                    Tugas</a>
            </div>
        @else
            <form id="quiz-form" action="{{ route('siswa.pengerjaan.submit', $quiz) }}" method="POST">
                @csrf
                <input type="hidden" name="duration_seconds" id="duration_seconds" value="0">

                <!-- Progress Bar Ujian -->
                <div class="space-y-2 bg-white p-5 rounded-2xl border-2 border-slate-200 shadow-sm mb-6">
                    <div class="flex items-center justify-between text-xs font-extrabold">
                        <span id="question-indicator" class="text-slate-600 uppercase tracking-wider">Soal Ke 1 dari
                            {{ $questions->count() }}</span>
                        <span id="progress-percent" class="text-indigo-600">0% Terjawab</span>
                    </div>
                    <!-- Progress Line -->
                    <div class="w-full bg-slate-100 border border-slate-300 rounded-full h-3 overflow-hidden p-0.5">
                        <div id="progress-fill" class="bg-indigo-600 h-full rounded-full transition-all duration-500"
                            style="width: 0%"></div>
                    </div>
                </div>

                <!-- Soal Cards Container -->
                @foreach ($questions as $index => $question)
                    <div id="question-card-{{ $index }}" class="question-step {{ $index === 0 ? '' : 'hidden' }} space-y-6">
                        <!-- Kotak Soal -->
                        <div class="bg-white p-6 rounded-2xl border-2 border-slate-300 shadow-sm space-y-4">
                            <div class="flex items-center justify-between">
                                <span
                                    class="inline-block px-3 py-1 bg-indigo-100 border border-indigo-300 text-indigo-800 font-extrabold text-xs rounded-lg uppercase tracking-wider">SOAL
                                    NO. {{ $index + 1 }}</span>
                                <span class="text-xs font-bold text-slate-500">Poin: 1 Soal</span>
                            </div>
                            <p class="text-sm sm:text-base font-bold text-slate-900 leading-relaxed whitespace-pre-line">
                                {{ $question->question_text }}
                            </p>
                        </div>

                        <!-- Pilihan Jawaban (Options) -->
                        <div class="space-y-3">
                            @foreach ($question->options as $optKey => $optVal)
                                @php
                                    $letter = is_string($optKey) && !is_numeric($optKey) ? strtoupper($optKey) : chr(65 + (int) $optKey);
                                @endphp
                                <label for="opt-{{ $question->id }}-{{ $letter }}" class="option-label block cursor-pointer">
                                    <input type="radio" id="opt-{{ $question->id }}-{{ $letter }}"
                                        name="answers[{{ $question->id }}]" value="{{ $letter }}" class="sr-only peer"
                                        data-question-idx="{{ $index }}" onchange="handleOptionSelect({{ $index }})">
                                    <div
                                        class="bg-white p-4 rounded-xl border-2 border-slate-300 shadow-sm flex items-center justify-between hover:border-indigo-600 hover:bg-slate-50 transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-50 peer-checked:shadow-md relative overflow-hidden">
                                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-600 hidden peer-checked:block">
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-9 h-9 rounded-lg bg-slate-200 text-slate-800 border border-slate-300 flex items-center justify-center font-extrabold text-xs shrink-0 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-700">
                                                {{ $letter }}
                                            </div>
                                            <span
                                                class="text-sm font-bold text-slate-800 peer-checked:font-extrabold peer-checked:text-indigo-900">
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
                <div class="grid grid-cols-2 gap-3 pt-6">
                    <button type="button" id="btn-prev" onclick="navigateQuestion(-1)"
                        class="py-3.5 bg-white border-2 border-slate-300 text-slate-600 hover:bg-slate-50 font-bold text-xs rounded-2xl shadow-sm transition-all text-center">
                        Kembali
                    </button>
                    <button type="button" id="btn-next" onclick="navigateQuestion(1)"
                        class="py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-2xl shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-1.5">
                        <span id="btn-next-text">Simpan & Lanjut</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Navigasi Lembar Jawaban (Pagination Soal) -->
                <div class="bg-white p-5 rounded-3xl border-2 border-slate-300 shadow-sm space-y-3 mt-6">
                    <div class="flex items-center justify-between">
                        <h4 class="text-[10px] font-black uppercase tracking-wider text-slate-500">Navigasi Lembar Jawaban
                        </h4>
                        <span class="text-[10px] font-bold text-slate-400">Klik nomor untuk melompat ke soal</span>
                    </div>
                    <div class="grid grid-cols-5 sm:grid-cols-10 gap-2">
                        @foreach ($questions as $idx => $q)
                            <button type="button" id="nav-btn-{{ $idx }}" onclick="goToQuestion({{ $idx }})"
                                class="py-2.5 font-bold text-xs rounded-xl border transition-all text-center {{ $idx === 0 ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200 border-indigo-600' : 'bg-slate-50 text-slate-500 border-slate-200 hover:bg-slate-100' }}">
                                {{ $idx + 1 }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button Bar -->
                <div class="pt-6">
                    <button type="submit"
                        onclick="return confirm('Apakah kamu yakin ingin menyelesaikan kuis ini? Jawaban tidak dapat diubah setelah dikirim.');"
                        class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm rounded-2xl shadow-lg shadow-emerald-200 transition-all flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Selesaikan & Kumpulkan Ujian</span>
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
                    prevNavBtn.className = "py-2.5 font-bold text-xs rounded-xl border bg-indigo-50 text-indigo-700 border-indigo-300";
                } else {
                    prevNavBtn.className = "py-2.5 font-bold text-xs rounded-xl border bg-slate-50 text-slate-500 border-slate-200 hover:bg-slate-100";
                }
            }

            // Set new index
            currentIndex = index;
            document.getElementById(`question-card-${currentIndex}`)?.classList.remove('hidden');

            // Update new nav-btn
            const currentNavBtn = document.getElementById(`nav-btn-${currentIndex}`);
            if (currentNavBtn) {
                currentNavBtn.className = "py-2.5 font-bold text-xs rounded-xl border bg-indigo-600 text-white shadow-md shadow-indigo-200 border-indigo-600";
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
                    btnPrev.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    btnPrev.classList.remove('opacity-50', 'cursor-not-allowed');
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