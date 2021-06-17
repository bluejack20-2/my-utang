<?php

use App\Http\Controllers\CreateDebtController;
use App\Http\Controllers\MarkDebtAsPaidController;
use App\Http\Controllers\MarkDebtAsUnpaidController;
use App\Http\Controllers\ShowCreateDebtFormController;
use App\Http\Livewire\Profile\UpdateQrCodeForm;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::name('debt.')->group(function () {
        Route::prefix('debts')->group(function () {

            Route::get('/create', ShowCreateDebtFormController::class)->name('create-form');
            Route::post('/create', CreateDebtController::class)->name('create');
            Route::post('/mark-paid/{debt}', MarkDebtAsPaidController::class)->name('mark-paid');
            Route::post('/mark-unpaid/{debt}', MarkDebtAsUnpaidController::class)->name('mark-unpaid');

        });
    });

    Route::name('user.')->group(function () {
        Route::prefix('users')->group(function () {

            Route::get('/qr-code', UpdateQrCodeForm::class)->name('qr-code');

        });
    });
});

Route::get('/', function () {
    return Redirect::route('dashboard');
});
