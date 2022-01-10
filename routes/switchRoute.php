<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard/user/query_section_id=4', function () {
    return view('switchgear.user.dashboard');
})->middleware(['auth','is_switch'])->name('dashboard.user');

Route::get('dashboard/admin/query_section_id=4', function () {
    return view('switchgear.admin.dashboard');
})->middleware(['is_admin','is_switch'])->name('dashboard.admin');



require __DIR__ . '/auth.php';