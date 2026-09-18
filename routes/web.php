<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingPage');
});

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::view('/login', 'modulSiswa.login')->name('login');
    Route::post('/login', function () {
        return redirect()->route('siswa.home');
    })->name('login.submit');
    Route::view('/register', 'modulSiswa.register')->name('register');
    Route::post('/register', function () {
        return redirect()->route('siswa.home');
    })->name('register.submit');
    Route::view('/home', 'modulSiswa.home')->name('home');
    Route::view('/kelas', 'modulSiswa.kelas')->name('kelas');
    Route::view('/materi', 'modulSiswa.materiBelajar')->name('materi');
    Route::view('/profile', 'modulSiswa.profile')->name('profile');
    Route::view('/profile/edit', 'modulSiswa.editProfile')->name('profile.edit');
    Route::view('/pengaturan', 'modulSiswa.pengaturan')->name('pengaturan');
    Route::view('/tugas', 'modulSiswa.tugas')->name('tugas');
    Route::view('/pengerjaan', 'modulSiswa.pengerjaan')->name('pengerjaan');
    Route::view('/evaluasi', 'modulSiswa.evaluasiPengerjaan')->name('evaluasi');
});

Route::prefix('guru')->name('guru.')->group(function () {
    Route::view('/login', 'modulGuru.login')->name('login');
    Route::view('/register', 'modulGuru.register')->name('register');
    Route::view('/home', 'modulGuru.home')->name('home');
    Route::view('/kelas', 'modulGuru.kelasGuru')->name('kelas');
    Route::view('/kelas/detail', 'modulGuru.detailKelas')->name('kelas.detail');
    Route::view('/kelas/siswa', 'modulGuru.viewSiswa')->name('siswa');
    Route::view('/input-nilai', 'modulGuru.inputNilai_siswa')->name('input-nilai');
    Route::view('/bahan-ajar', 'modulGuru.kelolaBahan_ajar')->name('bahan-ajar');
    Route::view('/koreksi/kuis', 'modulGuru.koreksiKuis')->name('koreksi.kuis');
    Route::view('/koreksi/tugas', 'modulGuru.koreksiTugas')->name('koreksi.tugas');
    Route::view('/kuis/tambah', 'modulGuru.tambahKuis')->name('kuis.tambah');
    Route::view('/tugas/tambah', 'modulGuru.tambahTugas')->name('tugas.tambah');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/home', 'modulAdmin.home')->name('home');
    Route::view('/mahasiswa', 'modulAdmin.manageSiswa')->name('siswa');
    Route::view('/guru', 'modulAdmin.manageGuru')->name('guru');
    Route::view('/pembayaran', 'modulAdmin.managePembayaran')->name('pembayaran');
});

