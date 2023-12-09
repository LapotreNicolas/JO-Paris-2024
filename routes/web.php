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

Route::any('/', [SportController::class,'accueil']);

Route::any('/apropos', [SportController::class,'apropos']);

Route::any('/contact', [SportController::class,'contact']);

Route::get('/sports', [SportController::class,'index'])->name('sports.index');

Route::post('/sports/{id}/upload', [SportController::class, 'upload'])->name('sports.upload');
