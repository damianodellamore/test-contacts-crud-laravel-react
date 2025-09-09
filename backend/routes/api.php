<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Qui registri tutte le rotte API. In Laravel 11 queste rotte usano già
| il middleware "api" (senza CSRF) e hanno prefisso automatico /api.
|
*/

Route::apiResource('contacts', ContactController::class);
