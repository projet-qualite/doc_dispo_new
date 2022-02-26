<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\HopitalController;
use App\Http\Controllers\AffilierController;
use App\Http\Controllers\SpecialiteHopitalController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\MotifConsultationController;
use App\Http\Controllers\CreneauController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProcheController;
use App\Http\Controllers\RdvController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[UsersController::class, 'homepage']);
Route::get('/partenaires',[UsersController::class, 'partenaires']);
Route::get('/comment-ca-marche',[UsersController::class, 'commentCaMarche']);
Route::get('/pourquoi-doc-et-moi',[UsersController::class, 'pourquoiDoc']);
Route::get('/accessibilite',[UsersController::class, 'accessibilite']);
Route::get('/politique-de-confidentialite',[UsersController::class, 'politiqueDeConfidentialite']);

Route::get('/medecins', [UsersController::class, 'getMedecins']);
Route::get('/medecin/{slug}', [UsersController::class, 'medecin']);
Route::get('/hopital/{slug}', [UsersController::class, 'hopital']);
Route::get('/medecin/{slug}', [UsersController::class, 'medecin']);

Route::get('/rdv/prochains', [UsersController::class, 'rdvProchains']);
Route::get('/rdv/passes', [UsersController::class, 'rdvPasses']);

Route::get('/connecter_admin', [AdminController::class, 'connexion']);
Route::get('/connexion_admin', [UsersController::class, 'connexionAdmin']);

Route::get('/forgot', [UsersController::class, 'mdp_oublie']);
Route::get('/mdp_oublie', [UsersController::class, 'forgot']);


Route::get('/assurance', [AssuranceController::class, 'view']);
Route::post('/assurance', [AssuranceController::class, 'ajouter']);
Route::get('/assurance/{slug}', [AssuranceController::class, 'modifierView']);
Route::put('/assurance/{slug}', [AssuranceController::class, 'modifier']);
Route::get('/delete-assurance/{id}', [AssuranceController::class, 'supprimer']);

Route::get('/specialite', [SpecialiteController::class, 'view']);
Route::post('/specialite', [SpecialiteController::class, 'ajouter']);
Route::get('/specialite/{slug}', [SpecialiteController::class, 'modifierView']);
Route::put('/specialite/{slug}', [SpecialiteController::class, 'modifier']);
Route::get('/delete-specialite/{id}', [SpecialiteController::class, 'supprimer']);



Route::get('/dashboard', [UsersController::class, 'dashboard']);
Route::get('/connexion', [UsersController::class, 'connexionView']);
Route::get('/connecter', [UsersController::class, 'connexion']);
Route::get('/inscription', [UsersController::class, 'inscriptionView']);
Route::post('/inscription', [UsersController::class, 'inscription']);
Route::get('/logout', [UsersController::class, 'logout']);
Route::get('/parametre', [UsersController::class, 'parametreView']);



Route::get('/affilier', [HopitalController::class, 'ajouterAffiliationView']);
Route::post('/affilier', [AffilierController::class, 'ajouter']);
Route::get('/delete-affiliation/{id}', [AffilierController::class, 'supprimer']);
Route::get('hopital-specialite', [HopitalController::class, 'ajouterSpecialiteView']);
Route::put('/parametre/hopital', [HopitalController::class, 'parametre']);
Route::put('/parametre/mdp/hopital', [HopitalController::class, 'changeMdp']);
Route::post('/hopital-specialite', [SpecialiteHopitalController::class, 'ajouter']);
Route::get('/delete/specialite/hopital/{id}', [SpecialiteHopitalController::class, 'supprimer']);

Route::get('/medecins/hopital', [HopitalController::class, 'medecins']);


Route::get('/admin/hopitaux', [HopitalController::class, 'hopitaux']);
Route::get('/activer-hopital/{slug}', [HopitalController::class, 'activer']);
Route::get('/desactiver-hopital/{slug}', [HopitalController::class, 'desactiver']);
Route::get('/admin-hopital/{slug}', [HopitalController::class, 'detailHopital']);



