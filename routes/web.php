<?php

use App\Http\Controllers\ProfileController; //login breeze
use Illuminate\Support\Facades\Route; //login breeze
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\TimerController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\CarbonController;


// ini awal script login breeze
Route::get('/', function () {
    // return view('welcome');
    return view('frontend');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //routing laporan
    Route::get('/laporan/show', [LaporanController::class, 'show'])->name('laporan.show'); //tampilkan
    Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create'); //add
    Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.edit'); //edit
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy'); //delete
    Route::get('/laporan/{id}', [LaporanController::class, 'view'])->name('laporan.view'); //view

    //routing timer
    Route::get('/timer/show', [TimerController::class, 'show']);

    //routing manajemen tugas
    Route::get('/manajemens/show', [ManajemenController::class, 'show']);
    Route::post('/manajemen', [ManajemenController::class, 'store']);
    Route::put('/manajemen/{id}', [ManajemenController::class, 'update'])->name('manajemen.update');
    Route::delete('/manajemen/{id}', [ManajemenController::class, 'destroy'])->name('manajemen.destroy');
    });

    //routing notifikasi jadwal
    Route::get('/jadwals', [JadwalController::class, 'index'])->name('jadwals.index');  // Menampilkan daftar jadwal
    Route::post('/jadwals', [JadwalController::class, 'store'])->name('jadwals.store');  // Menambahkan jadwal baru
    Route::delete('/jadwals/{id}', [JadwalController::class, 'destroy'])->name('jadwals.destroy'); // Menghapus jadwal
    Route::get('/jadwals/check-upcoming', [JadwalController::class, 'checkUpcomingJadwals'])->name('jadwals.checkUpcoming');
    Route::get('/check-jadwals', [CarbonController::class, 'checkUpcomingJadwals'])->name('check.jadwals');


    require __DIR__.'/auth.php';

    //Cara 2: menampilkan web melalui file yang sudah di tentukan
    Route::get('/profil', function () { //url: /profil
        return view('profil'); //mengarah ke file profil.blade.php
    });