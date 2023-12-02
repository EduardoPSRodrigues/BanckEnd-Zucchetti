<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gender as GenderModel;
use App\Models\User as UserModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Por padrão já vem configurado quando se cria um projeto, pois isso não houve a necessidade de criar
        //um UserSeeder como no caso do Gender
        if(!UserModel::count())
        {
            UserModel::factory(10)->create();
        }

        //Informar o Model que é para ele contar, se estiver vazio é para chamar (call) a classe GenderSeeder
        if(!GenderModel::count())
        {
            $this->call([GenderSeeder::class]);
        }
    }
}
