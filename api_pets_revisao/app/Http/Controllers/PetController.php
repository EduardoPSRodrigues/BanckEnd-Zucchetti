<?php

namespace App\Http\Controllers;

use App\Mail\SendWelcomePet;
use App\Models\People;
use App\Models\Pet;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class PetController extends Controller
{
    use HttpResponses;

    public function index(Request $request)
    {
        try {

            // pegar os dados que foram enviados via query params
            $filters = $request->query();

            // inicializa uma query, pois quero listar os pets com os filtros
            //Diferente de fazer um pet::all que retorna tudo
            //O objetivo disso é que eu quero montar a query para só depois executar o código
            $pets = Pet::query()
            //Selecionando apenas o que desejo que mostre
            ->select(
                'id',
                'pets.name as pet_name',
                'pets.race_id',
                'pets.specie_id'
                )
            //race é o nome do método que eu criei do relacionamento
            ->with(['race' => function ($query) {
                $query->select('name', 'id');
            }])
            #->with('race') // traz todas as colunas
            ->with('vaccines')
            ->with('specie'); //outro with para trazer as specie

            // verifica se filtro
            if ($request->has('name') && !empty($filters['name'])) {
                $pets->where('name', 'ilike', '%' . $filters['name'] . '%');
            }
            /*ilike é para pesquisar tanto maiusculo quanto minusculo e a porcentagem é para pesquisar
            tanto no inicio quando no final da palavra */

            if ($request->has('age') && !empty($filters['age'])) {
                $pets->where('age', $filters['age']);
            }

            if ($request->has('size') && !empty($filters['size'])) {
                $pets->where('size', $filters['size']);
            }

            if ($request->has('weight') && !empty($filters['weight'])) {
                $pets->where('weight', $filters['weight']);
            }

            // retorna o resultado
            $columnOrder = $request->has('order') && !empty($filters['order']) ?  $filters['order'] : 'name';

            return $pets->orderBy($columnOrder)->get();
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function store(Request $request)
    {
        try {
            // rebecer os dados via body
            $data = $request->all();

            $request->validate([
                'name' => 'required|string|max:150',
                'age' => 'int',
                'weight' => 'numeric',
                'size' => 'required|string|in:SMALL,MEDIUM,LARGE,EXTRA_LARGE',
                'race_id' => 'required|int',
                'specie_id' => 'required|int',
                'client_id' => 'int'
            ]);

            $pet = Pet::create($data);

            //Verifica se o pet tem dono (client_id)
            if (!empty($pet->client_id)) {

                //Se tiver dono, vai salvar os dados do cliente que passamos o id e salvar em people
                $people = People::find($pet->client_id);

                //Pegarei o email no banco de dados e o nome do client e enviarei o email
                Mail::to($people->email, $people->name)
                    ->send(new SendWelcomePet($pet->name, 'Eduardo Phelipe'));
            }

            return $pet;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id){
        $pet = Pet::find($id);

        if(!$pet) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);

        $pet->delete();

        return $this->response('',Response::HTTP_NO_CONTENT);

    }
}

/*Informações do projeto

Mail::to('eduardo_rodrigues10@estudante.sesisenai.org.br', 'Eduardo Phelipe')
             ->send(new SendWelcomePet($pet->name, 'Eduardo Phelipe'));
            //  $pet->name, 'Eduardo Phelipe é o contructor da classe, é por aqui que enviarei informações que
            //irei capturar no html para usar no email*/
