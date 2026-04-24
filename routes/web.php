<?php

use App\Http\Controllers\web\CompetenceController;
use App\Http\Controllers\web\ConnexionController;
use App\Http\Controllers\web\InterventionController;
use App\Http\Controllers\web\UserCompetenceController;
use App\Http\Controllers\web\UtilisateurController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/web/competences', [CompetenceController::class, 'index']);
Route::get('/web/utilisateurs', [UtilisateurController::class, 'index']);
Route::get('/web/interventions', [InterventionController::class, 'index']);
Route::get('/web/user-competence', [UserCompetenceController::class, 'index']);
Route::get('/web/connexion', [ConnexionController::class, 'index']);

// Routes pour la liaison utilisateur-compétence
Route::get('/web/user-competence/competences/{codeUser}', [UserCompetenceController::class, 'getCompetencesByUser']);
Route::get('/web/user-competence/utilisateurs/{codeComp}', [UserCompetenceController::class, 'getUsersByCompetence']);
Route::post('/web/user-competence/assign', [UserCompetenceController::class, 'assignCompetence']);
Route::post('/web/user-competence/remove', [UserCompetenceController::class, 'removeCompetence']);
