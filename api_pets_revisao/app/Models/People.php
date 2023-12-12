<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $table = "peoples"; //nome da tabela criada no banco de dados

    protected $fillable = ['name', 'cpf', 'email', 'contact'];

}
