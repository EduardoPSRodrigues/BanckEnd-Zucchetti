<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Traits\HttpResponses;
use App\Traits\ManageFileCsv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\Response;

class ImportPeoplesController extends Controller
{

    use HttpResponses;
    use ManageFileCsv;

    public function import(Request $request)
    {

        try {
            DB::beginTransaction();
            // Verifica se a solicitação contém um arquivo CSV
            //file foi o mesmo nome dado no insomnia no campo do multipart form data
            if ($request->hasFile('file')) {
                $file = $request->file('file'); //pegar o arquivo da requisição e armazenar na variável

                $csvArray = $this->getArrayCsv($file, 4); //4 significa a quantidade de coluna do arquivo

                //foreach no array para conseguir criar dado por dado na tabela
                foreach ($csvArray as $item) {

                    $peopleExist = People::query()
                        ->where('cpf', $item['cpf']) //tem uma pessoa com esse cpf ou email se tiver nao cadastra
                        ->orWhere('email', $item['email'])
                        ->first(); //retorna em formato de objeto

                    if (!$peopleExist) People::create($item); //senao tiver essa pessoa, entao é para cadastrar do contrario nao fazer nada
                }

                DB::commit();

                return $this->response('Importado com sucesso', 201);
            } else {
                return $this->response("Arquivo ausente", 400);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
