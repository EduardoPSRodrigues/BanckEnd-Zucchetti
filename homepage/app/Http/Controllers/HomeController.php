<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*Responsável por renderizar a tela do homepage.blade.php */

class HomeController extends Controller
{
    /*Pegar uma informação diretamente da rota e usar na página */
    public function RendirizarHome(Request $request){
        $nome = $request->query('nome');

        $data = !empty($nome) ? (object) ['name' => $nome] : null;
        /*Em vez de retornar um arquivo em json, vai retornar um HTML */
        return view('homepage', ['data' => $data]);
    }
}
