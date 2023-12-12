<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory;
    use SoftDeletes;

    // altera o nome da tabela buscada pelo modelo
    protected $table = 'pets';

    protected $fillable = ['name', 'weight', 'size', 'age', 'race_id', 'specie_id', 'client_id'];

    protected $hidden = ['created_at','updated_at']; //Esconde essas informações quando fizer um find ou all

    /*Relacionamento
    Estou em PET e quero fazer um relacionamento com as raças, sendo que
    1 pet tem 1 raça
    Regra do laravel se for um relacionamento que tem 1 classe, coloca no singular, se tiver mais relacionamentos
    como hasmany, ai coloca no plural*/
    public function race() {
        return $this->hasOne(Race::class, 'id', 'race_id');
    }

    public function specie() {
        //id é chave primeira da tabela specie e fará referencia com a coluna specie_id da tabela PET
        return $this->hasOne(Specie::class, 'id', 'specie_id');
    }

     public function vaccines(){
         return $this->hasMany(Vaccine::class);
     }
}
