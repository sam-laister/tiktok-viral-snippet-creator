<?php

namespace App\Service;

use App\Entity\WhisperCommand;
use App\Entity\WhisperModel;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\ConsoleSectionOutput;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class WhisperService implements AudioInterface
{

    public function generateCaptions(
        WhisperCommand $cmd,
        ?ConsoleSectionOutput $output = null,

    ) {
        if ($output !== null) {
            $output->writeln('Running: ' . $cmd->getCommand());
        }

        $this->runProcess($cmd, $output);
    }

    public function runProcess(
        WhisperCommand $cmd,
        ?ConsoleSectionOutput $output = null,
    ) {
        $process = Process::fromShellCommandline($cmd->getCommand());
        $process->start();

        if ($output !== null) {
            foreach ($process as $type => $data) {
                if ($process::OUT === $type) {
                    // echo "\nRead from stdout: " . $data;
                    $output->writeln($data);
                } else { // $process::ERR === $type
                    // echo "\nRead from stderr: " . $data;
                    $output->writeln($data);
                }
            }
        }

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
