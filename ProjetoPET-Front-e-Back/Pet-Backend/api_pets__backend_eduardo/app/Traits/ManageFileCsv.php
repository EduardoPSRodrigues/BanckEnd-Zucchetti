<?php

namespace App\Traits;

trait ManageFileCsv
{

    public function getArrayCsv($file, int $amountData, string $separator = ';',)
    {
        $contentFile = file_get_contents($file->getRealPath()); //pegar o arquivo e converter em uma string sendo que >getRealPath pega o caminho absoluto do arquivo

        //amountData é a quantidade de coluna do arquivo
        // Converte o conteúdo CSV para uma matriz associativa
        // $csvData = array_map('str_getcsv', explode("\n", $contentFile)); -> importa com ,

        // importa com ; quando vai usar algo dentro do map precisa colocar o use
        $csvData = array_map(function ($row) use ($separator) {
            return str_getcsv($row, $separator);
        }, explode("\n", $contentFile));

        // Pega as keys do array que é o cabeçalho, nome das tabelas
        $headers = array_shift($csvData);

        // remover caracteres estranhos das keys
        $headerParse = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $headers);

        $csvArray = [];

        foreach ($csvData as $row) {
            if (count($row) === $amountData) {
                $csvArray[] = array_combine($headerParse, $row); //faz a combinação do titulo com as informações de forma individual
            }
        }

        return $csvArray;
    }
}
