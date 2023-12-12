<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Professional;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfessionalController extends Controller
{

    use HttpResponses;

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'string|required|max:255',
                'contact' => 'string|required|max:30',
                'email' => 'string|required|unique:peoples',
                'cpf' => 'string|required|max:30|unique:peoples',
                'register' => 'string|required',
                'speciality' => 'string|required'
            ]);

            //Vai pegar apenas esses dados para cadastrar na tabela People
            $dataPeople = $request->only('name', 'cpf', 'contact', 'email');
            //Vai pegar o restante para salvar na tabela Professional
            $dataProfessional = $request->only('register', 'speciality');

            $people = People::create($dataPeople);

            Professional::create([
                //Pegar esse dado direto da variavel people
                'people_id' => $people->id,
                //'register' => $dataProfessional['register'],
                //'speciality' => $dataProfessional['speciality']
                ...$dataProfessional
            ]);

            return $people;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function index(Request $request)
    {

        $search = $request->input('name'); // filtro query params

        $professionals = Professional::query()
            ->with('people')
            /*
            ->whereHas('people', function ($query) use ($search) {
                $query
                    // ->select('id','name','cpf', 'email', 'contact')
                    ->where('name', 'ilike', "%$search%")
                    ->orWhere('cpf', 'ilike', "%$search%")
                    ->orWhere('contact', 'ilike', "%$search%")
                    ->orWhere('email', 'ilike', "%$search%");
            })
            */
            ->get();

        return $professionals;
    }
}
