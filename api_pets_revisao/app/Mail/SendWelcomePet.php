<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendWelcomePet extends Mailable
{
    use Queueable, SerializesModels;

    //Create a new message instance.

    public $petName;
    public $clientName;

    //Método para receber dados
    public function __construct($petName, $clientName)
    {
        $this->petName = $petName;
        $this->clientName = $clientName;
    }

    // Configurar o título do email

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Boas vindas Pet Shop Laravel',
        );
    }

    /**
     * Configurar a template do email
     */
    public function content(): Content
    {
        return new Content(
            //Colocar o nome da pasta . nome do arquivo sem a extensão
            html: 'mails.welcomeTemplate',
        );
    }

    /**
     * Utilizando para anexar arquivos no email
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            //Irei enviar dois arquivos, como aqui é um array, estou usando a virgula para separar os documentos
            //Onde que ta o arquivo que deseja enviar, isso é o fromPath
            Attachment::fromPath(public_path('catalogo.pdf'))->as('novidades_da_loja.pdf'),
            Attachment::fromPath(public_path('gato.jpg'))
            #->as('novidades_da_loja.pdf') é o nome do arquivo que vai aparecer na mensagem
            #->withMime('application/pdf') significa a extensão do documento caso queira especificar

        ];
    }
}
