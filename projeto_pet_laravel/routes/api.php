<?php

//use Illuminate\Http\Request;

use App\Http\Controllers\PetController;
use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

/*Chamo a rota, escolho o método que desejo get, put, delete... coloco a url que desejo acessar, mas aqui pode colocar
só o final do nome pois ele completa o localhost e depois coloco o nome da classe do controller e por fim o nome da função*/

Route::get('pets', [PetController::class, 'index']); // Retornar todas as informações
Route::post('pets', [PetController::class, 'store']); //Cadastrar uma nova informação
Route::delete('pets/{id}', [PetController::class, 'destroy']); //Irei receber pela rota um paramentro de id
Route::get('pets/{id}', [PetController::class, 'show']); //Para listar apenas um item
Route::put('pets/{id}', [PetController::class, 'update']); //Atualizar um dado


// Equivalente ate a questão do id no route params
//  Route::resource('pets', PetController::class)
//    ->only(['index', 'show', 'store', 'update', 'destroy']);

Route::post('races', [RaceController::class, 'store']); //Cadastrar uma informação
Route::get('races', [RaceController::class, 'index']); //Listar todas as informações

