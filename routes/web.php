<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les employés
    Route::get('/employes', [EmployeController::class, 'index'])->name('employes.index');
    Route::get('/employes/create', [EmployeController::class, 'create'])->name('employes.create');
    Route::post('/employes', [EmployeController::class, 'store'])->name('employes.store');
    Route::get('/employes/{id}/edit', [EmployeController::class, 'edit'])->name('employes.edit');
    Route::put('/employes/{id}', [EmployeController::class, 'update'])->name('employes.update');
    Route::delete('/employes/{id}', [EmployeController::class, 'destroy'])->name('employes.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Routes pour le tableau d'audit accessible uniquement par les administrateurs
    Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');
});
require __DIR__.'/auth.php';
