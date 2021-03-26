<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PersonnelController;
use Illuminate\Support\Facades\Route;

/* AUTH */
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// route protegé par auth middleware
Route::middleware('auth')->group(function () {
    /* Home */
    Route::get('/', [HomeController::class, 'index'])->name('index');

    /* EMAIL */
    Route::get('/mail-history', [MailController::class, 'index'])->name('mail.history');
    Route::get('/mail', [MailController::class, 'create'])->name('mail.create');
    Route::post('/mail', [MailController::class, 'send'])->name('mail.send');

    /* CLASSES */
    Route::get('/classes', [ClasseController::class, 'index'])->name('classe.index');

    /* ETUDIANTS */
    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiant.index');
    Route::get('/etudiant', [EtudiantController::class, 'create'])->name('etudiant.create');
    Route::post('/etudiant', [EtudiantController::class, 'store'])->name('etudiant.store');
    Route::get('/delete-etudiant/{id}', [EtudiantController::class, 'delete'])->name('etudiant.delete');

    /* PERSONNELS */
    Route::get('/personnels', [PersonnelController::class, 'index'])->name('personnel.index');
    Route::get('/personnel', [PersonnelController::class, 'create'])->name('personnel.create');
    Route::post('/personnel', [PersonnelController::class, 'store'])->name('personnel.store');


    /* deconnexion */
    Route::get('/deconnexion', [AuthController::class, 'logout'])->name('deconnexion');
});

