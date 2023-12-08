<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmailWithGames extends Mailable
{
    use Queueable, SerializesModels;


    public $games;

    //informações que peguei do arquivo SendEmailWithGamesToUsers
    public function __construct($products)
    {
        $this->games = $products;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Olha as novidades ! 10 jogos para você',
            tags: ['Jogos', 'Recomendações']
        );
    }


    public function content(): Content
    {
        return new Content(
            html: 'emails.ListWithTenGamesTemplate',
        );
    }


     public function attachments(): array
     {
        //[ 'games' => $this->games] é a variavel que estou passando para o HTML para gerar o pdf
         $pdf = Pdf::loadView('pdfs.ListWithTenGamesPdf', [ 'games' => $this->games]);

         return [
            //fromPatch é quando sei onde o arquivo esta salvo no computador
            //fromData é quando o arquivo esta sendo gerado na memória, não está salvo no computador
             Attachment::fromData(fn () => $pdf->output())
             ->as('sugestoes_jogos.pdf') //Nome do arquivo
             ->withMime('application/pdf') //Extensão do arquivo
         ];
     }
}
