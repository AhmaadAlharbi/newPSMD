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


Route::get('/dashboard/user/query_section_id=5', function () {
    return view('transformers.user.dashboard');
})->middleware(['auth','is_transformers'])->name('dashboard.user');

Route::get('/dashboard/admin/query_section_id=5', function () {
    return view('transformers.admin.dashboard');
})->middleware(['is_admin','is_transformers'])->name('dashboard.admin');

require __DIR__ . '/auth.php';