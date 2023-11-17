<?php
require_once '../config.php';
require_once '../controllers/PetController.php';

$method = $_SERVER['REQUEST_METHOD'];
$controller = new PetController();

if ($method === 'POST') {
  $controller->createOne();
}
//Para entrar nesse campo tem que ser um GET e não ter informação do id no query parameters
else if ($method === 'GET' && !isset($_GET['id'])) {
  $controller->listAll();
}
//Enviar o id pela url para pegar todos os dados daquele id
else if ($method === 'GET' && $_GET['id']) {
  $controller->listOne();
} else if ($method === 'DELETE') {
  $controller->deleteOne();
} else if ($method === "PUT") {
  $controller->updateOne();
}
