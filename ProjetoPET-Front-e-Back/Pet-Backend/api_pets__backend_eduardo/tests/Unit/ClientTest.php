<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\User;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_use_can_add_new_client(): void
    {
        $user = User::factory()->create(['profile_id' => 3, 'password' => '12345678']);

        $body = [
            'name' => 'Douglas',
            'cpf' => '999.999.999-99',
            'email' => 'h@gmail.com',
            'contact' => '8599181-1333'
        ];

        $response = $this->actingAs($user)->post('/api/clients', $body);

        $this->assertDatabaseHas('peoples', ['cpf' => $body['cpf'], 'email' => $body['email']]); //como nao sei o id que foi adicionado durante o teste e sei que o cpf e o email sao unicos entao estou usando essas chaves para verificar se foi criado
        $this->assertDatabaseCount('clients', 1); //como criei apenas um usuario, estou contando se tem 1 client criado

        $response->assertStatus(201);
        $response->assertJson([
            'id' => true,
            'name' => $body['name'],
            'cpf' => $body['cpf'],
            'email' => $body['email'],
            'contact' => $body['contact']
        ]);
    }
}
