<?php

use App\Http\Controllers\ArtistsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//except significa os campos que a gente quer que ele não tem
Route::resource('artists', ArtistsController::class)->except(['create', 'edit']);
