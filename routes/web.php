<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SportController;
use Illuminate\Support\Facades\Auth;
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

Route::any('/', [SportController::class,'accueil'])->name('home');

Route::any('/apropos', [SportController::class,'apropos'])->name('apropos');

Route::any('/contact', [SportController::class,'contact'])->name('contact');

Route::post('/sports/{id}/upload', [SportController::class, 'upload'])->name('sports.upload');

Route::resource('sports', SportController::class)->middleware(['auth']);

Route::resource('athletes', AthleteController::class)->only('index', 'show')->middleware(['auth']);

Route::get('sports/{id}/classement', [SportController::class, 'classement'])->name('sports.classement')->middleware(['auth']);

Route::get('sports/{id}/or', [SportController::class, 'or'])->name('sports.or')->middleware(['auth']);

Route::get('medailles', [Controller::class, 'medailles'])->name('medailles')->middleware(['auth']);

