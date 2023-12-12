<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\People;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{

    use HttpResponses; //habilitar as traits que esta formatado os erros e respostas

    public function store(Request $request)
    {

        try {
            $data = $request->all();

            $request->validate([
                'name' => 'string|required|max:255',
                'contact' => 'string|required|max:30',
                'email' => 'string|required|unique:peoples',
                //o client tem um relacionamento com o peoples, então tenho que validar os dados do peoples
                'cpf' => 'string|required|max:30|unique:peoples'
            ]);

            //Por causa do relacionamento, tenho que criar a pessoa primeiro pois preciso do people_id para
            //cadastrar um cliente
            $people = People::create($data);

            //Pegando o id da pessoa criada
            Client::create([
                'people_id' => $people->id
                //o bonus já esta com default false, mas se quisesse cadastrar outra informação em client
                //era só colocar aqui
            ]);


            return $people;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }



    public function index(Request $request)
    {

        $search = $request->input('name');

        $clients = Client::query()
            //Fazendo uma seleção para trazer os dados
            ->select(
                    'id as client_id',
                    'bonus',
                    'people_id'
                    )
           // ->with('people') //nome que deu no relacionamento
           /* Refinamento para trazer apenas os itens abaixo com uma sub query*/
           ->with(
                [
                    'people' =>
                    fn ($query) => $query->select('id', 'name', 'cpf', 'email', 'contact')
                ]
            )

            //Tem um campo de pesquisa geral que posso pesquisar direto o campo name, cpf, email e contact
            //use é para ele acessar a variavel externa
            ->whereHas('people', function ($query) use ($search) {
                $query
                    // ->select('id','name','cpf', 'email', 'contact')
                    ->where('name', 'ilike', "%$search%")
                    ->orWhere('cpf', 'ilike', "%$search%")
                    ->orWhere('contact', 'ilike', "%$search%")
                    ->orWhere('email', 'ilike', "%$search%");
            })
            ->get();

        return $clients;
    }
}
