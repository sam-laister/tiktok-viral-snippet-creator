<?php

namespace App\Service;

/** @package App\Service */
class FileService
{
    /**
     * @param string $path 
     * @return bool 
     */
    public function doesExist(string $path): bool
    {
        return file_exists($path);
    }
}
