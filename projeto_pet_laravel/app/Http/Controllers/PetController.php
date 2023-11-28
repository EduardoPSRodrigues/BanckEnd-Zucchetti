<?php

namespace App\Http\Controllers;

use App\Models\Pet; //Importar a classe Pet
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        try {

            $pets = Pet::all();
            return $pets;
        } catch (\Throwable $th) {
            return "Houve um erro ao listar os pets";
        }
    }

    public function store(Request $request)
    {

        //Resquest é uma classe por isso usa a ->
        //Irei armazenar no data todas as informações que foi enviado nessa requisição
        $data = $request->all();
        //var_dump($data); //Coloquei apenas para ver no thunderclient

        //Para pegar apenas o nome
        //$name = $request->input('name');
        //var_dump($name); //Coloquei apenas para ver no thunderclient

        //Cadastrar um Pet, dessa forma dá erro, pois eu preciso ir na classe Pet e dizer quais campos são cadastraveis
        $pet = Pet::create($data);
        return $pet;
    }

    public function destroy($id)
    {
       $pet = Pet::find($id);

       if (!$pet) return $this->response('Pet não encontrado', null, false, 404);
    //    Equivalente
    //    if (empty($pet)) return $this->response('Pet não encontrado', null, false, 404);

       $pet->delete();
       return $this->response('', null, true, 204);

    }

    public function show($id)
    {
       $pet = Pet::find($id);

       if (!$pet) return $this->response('Pet não encontrado', null, false, 404);

       return $this->response('', $pet, true, 200);

    }

    public function update($id, Request $request)
    {
        $data = $request->all(); //pegando todos os dados do body
        $pet = Pet::find($id);

       if (!$pet) return $this->response('Pet não encontrado', null, false, 404);

       $pet->update($data); //$data atualiza os campos dentro do fillabel, se passar apenas um é ele atualiza só um item e
       //deixa os demais intactos
       return $pet;

    }
}
