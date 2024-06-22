<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BlokController,
    PasarController,
    RekeningController,
    SembakoController,
    PemilikController,
    UsahaController,
    PembayaranController,
    PenindakanController,
    UserController,
    LoginController,
    DashboardController
};
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
    return redirect('login');
    // return view('dashboard.index');
});


Route::group(['middleware' => ['auth']],function () {
    Route::resource('admin-dashboard', DashboardController::class);

    //algoritma
    Route::get('algoritma', [DashboardController::class, 'indexAlgoritma'])->name('algoritma.index');
    Route::post('algoritma/post', [DashboardController::class, 'perhitunganAlgoritma'])->name('algoritma.post');
    
    //end algoritma

    Route::resource('blok', BlokController::class);
    Route::resource('pasar', PasarController::class);
    Route::resource('rekening', RekeningController::class);
    Route::resource('sembako', SembakoController::class);
    Route::resource('penindakan', PenindakanController::class);
    Route::resource('pemilik', PemilikController::class);
    Route::resource('usaha', UsahaController::class);
    
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('/pembayaran/{idUsaha}/detail-usaha', [PembayaranController::class, 'getDetailUsaha'])->name('pembayaran.detail-usaha');
    Route::get('/pembayaran/{idPasar?}/detail', [PembayaranController::class, 'index'])->name('pembayaran.filter');

    Route::resource('user', UserController::class); 
});

Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'post'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:pemilik']], function() {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });
    Route::get('/pemilik-profile', [PemilikController::class, 'indexPemilik'])->name('pemilik.profile');
    Route::get('/pemilik-profile/{id}/edit', [PemilikController::class, 'editPemilik'])->name('pemilik.profile-edit');
    Route::put('/pemilik-profile/{id}/update', [PemilikController::class, 'updatePemilik'])->name('pemilik.profile-update');

    Route::get('/usaha-pemilik', [UsahaController::class, 'indexPemilik'])->name('pemilik.usaha');
    Route::get('/usaha-pemilik/{id}/edit', [UsahaController::class, 'editPemilik'])->name('pemilik.usaha-edit');
    Route::post('/usaha-pemilik', [UsahaController::class, 'storePemilik'])->name('pemilik.usaha-post');
    Route::put('/usaha-pemilik/{id}/update', [UsahaController::class, 'updatePemilik'])->name('pemilik.usaha-put');
    Route::delete('/usaha-pemilik/{id}', [UsahaController::class, 'destroyPemilik'])->name('pemilik.usaha-delete');
    Route::get('/usaha-pemilik/{id}/detail', [UsahaController::class, 'detailUsahaPemilik'])->name('pemilik.usaha-detail');

    Route::get('/usaha-pemilik/{idUsaha}/pembayaran', [UsahaController::class, 'getPembayaran'])->name('pemilik.usaha-pembayaran');
    Route::put('/usaha-pemilik/{id}/pembayaran', [UsahaController::class, 'sendBuktiPembayaran'])->name('pemilik.usaha-pembayaran-post');
    
    Route::get('/usaha-pemilik/{id}/createNota', [PembayaranController::class, 'createNota'])->name('pemilik.pembayaran-create-nota');
    
    Route::get('sembako-pemilik', [SembakoController::class, 'indexPemilik'])->name('sembako-pemilik.index');
    Route::get('penindakan-pemilik', [PenindakanController::class, 'indexPemilik'])->name('penindakan-pemilik.index');
});


Route::get('login-pemilik', [LoginController::class, 'indexPemilik'])->name('login.pemilik');
Route::post('login-pemilik', [LoginController::class, 'postPemilik'])->name('login-pemilik.post');
Route::get('register-pemilik', [LoginController::class, 'registerPemilik'])->name('register.pemilik');
Route::post('register-pemilik', [LoginController::class, 'storeRegisterPemilik'])->name('register-pemilik.post');
