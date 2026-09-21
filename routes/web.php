<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\LandingContentController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Guru\AssignmentController;
use App\Http\Controllers\Guru\ClassroomController;
use App\Http\Controllers\Guru\GradingController;
use App\Http\Controllers\Guru\HomeController as GuruHomeController;
use App\Http\Controllers\Guru\LearningRecommendationController;
use App\Http\Controllers\Guru\LoginController as GuruLoginController;
use App\Http\Controllers\Guru\MaterialController as GuruMaterialController;
use App\Http\Controllers\Guru\QuizController;
use App\Http\Controllers\Siswa\AssignmentSubmissionController;
use App\Http\Controllers\Siswa\ClassroomController as SiswaClassroomController;
use App\Http\Controllers\Siswa\HomeController as SiswaHomeController;
use App\Http\Controllers\Siswa\LoginController as SiswaLoginController;
use App\Http\Controllers\Siswa\MaterialController as SiswaMaterialController;
use App\Http\Controllers\Siswa\PaymentController as SiswaPaymentController;
use App\Http\Controllers\Siswa\ProfileController;
use App\Http\Controllers\Siswa\QuizTakingController;
use App\Http\Controllers\Siswa\RegistrationController;
use App\Http\Controllers\Siswa\TaskController as SiswaTaskController;
use App\Models\LandingContent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    if (!Schema::hasTable('landing_contents')) {
        return view('landingPage', ['programs' => collect(), 'packages' => collect()]);
    }

    return view('landingPage', [
        'programs' => LandingContent::query()->where('type', 'program')->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get(),
        'packages' => LandingContent::query()->where('type', 'package')->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get(),
    ]);
})->name('landing.page');

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::view('/login', 'modulSiswa.login')->name('login');
    Route::post('/login', [SiswaLoginController::class, 'store'])->name('login.submit');
    Route::view('/register', 'modulSiswa.register')->name('register');
    Route::post('/register', [RegistrationController::class, 'store'])->name('register.submit');
    Route::get('/pembayaran', [SiswaPaymentController::class, 'create'])->name('payment.create');
    Route::post('/pembayaran', [SiswaPaymentController::class, 'store'])->name('payment.store');
    Route::get('/home', [SiswaHomeController::class, 'index'])->name('home');
    Route::get('/kelas', [SiswaClassroomController::class, 'index'])->name('kelas');
    Route::get('/kelas/{classroom}', [SiswaClassroomController::class, 'show'])->name('kelas.show');
    Route::get('/materi', [SiswaMaterialController::class, 'index'])->name('materi');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/pengaturan', [ProfileController::class, 'settings'])->name('pengaturan');
    Route::put('/pengaturan', [ProfileController::class, 'updateSettings'])->name('pengaturan.update');
    Route::post('/logout', [SiswaLoginController::class, 'destroy'])->name('logout');
    Route::get('/tugas', [SiswaTaskController::class, 'index'])->name('tugas');
    Route::post('/tugas/{assignment}/submit', [AssignmentSubmissionController::class, 'store'])->name('tugas.submit');
    Route::get('/pengerjaan/{quiz?}', [QuizTakingController::class, 'show'])->name('pengerjaan');
    Route::post('/pengerjaan/{quiz}', [QuizTakingController::class, 'submit'])->name('pengerjaan.submit');
    Route::get('/evaluasi/{submission?}', [QuizTakingController::class, 'evaluation'])->name('evaluasi');
});

Route::prefix('guru')->name('guru.')->group(function () {
    Route::view('/login', 'modulGuru.login')->name('login');
    Route::post('/login', [GuruLoginController::class, 'store'])->name('login.submit');
    Route::view('/register', 'modulGuru.register')->name('register');
    Route::get('/home', [GuruHomeController::class, 'index'])->name('home');
    Route::resource('kelas', ClassroomController::class)->except(['show'])->middleware('auth')->names([
        'index' => 'kelas',
        'create' => 'kelas.create',
        'store' => 'kelas.store',
        'edit' => 'kelas.edit',
        'update' => 'kelas.update',
        'destroy' => 'kelas.destroy',
    ])->parameters(['kelas' => 'classroom']);
    Route::get('/kelas/{classroom}/pembelajaran', [ClassroomController::class, 'learning'])->middleware('auth')->name('kelas.learning');
    Route::post('/kelas/rekomendasi', [LearningRecommendationController::class, 'store'])->middleware('auth')->name('kelas.rekomendasi.store');
    Route::get('/kelas/detail/{classroom?}', [ClassroomController::class, 'detail'])->name('kelas.detail');
    Route::post('/kelas/{classroom}/absensi', [ClassroomController::class, 'saveAttendance'])->name('kelas.absensi');
    Route::post('/logout', [GuruLoginController::class, 'destroy'])->name('logout');
    Route::get('/kelas/siswa/{classroom?}', [GradingController::class, 'classStudents'])->name('siswa');
    Route::get('/input-nilai/{submission?}', [GradingController::class, 'inputGrade'])->name('input-nilai');
    Route::post('/input-nilai/{submission}', [GradingController::class, 'storeGrade'])->name('input-nilai.store');
    Route::get('/bahan-ajar', [GuruMaterialController::class, 'create'])->name('material.create');
    Route::post('/bahan-ajar', [GuruMaterialController::class, 'store'])->middleware('auth')->name('material.store');
    Route::get('/koreksi/kuis/{quiz?}', [GradingController::class, 'quizAnalytics'])->name('koreksi.kuis');
    Route::get('/koreksi/tugas', [GradingController::class, 'taskCorrection'])->name('koreksi.tugas');
    Route::get('/kuis/tambah', [QuizController::class, 'create'])->middleware('auth')->name('kuis.tambah');
    Route::get('/kuis/create', [QuizController::class, 'create'])->middleware('auth')->name('kuis.create');
    Route::post('/kuis/tambah', [QuizController::class, 'store'])->middleware('auth')->name('kuis.store');
    Route::get('/tugas/tambah', [AssignmentController::class, 'create'])->middleware('auth')->name('tugas.tambah');
    Route::get('/tugas/create', [AssignmentController::class, 'create'])->middleware('auth')->name('tugas.create');
    Route::post('/tugas/tambah', [AssignmentController::class, 'store'])->middleware('auth')->name('tugas.store');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'store'])->name('login.submit');
    Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');
    Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
    Route::resource('mahasiswa', StudentController::class)->names('siswa')->parameters(['mahasiswa' => 'student']);
    Route::resource('guru', TeacherController::class)->names('guru')->parameters(['guru' => 'teacher']);
    Route::get('/pembayaran', [AdminPaymentController::class, 'index'])->name('pembayaran');
    Route::patch('/pembayaran/{payment}/confirm', [AdminPaymentController::class, 'confirm'])->name('pembayaran.confirm');
    Route::patch('/pembayaran/{payment}/reject', [AdminPaymentController::class, 'reject'])->name('pembayaran.reject');
    Route::resource('landing', LandingContentController::class)->only(['index', 'store', 'update', 'destroy'])->parameters(['landing' => 'landingContent']);
});
