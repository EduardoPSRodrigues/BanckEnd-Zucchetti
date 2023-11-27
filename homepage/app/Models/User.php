<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /*Para enviar as informações para o banco de dados, passa desse forma que por baixo dos panos
    é como se estivesse fazendo um insert into e estará criando essas 4 variaveis no banco de dados */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'birthdate',
    ];

    /*Caso eu queira juntar as informações de duas variaveis, um jeito mais facil de fazer a concatenação
    é com o Mutador (Mutador) */

    public function getFullNameAttribute(): string 
    {
        return $this->name. ' '.$this->last_name;
    }

}


