<?php

namespace App\Interfaces;

//Fala o que ela tem e o que ela faz e tem que ser nesse molde
//é bom para definir o que ele tem, quais métodos tem no repositorio
interface RaceRepositoryInterface {
    public function getAll();
    public function create(array $data);
}
