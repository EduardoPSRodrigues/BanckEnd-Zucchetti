<?php
    // 1 - Carregar o autoload
     require_once '../vendor/autoload.php';

     function sendEmail($destinario, $nomeDestinatario, $subject) {
        //Importando uma classe para a variável phpmailer
        $phpmailer = new PHPMailer\PHPMailer\PHPMailer();

        //Protocolo para enviar o email (SMTP ou POP3)
        $phpmailer->isSMTP();
        //Origem de onde o email vai sair (pegar os dados no mail trap para teste)
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        //Autenticação do email e senha
        $phpmailer->SMTPAuth = true;
        //Porta do host que estará acessível (mailtrap)
        $phpmailer->Port = 587;
        //Usuário (mailtrap)
        $phpmailer->Username = '20d03d19ee0483';
        //Senha (mailtrap)
        $phpmailer->Password = '4a205d06e61235';

        //Configurações do email da pessoa que esta enviando (Email e o nome da pessoa)
        $phpmailer->setFrom('banco@gmail.com', 'Banco Meu Dinheiro');
        //Nome e Email do destinatário (Email e o nome da pessoa)
        $phpmailer->addAddress($destinario, $nomeDestinatario);
        //Assunto do email
        $phpmailer->Subject = $subject;
        //Comando para o código entender que deseja enviar um HTML
        $phpmailer->isHTML(true);
        //Mensagem que a pessoa deseja
        $phpmailer->Body ='
        <html>
            <head>
                <meta charset="UTF-8">
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f0f0f0;
                    }
                    .container {
                        background-color: #ffffff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
                    }
                    h1 {
                        color: red;
                    }
                    p {
                        color: #666;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Ola,</h1>
                    <p>Este é um exemplo de e-mail com estilo.</p>
                </div>
            </body>
        </html>';

        //Enviar o email
        $phpmailer->send();
     }
