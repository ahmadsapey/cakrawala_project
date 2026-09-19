<?php

use App\Http\Controllers\Admin\LandingContentController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Guru\AssignmentController;
use App\Http\Controllers\Guru\ClassroomController;
use App\Http\Controllers\Guru\LearningRecommendationController;
use App\Http\Controllers\Guru\LoginController as GuruLoginController;
use App\Http\Controllers\Guru\MaterialController as GuruMaterialController;
use App\Http\Controllers\Guru\QuizController;
use App\Http\Controllers\Siswa\ClassroomController as SiswaClassroomController;
use App\Http\Controllers\Siswa\HomeController as SiswaHomeController;
use App\Http\Controllers\Siswa\LoginController as SiswaLoginController;
use App\Http\Controllers\Siswa\MaterialController as SiswaMaterialController;
use App\Http\Controllers\Siswa\PaymentController as SiswaPaymentController;
use App\Http\Controllers\Siswa\RegistrationController;
use App\Http\Controllers\Siswa\TaskController as SiswaTaskController;
use App\Models\LandingContent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    if (! Schema::hasTable('landing_contents')) {
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
    Route::view('/profile', 'modulSiswa.profile')->name('profile');
    Route::view('/profile/edit', 'modulSiswa.editProfile')->name('profile.edit');
    Route::view('/pengaturan', 'modulSiswa.pengaturan')->name('pengaturan');
    Route::get('/tugas', [SiswaTaskController::class, 'index'])->name('tugas');
    Route::view('/pengerjaan', 'modulSiswa.pengerjaan')->name('pengerjaan');
    Route::view('/evaluasi', 'modulSiswa.evaluasiPengerjaan')->name('evaluasi');
});

Route::prefix('guru')->name('guru.')->group(function () {
    Route::view('/login', 'modulGuru.login')->name('login');
    Route::post('/login', [GuruLoginController::class, 'store'])->name('login.submit');
    Route::view('/register', 'modulGuru.register')->name('register');
    Route::view('/home', 'modulGuru.home')->name('home');
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
    Route::view('/kelas/detail', 'modulGuru.detailKelas')->name('kelas.detail');
    Route::view('/kelas/siswa', 'modulGuru.viewSiswa')->name('siswa');
    Route::view('/input-nilai', 'modulGuru.inputNilai_siswa')->name('input-nilai');
    Route::get('/bahan-ajar', [GuruMaterialController::class, 'create'])->name('material.create');
    Route::post('/bahan-ajar', [GuruMaterialController::class, 'store'])->middleware('auth')->name('material.store');
    Route::view('/koreksi/kuis', 'modulGuru.koreksiKuis')->name('koreksi.kuis');
    Route::view('/koreksi/tugas', 'modulGuru.koreksiTugas')->name('koreksi.tugas');
    Route::get('/kuis/tambah', [QuizController::class, 'create'])->middleware('auth')->name('kuis.tambah');
    Route::post('/kuis/tambah', [QuizController::class, 'store'])->middleware('auth')->name('kuis.store');
    Route::get('/tugas/tambah', [AssignmentController::class, 'create'])->middleware('auth')->name('tugas.tambah');
    Route::post('/tugas/tambah', [AssignmentController::class, 'store'])->middleware('auth')->name('tugas.store');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/home', 'modulAdmin.home')->name('home');
    Route::resource('mahasiswa', StudentController::class)->only(['index', 'show'])->names('siswa')->parameters(['mahasiswa' => 'student']);
    Route::resource('guru', TeacherController::class)->names('guru')->parameters(['guru' => 'teacher']);
    Route::get('/pembayaran', [AdminPaymentController::class, 'index'])->name('pembayaran');
    Route::patch('/pembayaran/{payment}/confirm', [AdminPaymentController::class, 'confirm'])->name('pembayaran.confirm');
    Route::patch('/pembayaran/{payment}/reject', [AdminPaymentController::class, 'reject'])->name('pembayaran.reject');
    Route::resource('landing', LandingContentController::class)->only(['index', 'store', 'update', 'destroy'])->parameters(['landing' => 'landingContent']);
});
