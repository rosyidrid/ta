<?php

use App\Http\Controllers\ManageAwn;
use App\Http\Controllers\ManageNambo;
use App\Http\Controllers\ManageStok;
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
    return redirect('login');
});

// Route Dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', function () {
    return view('dashboard');
})->name('Dashboard');

// Route Awn
Route::get('kalog-awn', [ManageAwn::class, 'index'])->name('Awn')->middleware('auth');
Route::get('kalog-awn/add', [ManageAwn::class, 'add'])->name('Add Awn')->middleware('auth');
Route::get('kalog-awn/edit/{id}', [ManageAwn::class, 'edit'])->name('Edit Awn')->middleware('auth');
Route::post('kalog-awn/edit/{id}', [ManageAwn::class, 'editawn'])->name('edit-awn')->middleware('auth');

// Route Nambo
Route::get('kalog-nambo', [ManageNambo::class, 'index'])->name('Nambo')->middleware('auth');
Route::get('kalog-nambo/add', [ManageNambo::class, 'add'])->name('Add Nambo')->middleware('auth');
Route::get('kalog-nambo/edit/{id}', [ManageNambo::class, 'edit'])->name('Edit Nambo')->middleware('auth');
Route::post('kalog-nambo/edit/{id}', [ManageNambo::class, 'editnambo'])->name('Edit-Nambo')->middleware('auth');
