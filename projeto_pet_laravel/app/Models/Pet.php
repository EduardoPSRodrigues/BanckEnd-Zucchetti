<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    //altera o noem da tabela buscada pelo modelo
    protected $table = 'pets';

    protected $fillable = ['name', 'age', 'weight', 'size'];

}
