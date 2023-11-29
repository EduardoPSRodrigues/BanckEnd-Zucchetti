<?php

namespace App\Http\Controllers;

use App\Models\Pet; //Importar a classe Pet
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(Request $request)
    {
        try {
            // pegar os dados que foram enviados via query params
            $params = $request->query();

            // inicializa uma query (Select * from pets) A partir dos if que vou aumentando a query
            $pets = Pet::query();

            // verifica se tem filtro
            if ($request->has('name') && !empty($params['name'])) {
                //Código abaixo estou buscando um nome que foi digitado independente de ter caixa alta ou baixa por
                //conta do ilike e será procurado tanto no inicio quanto no final da palavra por conta do simbolo de %
                $pets->where('name', 'ilike', '%' . $params['name'] . '%');
                //Ocorre uma concatenação de query (Select * from pets where name = :name)
            }

            if ($request->has('age') && !empty($params['age'])) {
                $pets->where('age', $params['age']);
                //(Select * from pets where name = :name and age = :age)
            }

            // if ($request->has('size') && !empty($params['size'])) {
            //     $pets->whereIn('size', ['SMALL', 'LARGE']);
            // }

            return $pets->orderBy('name')->get();
        } catch (\Throwable $th) {
            return "Houve um erro ao listar os pets";
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        //Cadastrar um Pet, dessa forma dá erro, pois eu preciso ir na classe Pet e dizer quais campos são cadastraveis
        $pet = Pet::create($data);
        return $pet;
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);

        if (!$pet) return $this->response('Pet não encontrado', null, false, 404);

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
        $data = $request->all();
        $pet = Pet::find($id);

        if (!$pet) return $this->response('Pet não encontrado', null, false, 404);

        $pet->update($data);
        return $pet;
    }
}

/*INFORMAÇÕES DO PROJETO
1 - $pet->update($data); $data atualiza os campos dentro do fillabel, se passar apenas um campo, será atualizado só um item e deixa os demais intactos
2 - $data = $request->all(); pegando todos os dados do body
3 - if (!$pet) return $this->response('Pet não encontrado', null, false, 404);
       Equivalente
       if (empty($pet)) return $this->response('Pet não encontrado', null, false, 404);
4 - Resquest é uma classe por isso usa a ->
    Irei armazenar no data todas as informações que foi enviado nessa requisição
        $data = $request->all();
        var_dump($data); //Coloquei apenas para ver no thunderclient

    Para pegar apenas o nome
        $name = $request->input('name');
        var_dump($name); //Coloquei apenas para ver no thunderclient

    Cadastrar um Pet, é preciso ir na classe Pet e dizer quais campos são cadastraveis
5 -         $params = $request->query(); Para Pegar dados da URL via query params

            //$pets = Pet::all(); // Trazer todos os pets

            $pets = Pet::where('age', $params['age'])->get(); //Filtrar os pets por uma idade especifica
            // $params['age'] siginifica que é o valor que foi enviado via query params

            //$pets = Pet::where('age', $params['age'])->toSql(); //Devolve o sql por baixo dos panos

            $request->has('age') has retorna um boolean se tem ou nao aquela informação

            se veio name e esse parametro nao esta vazio entao irei filtrar o name via query params
            if ($request->has('name') && !empty($params['name'])) {
            $pets->where('name', $params['name']);
            }





*/
