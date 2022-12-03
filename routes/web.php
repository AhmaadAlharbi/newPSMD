<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignaturePadController;

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
    return view('index');
});

Route::get('signaturepad', [SignaturePadController::class, 'index'])->middleware('auth');
Route::post('signaturepad', [SignaturePadController::class, 'upload'])->name('signaturepad.upload')->middleware('auth');

// Route::get('/dashboard/user', function () {
//     return view('protection.user.dashboard');
// })->middleware(['auth'])->name('dashboard.user');
// Route::get('/dashboard', function () {
//     return view('protection.user.dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';