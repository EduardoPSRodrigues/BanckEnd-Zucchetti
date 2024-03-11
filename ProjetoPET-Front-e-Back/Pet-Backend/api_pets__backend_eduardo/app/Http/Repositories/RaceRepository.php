<?php

namespace App\Http\Repositories;

use App\Interfaces\RaceRepositoryInterface;
use App\Models\Race;

/*A interface é a cara daquela classe, não estende
Faz toda as operações com o banco de dados
focado em interagir com o banco de dados e retornar um dado
nao é para ter um if ou operações ao longo do processo*/
class RaceRepository implements RaceRepositoryInterface {

    public function getAll() {
        return Race::all();
    }

    public function create(array $data) {
        return Race::create($data);
    }

}


