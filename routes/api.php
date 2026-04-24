<?php

use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\InteventionController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\UserCompetenceController;
use Illuminate\Support\Facades\Route;


Route::get('competences/search', [CompetenceController::class, 'search']);//va créer la route de recherche
Route::apiResource('competences', CompetenceController::class);//va créer les routes post, put, get, delete
Route::apiResource('interventions', InteventionController::class);
Route::apiResource('utilisateurs', UtilisateursController::class);
Route::apiResource('user-competence', UserCompetenceController::class);