<?php

namespace App\Http\Services\File;

use App\Http\Repositories\FileRepository;
use Illuminate\Support\Facades\Storage;

class CreateFileService
{
    private $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function handle($folderPath, $file, $name)
    {
        $pathBucket = Storage::disk('s3')->put($folderPath, $file); //upload da foto na aws
        $fullPathFile = Storage::disk('s3')->url($pathBucket); //url completa

        return $this->fileRepository->create([
            'name' => 'foto_' . $name, //nome da foto com concatenação do nome da foto mais o nome digitado
            'size' => $file->getSize(),
            'mime' => $file->extension(),
            'url' => $fullPathFile
        ]);

    }
}