Route::get('/activer-medecin/{slug}', [MedecinController::class, 'activer']);
Route::get('/desactiver-medecin/{slug}', [MedecinController::class, 'desactiver']);
Route::get('/medecin-hopital/{slug}', [MedecinController::class, 'detailMedecin']);

Route::put('/parametre/medecin', [MedecinController::class, 'parametre']);
Route::put('/parametre/medecin/specialite', [MedecinController::class, 'parametreSpecialite']);
Route::put('/parametre/mdp/medecin', [MedecinController::class, 'changeMdp']);



Route::get('/motif', [MotifController::class, 'view']);
Route::post('/motif', [MotifController::class, 'ajouter']);
Route::get('/motif/{slug}', [MotifController::class, 'modifierView']);
Route::put('/motif/{slug}', [MotifController::class, 'modifier']);
Route::get('/delete-motif/{id}', [MotifController::class, 'supprimer']);



Route::get('/motifs/medecin', [MotifConsultationController::class, 'ajouterMotifConsultationView']);
Route::post('/motifs/medecin', [MotifConsultationController::class, 'ajouter']);
Route::get('/delete-affiliation/{id}', [MotifConsultationController::class, 'supprimer']);



Route::get('/creneau', [CreneauController::class, 'ajouterCreneauView']);
Route::post('/creneau', [CreneauController::class, 'ajouter']);
Route::get('/delete-creneau/{id}', [CreneauController::class, 'supprimer']);


Route::put('/parametre/patient', [PatientController::class, 'parametre']);
Route::put('/parametre/mdp/patient', [PatientController::class, 'changeMdp']);



Route::get('/proche', [ProcheController::class, 'ajouterProcheView']);
Route::post('/proche', [ProcheController::class, 'ajouter']);
Route::get('/proche/{slug}', [ProcheController::class, 'modifierView']);
Route::put('/proche/{slug}', [ProcheController::class, 'modifier']);
Route::get('/delete-proche/{id}', [ProcheController::class, 'supprimer']);



Route::get('/medecins/specialite/{spe}', [MedecinController::class, 'medecinsSpecialite']);
Route::get('/hopitaux/assurance/{ass}', [HopitalController::class, 'hopitauxAssurances']);


Route::post('/ajouter/rdv/{id}', [RdvController::class, 'ajouter']);
Route::get('/annuler/rdv/{slug}', [RdvController::class, 'supprimer']);


Route::get('/forgot/{token}/{email}', [\App\Http\Controllers\PasswordResetsController::class, 'reset']);
Route::get('/reset/{token}/{email}', [\App\Http\Controllers\PasswordResetsController::class, 'resetUpdate']);
//Route::get('/annuler/rdv/{slug}', [RdvController::class, 'supprimer']);



Route::get('/mail',function(){
    return view('mails.mail');
});



Route::get('/page/home', [AdminController::class, 'home']);
Route::get('/page/comment_ca_marche', [AdminController::class, 'commentCaMarche']);
Route::get('/page/connexion', [AdminController::class, 'connexion']);
Route::get('/page/inscription', [AdminController::class, 'inscription']);
Route::get('/page/mot_de_passe_oublie', [AdminController::class, 'motDePasseOublie']);
Route::get('/page/footer', [AdminController::class, 'footer']);



Route::post('/page/entite/{id}', [\App\Http\Controllers\EntiteController::class, 'ajouter']);
Route::get('/page/entite/{id}', [AdminController::class, 'showView']);
Route::get('/page/entite/mod/{id_partie}/{id}', [AdminController::class, 'modifierEntiteView']);
Route::put('/page/entite/mod/{id_partie}/{id}', [\App\Http\Controllers\EntiteController::class, 'modifier']);


Route::get('/page/img/entite/{id}', [AdminController::class, 'showView']);
Route::put('/page/img/entite/{id}', [\App\Http\Controllers\EntiteController::class, 'imgModifier']);


Route::get('/mail', function (){
    return view('mails.mail');
});
