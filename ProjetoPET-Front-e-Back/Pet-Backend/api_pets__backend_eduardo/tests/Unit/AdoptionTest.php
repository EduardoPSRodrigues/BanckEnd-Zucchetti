<?php

namespace Tests\Feature;

use App\Models\Adoption;
use App\Models\People;
use App\Models\Pet;
use App\Models\Race;
use App\Models\Specie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdoptionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_add_new_adoption(): void
    {

        $specie = Specie::factory()->create();
        $race = Race::factory()->create();
        $pet  = Pet::factory()->create(['race_id' => $race->id, 'specie_id' => $specie->id]);

        Pet::factory(20)->create(['race_id' => $race->id, 'specie_id' => $specie->id]);

        $body = [
            'name' => 'Henrique',
            'contact' => '85 99181-1111',
            'email' => 'h@gmail.com',
            'cpf' => '07471899352',
            'observations' => 'Quero um gato pra pegar rato',
            'pet_id' => $pet->id
        ];

        $response = $this->post('/api/pets/adocao', $body);

        $this->assertDatabaseCount('adoptions', 1);

        $response->assertStatus(201);
        $response->assertJson([
            ...$body,
            'status' => 'PENDENTE'
        ]);
    }

    public function test_can_get_all_adoptions(): void
    {

        $specie = Specie::factory()->create();
        $race = Race::factory()->create();
        $pet  = Pet::factory()->create(['race_id' => $race->id, 'specie_id' => $specie->id]);

        Adoption::factory(10)->create(['pet_id' => $pet->id]);

        $this->assertDatabaseCount('adoptions', 10);

        $user = User::factory()->create(['profile_id' => 3, 'password' => '12345678']);

        $response = $this->actingAs($user)->get('/api/adoptions');
        $response->assertStatus(200);

        // VER qual o problema
        /*
        $response->assertJsonStructure([
            '*' => [
                'id' => true,
                'name' => true,
                'email' => true,
                'cpf' => true,
                'contact' => true,
                'observations' =>  true,
                'status' => true,
                'pet_id' => true
            ]
        ]);
        */
    }

    public function test_user_can_add_realized_adoption(): void
    {

        $specie = Specie::factory()->create();
        $race = Race::factory()->create();
        $pet  = Pet::factory()->create(['race_id' => $race->id, 'specie_id' => $specie->id]);

        $adoption = Adoption::factory()->create(['pet_id' => $pet->id]);
        $user = User::factory()->create(['profile_id' => 3, 'password' => '12345678']);

        $this->assertDatabaseHas('adoptions', ['id' => $adoption->id, 'status' => 'PENDENTE']);
        $response = $this->actingAs($user)->post('/api/adoptions/realized', ['adoption_id' => $adoption->id]);

        /* Verifica a mudança de status */
        $this->assertDatabaseHas('adoptions', ['id' => $adoption->id, 'status' => 'APROVADO']);
        /* Verifica a criação da pessoa e do cliente */
        $this->assertDatabaseHas('peoples', ['email' => $adoption->email, 'cpf' => $adoption->cpf]);
        $people = People::query()->where(['cpf' => $adoption->cpf])->first();
        $this->assertDatabaseHas('clients', ['people_id' => $people->id]);
        /* Verifica se pet recebeu o id do cliente */
        $people->load('client');
        $this->assertDatabaseHas('pets', ['id' => $pet->id, 'client_id' => $people->client->id]);
        /* Verifica se criou a solicitação com o id do cliente vinculado */
        $this->assertDatabaseHas('solicitations_documents', ['client_id' =>  $people->client->id]);

        $response->assertStatus(201);
        $response->assertJson([
            'id' => true,
            'people_id' => true,
            'bonus' => true
        ]);

    }
}
