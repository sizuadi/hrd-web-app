<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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
    Route::get('/user-projects', App\Livewire\Pages\UserProjects\UserProjectsIndex::class)->name('user-projects');
    Route::get('/work-reports', App\Livewire\Pages\WorkReports\WorkReportsIndex::class)->name('work-reports');
    Route::get('/work-reports/{id}', App\Livewire\Pages\WorkReports\WorkReportsDetail::class)->name('work-reports.detail');
    Route::get('/archive-ins', App\Livewire\Pages\ArchiveIns\ArchiveInsIndex::class)->name('archive-ins');
    Route::get('/archive-outs', App\Livewire\Pages\ArchiveOuts\ArchiveOutsIndex::class)->name('archive-outs');
    Route::prefix('report')->group(function () {
        Route::get('/work-reports', App\Livewire\Pages\Report\WorkReports\WorkReportsIndex::class)->name('report.work-reports');
    });
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get('/livewire/livewire.js', $handle);
});
