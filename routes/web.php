<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPosterController;
use App\Http\Controllers\GuestPresentationController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\PodiumPresentationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/Poster', [PosterController::class, 'index'])->name('home');
Route::get('/GuestPresentation', [GuestPresentationController::class, 'index'])->name('GuestPresentation');
Route::get('/Poster/view/{poster}', [PosterController::class, 'view'])->name('ViewPoster');
Route::get('/AdminPoster/view/{poster}', [AdminPosterController::class, 'view'])->name('ViewAdminPoster');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('AdminPoster', AdminPosterController::class);
    Route::resource('presentations', PodiumPresentationController::class);
});

require __DIR__.'/auth.php';
