<?php

namespace App\Interfaces;

use App\Models\Pet; //trabalhar com o banco de dados

interface PetRepositoryInterface {

    public function createOne(array $data);
    public function getOne($id);
    public function updateOne(Pet $pet, $id);
}
