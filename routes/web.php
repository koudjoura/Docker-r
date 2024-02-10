<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FichierController;
use App\Http\Controllers\WelcomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/ajouter', [FichierController::class, 'create']);
Route::post('/ajouter', [FichierController::class, 'handleUpload']);
Route::post('/hebergement', [FichierController::class, 'startOrStop'])->name("hebergement");


