<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(){
        return 'ola laravel 222';
    }

    public function store(Request $request){

        //Resquest é uma classe por isso usa a ->
        //Irei armazenar no data todas as informações que foi enviado nessa requisição
        $data = $request->all();
        var_dump($data); //Coloquei apenas para ver no thunderclient

        //Para pegar apenas o nome
        $name = $request->input('name');
        var_dump($name); //Coloquei apenas para ver no thunderclient

    }
}
