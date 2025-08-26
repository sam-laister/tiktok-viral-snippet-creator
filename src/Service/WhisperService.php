<?php

namespace App\Service;

use App\Entity\WhisperCommand;
use App\Entity\WhisperModel;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\ConsoleSectionOutput;
use Symfony\Component\Process\Exception\LogicException;
use Symfony\Component\Process\Exception\InvalidArgumentException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Exception\ProcessStartFailedException;
use Symfony\Component\Process\Exception\RuntimeException;

/** @package App\Service */
class WhisperService implements AudioInterface
{

    /**
     * @param WhisperCommand $cmd 
     * @param null|ConsoleSectionOutput $output 
     * @return void 
     * @throws LogicException 
     * @throws InvalidArgumentException 
     * @throws ProcessStartFailedException 
     * @throws RuntimeException 
     * @throws ProcessFailedException 
     */
    public function generateCaptions(
        WhisperCommand $cmd,
        ?ConsoleSectionOutput $output = null,

    ) {
        if ($output !== null) {
            $output->writeln('Running: ' . $cmd->getCommand());
        }

        $this->runProcess($cmd, $output);
    }

    /**
     * @param WhisperCommand $cmd 
     * @param null|ConsoleSectionOutput $output 
     * @param int $timeout 
     * @return void 
     * @throws LogicException 
     * @throws InvalidArgumentException 
     * @throws ProcessStartFailedException 
     * @throws RuntimeException 
     * @throws ProcessFailedException 
     */
    public function runProcess(
        WhisperCommand $cmd,
        ?ConsoleSectionOutput $output = null,
        int $timeout = 3600,
    ) {
        $process = Process::fromShellCommandline($cmd->getCommand());
        $process->setTimeout($timeout);
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
