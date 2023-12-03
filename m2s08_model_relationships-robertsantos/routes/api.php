<?php

use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\BandsController;
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
Route::resource('bands', BandsController::class)->except(['create', 'edit']);

// Caso queira mudar o nome padrão das funções como index, show...
// Route::prefix('bandas')->group(function () {
//   Route::get('/', [BandsController::class, 'listar']);
//   Route::get('/{id}', [BandsController::class, 'exibir']);
//   Route::post('/', [BandsController::class, 'cadastrar']);
//   Route::patch('/{id}', [BandsController::class, 'atualizar']);
//   Route::delete('/{id}', [BandsController::class, 'deletar']);
// });
