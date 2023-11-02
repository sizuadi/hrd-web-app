<?php

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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', App\Livewire\Pages\Auth\LoginIndex::class)->name('login');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/', App\Livewire\Pages\Dashboard\DashboardIndex::class)->name('dashboard');
});
