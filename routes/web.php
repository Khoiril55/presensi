<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest:employee'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/loginadmin', [AuthController::class, 'loginadmin']);
});

Route::middleware(['auth:employee'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);

    //Presensi
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    //Edit Profile
    Route::get('/editprofile', [PresensiController::class, 'edit']);
    Route::post('/presensi/{nik}/update', [PresensiController::class, 'update']);

    //History
    Route::get('/presensi/history', [PresensiController::class, 'history']);
    Route::post('/gethistory', [PresensiController::class, 'gethistory']);

    //izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/ajuanizin', [PresensiController::class, 'ajuanizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/logoutadmin', [AuthController::class, 'logoutadmin']);
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

    //Employee
    Route::get('/karyawan', [EmployeeController::class, 'index']);
    Route::post('/karyawan/store', [EmployeeController::class, 'store']);
    Route::post('/karyawan/edit', [EmployeeController::class, 'edit']);
    Route::post('/karyawan/{nik}/update', [EmployeeController::class, 'update']);
    Route::post('/karyawan/{nik}/delete', [EmployeeController::class, 'delete']);

    //Department
    Route::get('/divisi', [DepartmentController::class, 'index']);
    Route::post('/divisi/store', [DepartmentController::class, 'store']);
    Route::post('/divisi/edit', [DepartmentController::class, 'edit']);
    Route::post('/divisi/{kode_dept}/update', [DepartmentController::class, 'update']);
    Route::post('/divisi/{kode_dept}/delete', [DepartmentController::class, 'delete']);

    //Presensi Monitoring
    Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::post('/showmap', [PresensiController::class, 'showmap']);

    //Laporan Presensi
    Route::get('/presensi/laporan', [PresensiController::class, 'laporan']);
    Route::post('/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);
    Route::get('/presensi/rekap', [PresensiController::class, 'rekap']);
    Route::post('/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);
    Route::get('/presensi/izinsakit', [PresensiController::class, 'izinsakit']);
    Route::post('/presensi/approvedizinsakit', [PresensiController::class, 'approvedizinsakit']);
    Route::get('/presensi/{id}/batalkanizinsakit', [PresensiController::class, 'batalkanizinsakit']);

    //Konfigurasi
    Route::get('/konfigurasi/lokasikantor', [KonfigurasiController::class, 'lokasikantor']);
    Route::post('/konfigurasi/updatelokasi', [KonfigurasiController::class, 'updatelokasi']);
});
