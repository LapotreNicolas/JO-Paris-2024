<?php

use App\Http\Controllers\SportController;
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

Route::any('/', [SportController::class,'accueil'])->name('accueil');

Route::any('/apropos', [SportController::class,'apropos'])->name('apropos');

Route::any('/contact', [SportController::class,'contact'])->name('contact');

Route::post('/sports/{id}/upload', [SportController::class, 'upload'])->name('sports.upload');

Route::resource('sports', SportController::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
]);
