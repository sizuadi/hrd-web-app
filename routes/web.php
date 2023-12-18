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
    Route::get('/users', App\Livewire\Pages\Users\UsersIndex::class)->name('users');
    Route::get('/roles', App\Livewire\Pages\Roles\RolesIndex::class)->name('roles');
    Route::get('/companies', App\Livewire\Pages\Companies\CompaniesIndex::class)->name('companies');
    Route::get('/work-types', App\Livewire\Pages\WorkTypes\WorkTypesIndex::class)->name('work-types');
    Route::get('/archive-categories', App\Livewire\Pages\ArchiveCategories\ArchiveCategoriesIndex::class)->name('archive-categories');
    Route::get('/projects', App\Livewire\Pages\Projects\ProjectsIndex::class)->name('projects');
});
