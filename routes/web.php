<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SoutenanceController;
use App\Http\Controllers\JuryController;
use App\Http\Controllers\ProcesVerbalController;
use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard personnalisé
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Modules de l'application
    Route::resource('soutenances', SoutenanceController::class);
    Route::resource('juries', JuryController::class);
    Route::resource('pvs', ProcesVerbalController::class);
    Route::get('pvs/{pv}/pdf', [ProcesVerbalController::class, 'genererPDF'])->name('pvs.pdf');
    Route::resource('archives', ArchiveController::class);
    Route::get('archives/{archive}/download', [ArchiveController::class, 'download'])->name('archives.download');

    // Profil utilisateur (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';