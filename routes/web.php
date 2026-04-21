<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SekretariatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\CargoTrackingController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\CashFlowController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\SupplierController;

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


Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

// Proses login (POST)
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// Logout (POST)
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cek-role', function () {
    return auth()->user()->getRoleNames();
})->middleware('auth');
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth','role:mitra'])->prefix('mitra')->group(function () {

    Route::get('/cargo', [CargoController::class, 'index'])
        ->name('mitra.cargo.index');

    Route::get('/cargo/{cargo}', [CargoController::class, 'show'])
        ->name('mitra.cargo.show');
         Route::get('/surat-jalan/{cargo}', [CargoController::class, 'show'])
    ->name('surat-jalan.show');
          Route::resource('driver', DriverController::class);

});
  Route::middleware('auth','role:super-admin|admin|mitra')->group(function () {
 
    Route::get('/cargo', [CargoController::class, 'index'])->name('cargo.index');
   

Route::resource('mitra', MitraController::class);

    Route::resource('bidang_kesehatan', BidangKesehatanMasyarakatController::class);
Route::resource('bidang_pelayanan_kesehatan', BidangPelayananKesehatanMasyarakatController::class);
Route::resource('cargo', CargoController::class);
  // Route::get('/cargo', [CargoController::class, 'index'])->name('cargo.index')
Route::resource('vehicle', VehicleController::class);

Route::get('cargo/tracking/{cargoTracking}/edit', [CargoTrackingController::class,'edit']);
Route::put('cargo/tracking/{cargoTracking}', [CargoTrackingController::class,'update']);

Route::get('/cargo/{cargo}/tracking', [CargoTrackingController::class, 'index'])->name('cargo_tracking.index');
Route::get('cargo/{cargo}/tracking/create', [CargoTrackingController::class,'create'])->name('cargo_tracking.create');
Route::post('cargo/tracking', [CargoTrackingController::class,'store'])->name('cargo_tracking.store');

Route::delete('cargo/tracking/{cargoTracking}', [CargoTrackingController::class,'destroy'])->name('cargo_tracking.destroy');
  Route::resource('driver', DriverController::class);
});


Route::middleware('auth','role:super-admin')->group(function () {
Route::post('users/{user}/reset-password',
    [UserController::class,'resetPassword']
)->name('admin.users.reset-password');
   Route::put('/user/{user}/make-admin', [UserController::class, 'makeAdmin'])
        ->name('user.makeAdmin');
Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

      Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
 
    Route::resource('cargo', CargoController::class);
       Route::put('/user/{id}/make-admin', [UserController::class, 'makeAdmin'])->name('user.makeAdmin');
       Route::put('/user/{id}/make-mitra', [UserController::class, 'makeMitra'])->name('user.makeMitra');
           Route::put('/user/{id}/make-driver', [UserController::class, 'makeDriver'])->name('user.makeDriver');
           Route::get('/pos', [PosController::class, 'index'])->name('barang.barcode');
    Route::get('/pos/scan/{barcode}', [PosController::class, 'scan']);
    Route::post('/pos/store', [PosController::class, 'store'])->name('pos.store');
// routes/web.php
Route::resource('customers', CustomerController::class);
// routes/web.php
Route::get('/cashflow',[CashFlowController::class,'index'])
->name('cashflow.index');
Route::resource('loans', LoanController::class);// routes/web.php
Route::get('/installments/{loan}/create', [InstallmentController::class, 'create'])->name('installments.create');
Route::post('/installments/store', [InstallmentController::class, 'store'])->name('installments.store');
Route::post('/installments/{installment}/edit', [InstallmentController::class, 'edit'])->name('installments.edit');
Route::get('/installments', [InstallmentController::class, 'index'])
    ->name('installments.index');
Route::put('/installments/{installment}', [InstallmentController::class, 'update'])->name('installments.update');
Route::delete('/installments/{installment}', [InstallmentController::class, 'destroy'])->name('installments.destroy');
 Route::post('/users/{id}/role', [UserController::class, 'updateRole'])->name('user.updateRole');
  Route::put('/users/{user}/reset-password',
    [UserController::class, 'resetPassword'])->name('user.resetPassword');
     Route::get('/user/{id}/reset', [UserController::class, 'reset'])->name('user.reset');
     Route::resource('barang', BarangController::class);
     Route::resource('pembelian', PembelianController::class);
     Route::post('barang/{id}/stok-masuk', [StokController::class, 'masuk'])->name('barang.stok-masuk');
Route::post('barang/{id}/stok-keluar', [StokController::class, 'keluar'])->name('barang.stok-keluar');
Route::delete('/pos/{transaction}', [PosController::class,'destroy'])->name('pos.destroy');
Route::prefix('laporan-penjualan')->controller(LaporanController::class)->group(function () {
    Route::get('/harian', 'harian')->name('penjualan.harian');
    Route::get('/bulanan', 'bulanan')->name('penjualan.bulanan');
    Route::get('/tahunan', 'tahunan')->name('penjualan.tahunan');
});

Route::resource('suppliers', SupplierController::class);
     Route::delete('/cashflow/{cashflow}', [CashFlowController::class,'destroy'])->name('cashflow.destroy');
     Route::delete('/cashflow-delete-all', [CashFlowController::class,'deleteAll'])
    ->name('cashflow.deleteAll');
    Route::delete('/pos-delete-all', [PosController::class,'deleteAll'])
    ->name('pos.deleteAll');
   
Route::get('/laporan/pembelian', [LaporanController::class,'pembelian'])->name('laporan.pembelian');
Route::get('/laporan/stok', [LaporanController::class,'stok'])->name('laporan.stok');
Route::get('/laporan/cashflow', [LaporanController::class,'cashflow'])->name('laporan.cashflow');

Route::prefix('laporan')->group(function(){

Route::get('/penjualan/harian',[LaporanController::class,'harian'])
->name('laporan.penjualan.harian');

Route::get('/penjualan/bulanan',[LaporanController::class,'bulanan'])
->name('laporan.penjualan.bulanan');

Route::get('/penjualan/tahunan',[LaporanController::class,'tahunan'])
->name('laporan.penjualan.tahunan');

});
   
});
    Route::middleware('auth','role:super-admin|admin|driver')->group(function () {
      Route::get('/cargo', [CargoController::class, 'index'])->name('cargo.index');
     Route::get('/cargo/{cargo}/tracking', [CargoTrackingController::class, 'index'])->name('cargo_tracking.index');
        Route::get('cargo/tracking/{cargoTracking}/edit', [CargoTrackingController::class,'edit'])->name('cargo_tracking.edit');
        Route::put('cargo/tracking/{cargoTracking}', [CargoTrackingController::class,'update'])->name('cargo_tracking.update');
    });


require __DIR__.'/auth.php';
