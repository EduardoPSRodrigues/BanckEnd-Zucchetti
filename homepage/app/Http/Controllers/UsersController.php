<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*Importando o User e dando um nome para chamá-lo de forma mais fácil */
use App\Models\User as UserModel;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * Faz um get para trazer os dados
     */
    public function index()
    {
        $data = UserModel::all();
        return response($data);
    }

    /**
     * Store a newly created resource in storage.
     * Faz um post para criar os dados e salva eles
     */
    public function store(Request $request)
    {
        $data = UserModel::create($request);

        if (empty($data)) {
            return response(['message' => 'Não foi possível realizar essa ação'], 400);
        }

        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = UserModel::find($id);
        return response($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = UserModel::find($id);
        $user -> update($request);
        $user -> save();

        return response($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = UserModel::destroy($id);
        return response($data);
    }
}
