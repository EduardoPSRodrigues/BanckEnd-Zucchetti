<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRaceRequest extends FormRequest
{

    protected $stopOnFirstFailure = true; //é para parar no primeiro erro da validação, nao precisa verificar tudo

    /**
     * Determine if the user is authorized to make this request.
     */

    public function authorize(): bool
    {
        return Auth::check(); //verifica se o usuario tem permissão para executar essa regra
    }

    /**
     * Colocar a validação dessa classe
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:races|max:50'
        ];
    }

    //customizar as mensagens de erro
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da raça é obrigatório',
            'name.unique' => 'Já existe uma raça cadastrada com esse nome',
            'name.max' => 'O nome da raça ultrapassa o limite de 50 caracteres',
            'name.string' => 'O nome deve ser uma string'
        ];
    }
}
