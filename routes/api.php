<?php

use App\Http\Controllers\API\ClassController;
use App\Http\Controllers\API\EtudiantController;
use App\Http\Controllers\API\MailController;
use App\Http\Controllers\API\SMSController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Auth */
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

/* SMS */
Route::get('/sms/{user_id?}', [SMSController::class, 'index'])->name('api.sms.get');
Route::post('/sms', [SMSController::class, 'sendSMS'])->name('api.sms.post');

/* MAIL */
Route::get('/mail/{user_id?}', [MailController::class, 'index'])->name('api.sms.get');
Route::post('/mail', [MailController::class, 'sendMail'])->name('api.sms.post');

/* Classes */
Route::get('/classes', [ClassController::class, 'index'])->name('api.classes.get');

/* etudiants */
Route::get('/etudiants', [EtudiantController::class, 'index'])->name('api.etudiant.get');
Route::post('/etudiant', [EtudiantController::class, 'store'])->name('api.etudiant.post');

