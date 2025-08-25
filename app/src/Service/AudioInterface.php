<?php

namespace App\Service;

use App\Entity\WhisperCommand;
use Symfony\Component\Console\Output\ConsoleSectionOutput;

interface AudioInterface
{
    public function generateCaptions(WhisperCommand $cmd, ?ConsoleSectionOutput $output = null);
    public function runProcess(WhisperCommand $cmd, ?ConsoleSectionOutput $output = null);
}
