<?php

use App\Models\JenisEksekusi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\AdminPermohonanController;
use App\Http\Controllers\AdminJenisEksekusiController;
use App\Http\Controllers\AdminKelengkapanController;
use App\Http\Controllers\ProsesEksekusiKelengkapanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Kelengkapan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Dashboard',
        'active' => 'dashboard',
        'jenisEksekusis' => JenisEksekusi::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function() {
    return view('dashboard.index', [
        'nama' => auth()->user()->name
    ]);
})->middleware('auth');

// permohonan
Route::get('/permohonan/persyaratan/{id}', [PermohonanController::class, 'getJenisEksekusi'])->middleware('auth');
Route::get('/permohonan/checkSlug', [PermohonanController::class, 'checkSlug'])->middleware('auth');
Route::get('/permohonan/data', [PermohonanController::class, 'data'])->name('permohonan.data')->middleware('auth');
Route::resource('/permohonan', PermohonanController::class)->middleware('auth');

// proses eksekusi kelengkapan
Route::resource('/proses/eksekusi/kelengkapan', ProsesEksekusiKelengkapanController::class)->only('update')->middleware('auth');

// admin permohonan
Route::get('/admin/permohonan', [AdminPermohonanController::class, 'index'])->name('admin.permohonan.index')->middleware('admin');
Route::get('/admin/permohonan/data', [AdminPermohonanController::class, 'data'])->name('admin.permohonan.data')->middleware('admin');
Route::get('/admin/permohonan/{permohonan}', [AdminPermohonanController::class, 'show'])->middleware('admin');
Route::get('/admin/permohonan/proses/eksekusi/data', [AdminPermohonanController::class, 'dataProsesEksekusi'])->name('admin.permohonan.dataProsesEksekusi')->middleware('admin');
Route::get('/admin/permohonan/proses/eksekusi/{permohonan}/create', [AdminPermohonanController::class, 'createProsesEksekusi'])->middleware('admin');
Route::put('/admin/permohonan/proses/eksekusi/{permohonan}', [AdminPermohonanController::class, 'storeProsesEksekusi'])->middleware('admin');
Route::delete('/admin/permohonan/proses/eksekusi/{prosesEksekusi}', [AdminPermohonanController::class, 'destroyProsesEksekusi'])->middleware('admin');

// Route::resource('/admin/permohonan', AdminPermohonanController::class, ['as' => 'admin'])->middleware('admin');

// jenis eksekusi
Route::get('/admin/jenis/eksekusi/{eksekusi}/persyaratan/create', [AdminJenisEksekusiController::class, 'createPersyartan'])->middleware('admin');
Route::get('/admin/jenis/eksekusi/{eksekusi}/tahapan/create', [AdminJenisEksekusiController::class, 'createTahapan'])->middleware('admin');
Route::put('/admin/jenis/eksekusi/{eksekusi}/tahapan', [AdminJenisEksekusiController::class, 'storeTahapan'])->middleware('admin');
Route::put('/admin/jenis/eksekusi/{eksekusi}/persyaratan', [AdminJenisEksekusiController::class, 'storePersyaratan'])->middleware('admin');
Route::delete('/admin/jenis/eksekusi/{eksekusi}/persyaratan', [AdminJenisEksekusiController::class, 'destroyPersyaratan'])->middleware('admin');
Route::delete('/admin/jenis/eksekusi/{eksekusi}/tahapan', [AdminJenisEksekusiController::class, 'destroyTahapan'])->middleware('admin');
Route::get('/admin/jenis/eksekusi/data', [AdminJenisEksekusiController::class, 'data'])->name('admin.jenis.eksekusi.data')->middleware('admin');
Route::get('/admin/jenis/eksekusi/persyaratan/data', [AdminJenisEksekusiController::class, 'dataPersyaratan'])->name('admin.jenis.eksekusi.persyaratan.data')->middleware('admin');
Route::get('/admin/jenis/eksekusi/tahapan/data', [AdminJenisEksekusiController::class, 'datatahapan'])->name('admin.jenis.eksekusi.tahapan.data')->middleware('admin');
Route::resource('/admin/jenis/eksekusi', AdminJenisEksekusiController::class)->except('edit', 'update')->middleware('admin');

// kelengkapan

Route::get('/admin/kelengkapan/data', [AdminKelengkapanController::class, 'data'])->name('admin.kelengkapan.data')->middleware('admin');
Route::resource('admin/kelengkapan', AdminKelengkapanController::class)->except('edit', 'update')->middleware('admin');

// profil
Route::get('/changePassword',[ProfileController::class, 'showChangePasswordGet'])->name('changePasswordGet')->middleware('auth');
Route::post('/changePassword',[ProfileController::class, 'changePasswordPost'])->name('changePasswordPost')->middleware('auth');





