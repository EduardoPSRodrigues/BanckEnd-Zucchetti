<?php

//use Illuminate\Http\Request;

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

/*Chamo a rota, escolho o método que desejo get, put, delete... coloco a url que desejo acessar, mas aqui pode colocar
só o final do nome pois ele completa o localhost e depois coloco o nome da classe do controller e por fim o nome da função */
Route::get('pets', [PetController::class, 'index']);
Route::post('pets', [PetController::class, 'store']);
