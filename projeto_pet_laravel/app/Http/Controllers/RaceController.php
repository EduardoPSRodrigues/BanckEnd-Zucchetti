<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Exception;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    public function index()
    {
        try {
            $races = Race::all();
            return $races;
        } catch (\Throwable $th) {
            return "Houve um erro ao listar as raças";
        }
    }

    public function store(Request $request)
    {
        try {
            //Validações para retornar uma mensagem tratando o erro
            $request->validate([
                'name' => 'required|string|unique:races|max:50',
            ]);

            $data = $request->all();

            $races = Race::create($data);
            return $races;
        } catch (Exception $error) {
            return $this->response($error->getMessage(), null, false, 400);
        }
    }
}
