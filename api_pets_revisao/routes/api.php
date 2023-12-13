<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetsReportController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;

// BODY -> cadastrar, atualizar
// Query paraments -> GET -> listar dados
// Route params -> DELETE, PUT, GET(unico)->middleware(['auth:sanctum']);

//Espécie de segurança, agora essas rotas precisam de login para fazer o cadastro, deleção, listagem...
Route::middleware('auth:sanctum')->group(function () {

    Route::get('races', [RaceController::class, 'index']);
    Route::post('races', [RaceController::class, 'store']);

    Route::get('species', [SpecieController::class, 'index']);
    Route::post('species', [SpecieController::class, 'store']);
    Route::delete('species/{id}', [SpecieController::class, 'destroy']);
    //->middleware(['ability:delete-species']);

    Route::get('pets', [PetController::class, 'index']);
    Route::post('pets', [PetController::class, 'store']);
    Route::delete('pets/{id}', [PetController::class, 'destroy']);


    //Rota diferente do normal, sendo que é para exportar um documento pdf
    Route::get('pets/export', [PetsReportController::class, 'export']);

    Route::post('clients', [ClientController::class, 'store']); //->middleware(['ability:create-clients']);
    Route::get('clients', [ClientController::class, 'index']); //->middleware(['ability:get-clients']);

    Route::post('profissionals', [ProfessionalController::class, 'store']); //->middleware(['ability:create-profissionals']);
    Route::get('profissionals', [ProfessionalController::class, 'index']); //->middleware(['ability:get-profissionals']);

    Route::post('vaccines', [VaccineController::class, 'store']);//->middleware(['ability:create-vaccines']);

    Route::post('logout', [AuthController::class, 'logout']);

});

Route::post('login', [AuthController::class, 'store']);
Route::post('users', [UserController::class, 'store']);
