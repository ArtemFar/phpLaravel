<?php

namespace App\Services;

use App\Services\Contracts\Upload;
use Illuminate\Http\UploadedFile;

class UploadService implements Upload
{
    public function create(UploadedFile $file): string
    {
        $path = $file->storeAs('news', $file->hashName(), 'public');
        if ($path === false) {
            throw new \Exception("File was not upload");
        }

        return $path;
    }
}