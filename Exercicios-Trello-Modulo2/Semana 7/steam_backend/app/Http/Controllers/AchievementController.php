<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        //Pegando o id na requisição
        $product_id = $request->query('product_id');

        //Listar apenas o id do jogo que desejo listar
        //Fazer um select onde o product_id da requisição for igual o product_id da tabela
        $achievements = Achievement::query()->where('product_id', $product_id)->get();
        return $achievements;
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $request->validate([
                "product_id" => 'integer|required',
                "url" => 'string|required',
                "name" => 'string|required'
            ]);

            $achievement = Achievement::create($data);
            return $achievement;
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function show($id)
    {
        $achievement = Achievement::find($id);

        if (!$achievement) return response()->json(['message' => 'Conquista não foi encontrada'], 404);

        return $achievement;
    }

    public function update($id, Request $request){
        try {

            $achievement = Achievement::find($id);

            if(!$achievement) return response()->json(['message' => 'Conquista não foi encontrada'], 404);

            $request->validate([
                "product_id" => 'integer|required',
                "url" => 'string|required',
                "name" => 'string|required'
            ]);

            $achievement->update($request->all());

            return $achievement;

        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        $achievement = Achievement::find($id);

        if(!$achievement) return response()->json(['message' => 'A conquista não foi encontrada! Por favor, tente novamente ou envie um ticket para nosso suporte.'], 404);

        $achievement->delete();

        return response(['message' => 'A conquista foi excluída com sucesso!'], 204);
    }
}
