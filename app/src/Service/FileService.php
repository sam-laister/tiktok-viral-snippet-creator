<?php

namespace App\Service;

class FileService
{
    public function doesExist(string $path): bool
    {
        return file_exists($path);
    }
}
