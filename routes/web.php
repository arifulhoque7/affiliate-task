<?php

use App\Http\Controllers\AffiliateUserController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubAffiliateUserController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/affiliate',[AffiliateUserController::class,'index'])->name('affiliate.index');
    Route::post('/affiliate',[AffiliateUserController::class,'store'])->name('affiliate.store');

    Route::get('/sub-affiliate', [SubAffiliateUserController::class, 'index'])->name('subAffiliate.index');
    Route::post('/sub-affiliate', [SubAffiliateUserController::class, 'store'])->name('subAffiliate.store');

    Route::get('/user/transaction',  [TransactionController::class,'index'])->name('user.transaction.index');
    Route::post('/transaction', [TransactionController::class,'store'])->name('transaction.store');

    Route::get('/commission', [CommissionController::class,'commission'])->name('commission.index');
});

require __DIR__ . '/auth.php';
