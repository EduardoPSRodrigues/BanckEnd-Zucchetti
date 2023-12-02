<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gender as GenderModel; //as é para renomear a importação

class GenderSeeder extends Seeder
{
    //Constante com os generos musicais
    const GENDERS = [
        'Dance/Eletrônica',
        'Rock',
        'Jazz',
        'R&B',
        'Country',
        'Pop',
        'Hip-hop',
        'Clássica',
        'Reggae',
        'Bossa Nova',
        'Kpop'
    ];

    //Responsavel por criar os dados na tabela
    public function run(): void
    {
        //self é como se fosse um this, mas é para constantes e classes. Esta olhando para ele mesmo
        foreach (self::GENDERS as $gender)
        {
            //firstOrCreate para não tem duplicidade no banco de dados
            GenderModel::firstOrCreate(['name' => $gender]);
        }
    }
}

/*No contexto geral, esse código percorre uma lista de gêneros (presumivelmente masculino, feminino, outros, etc.)
definidos em uma constante GENDERS, e para cada gênero na lista, ele verifica se já existe um registro correspondente
no banco de dados na tabela associada ao modelo GenderModel. Se não existir, ele cria um novo registro para esse gênero
na tabela GenderModel. Essa abordagem garante que cada gênero na lista seja representado como um registro na tabela
do banco de dados, evitando duplicatas.

GenderModel::firstOrCreate(['name' => $gender]);: Dentro do loop, isso chama o método estático firstOrCreate() do
modelo GenderModel (supondo que GenderModel seja o nome do modelo). Este método do Eloquent do Laravel tentará
encontrar um registro no banco de dados com base na condição fornecida, que neste caso é um array associativo
['name' => $gender]. Se não encontrar, ele criará um novo registro com os valores fornecidos no array.*/
