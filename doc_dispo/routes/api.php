<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('connexion/medecin/{email}/{mdp}', [\App\Http\Controllers\api\MedecinController::class, 'connexion']);
Route::get('connexion/patient/{email}/{mdp}', [\App\Http\Controllers\api\PatientController::class, 'connexion']);
Route::post('inscription', [\App\Http\Controllers\api\PatientController::class, 'inscription']);

Route::apiResource('affilier', \App\Http\Controllers\api\AffilierController::class);
Route::apiResource('assurance', \App\Http\Controllers\api\AssuranceController::class);
Route::apiResource('creneau', \App\Http\Controllers\api\CreneauController::class);
Route::apiResource('hopital', \App\Http\Controllers\api\HopitalController::class);
Route::apiResource('medecin', \App\Http\Controllers\api\MedecinController::class);
Route::apiResource('motif', \App\Http\Controllers\api\MotifController::class);
Route::apiResource('motif_consultation', \App\Http\Controllers\api\MotifConsulationController::class);
Route::apiResource('patient', \App\Http\Controllers\api\PatientController::class);
Route::apiResource('proche', \App\Http\Controllers\api\ProcheController::class);
Route::apiResource('rdv', \App\Http\Controllers\api\RdvController::class);
Route::apiResource('specialite', \App\Http\Controllers\api\SpecialiteController::class);
Route::apiResource('specialite_hopital', \App\Http\Controllers\api\SpecialiteHopitalController::class);

Route::get('creneaux', [\App\Http\Controllers\api\CreneauController::class, 'allCreneaux']);

Route::put('password/medecin/{ancien}/{nouveau}/{id}', [\App\Http\Controllers\api\MedecinController::class, 'updatePassword']);
Route::put('password/patient/{ancien}/{nouveau}/{id}', [\App\Http\Controllers\api\PatientController::class, 'updatePassword']);

Route::put('email/medecin/{email}/{id}', [\App\Http\Controllers\api\MedecinController::class, 'updateEmail']);
Route::put('email/patient/{email}/{id}', [\App\Http\Controllers\api\PatientController::class, 'updateEmail']);

Route::put('telephone/medecin/{telephone}/{id}', [\App\Http\Controllers\api\MedecinController::class, 'updateTelephone']);
Route::put('telephone/patient/{telephone}/{id}', [\App\Http\Controllers\api\PatientController::class, 'updateTelephone']);
