<?php

use Illuminate\Support\Facades\Route;

/*Importando o Controller */
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Toda rota do navegador é do tipo GET 
Então coloco o caminho que a página está, depois passo o nome do arquivo que foi importado e por fim
passo o nome da function que está no controller que quero acessar.*/

Route::get('/', [HomeController::class, 'RendirizarHome']);