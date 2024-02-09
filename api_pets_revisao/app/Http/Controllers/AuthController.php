<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use HttpResponses;

    private $permissions = [
        'ADMIN' => [
            'create-races',
            'get-races',
            'create-species',
            'get-species',
            'delete-species',
            'create-pets',
            'get-pets',
            'delete-pets',
            'create-profissionals',
            'get-profissionals'
        ],
        'RECEPCIONISTA' => [
            'create-pets',
            'get-pets',
            'delete-pets',
            'export-pdf-pets',
            'create-clients',
            'get-clients',
            'get-species'
        ],
        'VETERINARIO' => [
            'create-races',
            'get-races',
            'create-species',
            'get-species',
            'delete-species',
            'create-pets',
            'get-pets',
            'delete-pets',
            'create-vaccines'
        ]
    ];

    public function store(Request $request)
    {
        try {
            $data = $request->only('email', 'password');

            $request->validate([
                'email' => 'string|required',
                'password' => 'string|required'
            ]);

            $authenticated = Auth::attempt($data); //Verifica se tem o usuario e a senha no banco de dados

            if (!$authenticated) {
                return $this->error('Não autorizado. Credenciais incorretas', Response::HTTP_UNAUTHORIZED);
            }

            $request->user()->tokens()->delete(); //Se o usuario ja tiver um token, eu deleto primeiro depois crio um novo token

            $profile = Profile::find($request->user()->profile_id); //Procura na tabela Profile o id do profissional com base nesse comando $request->user()->profile_id e na variavel profile retorna o nome do profile

            $permissionsUser =  $this->permissions[$profile->name]; //$profile->name é o nome do profile que eu recuperei na variavel $profile. Sendo que em permissionsUser retorna o array das permissões

            $token = $request->user()->createToken('simple', $permissionsUser); //Vai registrar o acesso do token - permissionsUser são a habilidades que o usuario vai ter, se logar como admin terá as permissões de admin e assim sucessivamente

            return $this->response('Autorizado', 201, [
                'token' => $token->plainTextToken,
                'permissions' => $permissionsUser
            ]);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->response('', Response::HTTP_NO_CONTENT);
    }
}
