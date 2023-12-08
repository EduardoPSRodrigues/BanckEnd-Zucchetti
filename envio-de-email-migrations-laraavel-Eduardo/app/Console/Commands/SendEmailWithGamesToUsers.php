<?php

namespace App\Console\Commands;

use App\Mail\SendEmailWithGames;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailWithGamesToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-with-games-to-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia um email com PDF contendo 10 jogos aleatórios do banco de dados as 08:00 todos os dias. ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::query()
        ->inRandomOrder() //Dados aleatórios
        ->take(10) //Pegando 10 dados
       // ->whereBetween('price', [20 , 100]) Exercício 03
        ->get();

        //Consigo visualizar no terminal o resultado do código acima com o comando
        //php artisan schedule:work
        //Despois de verificar o funcionamento, aí sim, coloco a classe de e-mail
        foreach ($products as $product) {
            Log::info($product->name);
        }

        Mail::to('eduardo_rodrigues10@estudante.sesisenai.org.br', 'Eduardo Rodrigues')
        ->send(new SendEmailWithGames($products));
        //Estou enviando os dados dos produtos na variavel $products para dentro do construtor
        //->send(new SendEmailWithGames($products));
    }
}
