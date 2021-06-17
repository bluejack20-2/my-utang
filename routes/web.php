<?php

use App\Http\Livewire\Debt\History;
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

    Route::get('/history', History::class)->name('history');

    Route::name('user.')->group(function () {
        Route::prefix('users')->group(function () {

            Route::get('/qr-code', UpdateQrCodeForm::class)->name('qr-code');

        });
    });
});

Route::get('/', function () {
    return Redirect::route('dashboard');
});
