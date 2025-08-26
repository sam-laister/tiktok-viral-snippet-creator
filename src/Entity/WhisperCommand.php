<?php

namespace App\Entity;

class WhisperCommand
{
    private string $path;
    private WhisperModel $model;

    function __construct(
        string $path,
        WhisperModel $model,
    ) {
        $this->path = $path;
        $this->model = $model;
    }

    public function getCommand(): string
    {
        return sprintf('whisper %s --model %s', $this->path, strtolower($this->model->name));
    }
}
