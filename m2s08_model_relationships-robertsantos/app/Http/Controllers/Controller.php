<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //Função de resposta para todo o código
    public function response($data, $message, $status = true, $statusCode = Response::HTTP_OK)
    {
        $data = [
            "status"=> $status,
            "message"=> $message,
            "data"=> $data,
        ];

        return response()->json($data, $statusCode);
    }

    //Função de error para todo o código
    public function error($message, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return $this->response(null, $message, false, $statusCode);
    }
}
