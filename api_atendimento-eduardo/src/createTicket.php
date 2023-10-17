<?php
require_once 'config.php';
require_once 'utils.php';
require_once 'email.php';

$method = $_SERVER['REQUEST_METHOD'];

//Será gerado uma ficha
if ($method === 'POST') {
    //Capturar o body da requisicao que vem em string e depois transformo para json
    $body = getBody();

    $name = filter_var($body->name, FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf = filter_var($body->cpf, FILTER_SANITIZE_SPECIAL_CHARS);
    $type = filter_var($body->type, FILTER_VALIDATE_INT);

    if (!$name || !$cpf || !$type) {
        echo json_encode(['error' => 'Faltaram informações para iniciar o atendimento']);
    }

    /*Primeiro irei ler o arquivo de fila de atendimento para ver se tem informação
    Depois irei fazer o push com a nova informação
    Em seguida usar o json_decode para transformar o que é string em um array php */

    $filaAtendimento =  readFileContent(ARQUIVO_FILA_ATENDIMENTO);

    if ($type === 1) {
        array_push($filaAtendimento, ['name' => $name, 'cpf' => $cpf]);
    } else if ($type === 2) {
        array_unshift($filaAtendimento, ['name' => $name, 'cpf' => $cpf]);
    }

    //Jogando o array do body para dentro do arquivo txt e codificar ele para ser em json
    file_put_contents(ARQUIVO_FILA_ATENDIMENTO, json_encode($filaAtendimento));

    http_response_code(201);
    //Enviar o email com o email selecionado, o segundo campo é o nome da pessoa (Campo Para) e o
    // terceiro campo é o assunto. 
    //O envio de email pode ser demorado entao é interessante implementar uma fila, pois caso falhe o envio
    //o sistema fica tentando várias vezes
    //Posso colocar infomações que se alteram na execução do projeto e enviar essas informações para o meu email 
    //via parametro
    sendEmail('email@gmail.com', $name, 'TICKET CRIADO');
    //Mostrar uma mensagem para o usuario aguardar a sua vez
    echo json_encode(['message' => 'Aguarde sua vez !!!']);
}

/* Informações do projeto
1 - array_push joga a informação para o final do array
2 - array_unshift joga a informação para o começo do array


*/