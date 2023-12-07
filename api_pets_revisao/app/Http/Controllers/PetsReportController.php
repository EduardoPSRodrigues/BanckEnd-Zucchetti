<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Barryvdh\DomPDF\Facade\Pdf; //importação para exportar o pdf
use Illuminate\Http\Request;

class PetsReportController extends Controller
{
    public function export(Request $request) {
        $pets = Pet::query();

        $filters = $request->query();

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

        //get finaliza a pesquisa com os filtros e traz o resultado
        $result = $pets->get();

        //Carrega o arquivo - loadView é o caminho onde que está o arquivo e começa a procurar na pasta view
        $pdf = Pdf::loadView('pdfs.petsTable', [
            'pets' => $result
        ]);

        //Salva o arquivo com o nome expecificado
        return $pdf->stream('relatorio.pdf');
    }

}
