<?php

namespace Tests;

use Database\Seeders\InitialUser;
use Database\Seeders\Profiles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase; //Permite que o banco seja limpo a cada teste
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp(); //chama essa classe para executar todo o codigo dela mais as linhas debaixo
        //senao tivesse colocado esse comando, a classe setUp seria sobrescrevida

        //Já que a seed é executada toda vez para criar o usuario inicial e o profiles, entao nao preciso
        //chamar em todos os códigos, basta colocar no TestCase, pois esse codigo executa toda vez que o teste inicia
        $this->seed(Profiles::class);
        $this->seed(InitialUser::class);
    }
}
