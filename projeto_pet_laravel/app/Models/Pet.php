<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    //altera o noem da tabela buscada pelo modelo
    protected $table = 'pets';

    protected $fillable = ['name', 'weight', 'size', 'age', 'race_id'];

    protected $hidden = ['race_id'];

    public function race()
    {
        //Relacionamento de um para um
        return $this->hasOne(Race::class);
    }

}
