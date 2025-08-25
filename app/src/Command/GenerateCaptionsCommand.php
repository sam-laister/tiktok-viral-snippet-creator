<?php

namespace App\Command;

use App\Entity\WhisperCommand;
use App\Entity\WhisperModel;
use App\Service\FileService;
use App\Service\WhisperService;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:generate:audio',
    description: 'Takes a file path and generates captions'
)]
class GenerateCaptionsCommand
{
    public function __construct(
        private FileService $fileService,
        private WhisperService $whisperService,
    ) {}

    public function __invoke(
        #[Argument('Audio filepath')] string $path,
        OutputInterface $output,
    ): int {

        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException('This command accepts only an instance of "ConsoleOutputInterface".');
        }

        $infoSection = $output->section();
        $progressSection = $output->section();

        $infoSection->writeln('Using file: ' . $path);

        // Validation
        if ($this->fileService->doesExist($path)) {
            $infoSection->writeln('File exists');
        } else {
            $infoSection->writeln('File doesn\'t exist!');
            return Command::FAILURE;
        }

        $model = WhisperModel::Turbo;
        $cmd = new WhisperCommand($path, $model);

        try {
            $this->whisperService->generateCaptions($cmd, $progressSection);
        } catch (\Exception $e) {
            $output->writeln("Something went wrong: " . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}
