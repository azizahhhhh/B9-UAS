<?php

use App\Http\Controllers\PremiumController;
use App\Models\KerjaSama;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\KerjaSamaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PemilikPemasukanController;
use App\Http\Controllers\SupplierBahanBakuController;
use App\Http\Controllers\SupplierPemasukanController;
use App\Http\Controllers\KalkulatorProduksiController;
use App\Http\Controllers\PemilikPengeluaranController;
use App\Http\Controllers\LaporanKeuanganOwnerController;
use App\Http\Controllers\LaporanKeuanganSupplierController;


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

Route::get('/', [UserController::class, 'index']);

Route::get('/landingpage', [LandingPageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    // Admin
    Route::get("akun-premium", [AdminController::class, "index"])->name("akun-premium");
    Route::get("data-user", [AdminController::class, "dataUser"])->name("data-user");
    Route::post("akun-premium/{akunpremium}/edit", [AdminController::class, "edit"])->name("edit-akun-premium");
    Route::put("akun-premium/update/{akunpremium}", [AdminController::class, "update"])->name("update-akun-premium");
    Route::delete("akun-premium/delete/{id}", [AdminController::class, "destroy"])->name("delete-akun-premium");
    Route::patch("akun-premium/acc", [AdminController::class, "acc"])->name("acc-akun-premium");
    Route::delete("akun-premium/{id}/reject", [AdminController::class, "reject"])->name("reject-akun-premium");
    Route::get("syarat-premium/edit", [AdminController::class, "editSyaratPremium"])->name("edit-syarat-premium");
    Route::put("syarat-premium/update", [AdminController::class, "updateSyaratPremium"])->name("update-syarat-premium");


    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Bahan Baku
    Route::resource("pemilik-bahan-baku", BahanBakuController::class);
    Route::get("kerja-sama", [KerjaSamaController::class, "index"])->name("kerja-sama.index");

    // Supplier
    Route::resource("supplier-bahan-baku", SupplierBahanBakuController::class);
    Route::resource("supplier-pemasukan", SupplierPemasukanController::class);

    // Laporan Keuangan
    Route::get("laporan-keuangan-supplier", [LaporanKeuanganSupplierController::class, "index"])->name("laporan-keuangan-sup");


    // Kerja Sama
    /* Pemilik Usaha */
    Route::post("kerja-sama", [KerjaSamaController::class, "store"])->name("kerja-sama.store");
    Route::post("kerja-sama/permintaan/{kerjaSama_id}", [KerjaSamaController::class, "storePermintaan"])->name("kerja-sama.storePermintaan");
    Route::get("kerja-sama/riwayat/{kerjaSama}", [KerjaSamaController::class, "index_riwayat"])->name("kerja-sama.riwayat.index");
    Route::put("kerja-sama/persetujuan/{kerjaSama}", [KerjaSamaController::class, "updateKerjaSama"])->name("kerja-sama.persetujuan.updateKerjaSama");
    Route::get("laporan-keuangan-owner", [LaporanKeuanganOwnerController::class, "index"])->name("laporan-keuangan-own");
    Route::get("kalkulator-produksi", [KalkulatorProduksiController::class, "index"])->name("kalkulator-produksi");
    Route::get("kalkulator-produksi/perkalian", [KalkulatorProduksiController::class, "perkalian"])->name("perkalian");

    Route::resource("pemilik-pemasukan", PemilikPemasukanController::class);
    Route::resource("pemilik-pengeluaran", PemilikPengeluaranController::class);

    // Premium
    Route::resource('syarat-akun-premium', PremiumController::class);
});
