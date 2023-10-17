<?php
header("Content-Type: application/json"); // a aplicação retorna json
header("Access-Control-Allow-Origin: *"); // vai aceitar requisições de todas origens
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // habilita métodos
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD']; //Salvarei na variável o tipo de método que estou pegando

//Será gerado uma ficha
if($method === 'POST') {
    // capturar o body da requisicao que vem em string e depois transformo para json
    $body = json_decode(file_get_contents("php://input")); 
    
    $name = filter_var($body->name, FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf = filter_var($body->cpf, FILTER_SANITIZE_SPECIAL_CHARS);
    $type = filter_var($body->type, FILTER_VALIDATE_INT);

    if(!$name || !$cpf || !$type) {
        echo json_encode(['error' => 'Faltaram informações para iniciar o atendimento']);
    }

    //Primeiro irei ler o arquivo de fila de atendimento para ver se tem informação
    //Depois irei fazer o push de informação
    //json_decode transformar o que é string em um array php
    $filaAtendimento = json_decode(file_get_contents('filaAtendimento.txt'));

    //array_push joga a informação para o final do array
    if($type === 1) {
        array_push($filaAtendimento, ['name' => $name, 'cpf' => $cpf]);
    } 
    //array_unshift joga a informação para o começo do array
    else if ($type === 2){
        array_unshift($filaAtendimento, ['name' => $name, 'cpf' => $cpf]);
    }

    //jogando o array do body para dentro do arquivo txt e codificar ele para ser em json
    file_put_contents('filaAtendimento.txt', json_encode($filaAtendimento));

    http_response_code(201);
    echo json_encode(['message' => 'Aguarde sua vez !!!']);
}