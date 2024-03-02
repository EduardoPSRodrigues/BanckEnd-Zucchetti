<?php

namespace App\Http\Controllers;

use App\Mail\SendDocuments;
use App\Models\Adoption;
use App\Models\Client;
use App\Models\File;
use App\Models\People;
use App\Models\Pet;
use App\Models\SolicitationDocument;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Symfony\Component\HttpFoundation\Response;

class AdoptionController extends Controller
{
    use HttpResponses;

    public function index(Request $request)
    {
        try {

            // pegar os dados que foram enviados via query params
            $filters = $request->query();

            // inicializa uma query
            $pets = Pet::query()
                ->select(
                    'id',
                    'pets.name as pet_name',
                    'pets.age as age'
                )
                #->with('race') // traz todas as colunas
                ->where('client_id', null);


            // verifica se filtro
            if ($request->has('name') && !empty($filters['name'])) {
                $pets->where('name', 'ilike', '%' . $filters['name'] . '%');
            }

            if ($request->has('age') && !empty($filters['age'])) {
                $pets->where('age', $filters['age']);
            }

            if ($request->has('size') && !empty($filters['size'])) {
                $pets->where('size', $filters['size']);
            }

            if ($request->has('weight') && !empty($filters['weight'])) {
                $pets->where('weight', $filters['weight']);
            }

            if ($request->has('specie_id') && !empty($filters['specie_id'])) {
                $pets->where('specie_id', $filters['specie_id']);
            }

            return $pets->orderBy('created_at', 'desc')->get();
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function show($id)
    {
        $pet = Pet::with("race")->with("specie")->find($id);

        if ($pet->client_id) return $this->error('Dados confidenciais', Response::HTTP_FORBIDDEN);

        if (!$pet) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);

        return $pet;
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all(); // pegar o body

            $request->validate([
                'name' => 'string|required|max:255',
                'contact' => 'string|required|max:20',
                'email' => 'string|required',
                'cpf' => 'string|required',
                'observations' => 'string|required',
                'pet_id' => 'integer|required',
            ]); // valida os dados

            $adoption = Adoption::create([...$data, 'status' => 'PENDENTE']);
            return $adoption;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function getAdoptions()
    {
        $adoptions = Adoption::query()->with('pet')->get();
        return $adoptions;
    }

    public function approve(Request $request)
    {

        try {

            /*Iniciando uma transação, ou seja, o laravel vai aceitar tudo ou nada, se ao longo do processo
            algumas tabelas tiverem sucesso e outras não, o laravel retornará um erro e nao permitirá salvar
            os dados da tabela que deu certo. Isso é um sistema de segurança, para isso precisa abrir o DB
            e fechar ele no final do codigo */
            DB::beginTransaction();

            // Atualiza o status da adoção para aprovado
            $data = $request->all();

            $request->validate([
                'adoption_id' => 'integer|required',
            ]);

            $adoption = Adoption::find($data['adoption_id']);

            if (!$adoption)  return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);

            $adoption->update(['status' => 'APROVADO']);
            $adoption->save();

            // efetivo o cadastro da pessoa que tem intenção de adotar no sistema
            $people = People::create([
                'name' => $adoption->name,
                'email' => $adoption->email,
                'cpf' => $adoption->cpf,
                'contact' => $adoption->contact,
            ]);

            $client = Client::create([
                'people_id' => $people->id,
                'bonus' => true
            ]);

            // vincula o pet com cliente criado

            $pet = Pet::find($adoption->pet_id);
            $pet->update(['client_id' => $client->id]);
            $pet->save();

            $solicitation = SolicitationDocument::create([
                'client_id' => $client->id
            ]);

            //Enviando um email
            Mail::to($people->email, $people->name)
                ->send(new SendDocuments($people->name, $solicitation->id));

            /*Se tudo der certo, commita todas as alterações nas tabelas */
            DB::commit();

            return $client;
        } catch (\Exception $exception) {
            /*Se alguma coisa deu errado, dá um rollback e cancela as alterações */
            DB::rollBack();
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function upload(Request $request)
    {

        //Tipo JSON não suporta enviar arquivo, para isso precisa enviar via Multipart Form
        $file = $request->file('file'); //Quer pegar um arquivo com o nome que passou no Insomnia
        $description =  $request->input('description'); //Pegar a variável description do Multipart Form
        $key =  $request->input('key'); //nome do campo do multiform data do frontend
        $id =  $request->input('id'); //nome do campo do multiform data do frontend

        /* criar nome amigável arquivo - site para manipular string https://laravel.com/docs/10.x/strings */
        $slugName = Str::of($description)->slug(); //Coloca tudo minusculo e retira o espaço por -
        $fileName = $slugName . '.' . $file->extension(); //Montar o nome do arquivo, concatenar o nome com a extensão do arquivo

        /* Enviar o arquivo para amazon */
        $pathBucket = Storage::disk('s3')->put('documentos', $file); //Quero acessar a configuração de disk da s3 e quero empurrar o arquivo para o nome da pasta que quero usar, senão tiver pasta será criada uma.
        $fullPathFile = Storage::disk('s3')->url($pathBucket); //Pegar toda a url onde foi armazenado o arquivo

        $file = File::create(
            [
                'name' => $fileName,
                'size' => $file->getSize(), //Pegar o tamanho do arquivo
                'mime' => $file->extension(), //Pegar a extensão do arquivo
                'url' => $fullPathFile
            ]
        );

        /*Para a url ficar disponivel tem que ir no bucket na AWS -> Permissões -> Politica do Bucket -> Editar
        colar o código da aula 1 - Semana 5 - Modulo 3 */

        $solicitation = SolicitationDocument::find($id);

        if(!$solicitation) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);

        $solicitation->update([$key => $file->id]); //se vier rg, atualiza rg, se for cpf, atualiza cpf com o id

        return ['message' => 'Arquivo criado com sucesso'];
    }
}
