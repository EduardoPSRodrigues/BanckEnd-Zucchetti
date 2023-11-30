<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'cover', 'description'];

    //Essa propriedade tem a função de converter os dados da tabela price em números
    protected $casts = [
        'price' => 'float'
    ];
}
