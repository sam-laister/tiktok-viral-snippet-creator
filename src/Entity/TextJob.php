<?php

namespace App\Entity;

use App\Repository\TextJobRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TextJobRepository::class)]
class TextJob
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitlePath = null;

    #[ORM\Column(length: 255)]
    private ?TextJobStatus $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubtitlePath(): ?string
    {
        return $this->subtitlePath;
    }

    public function setSubtitlePath(?string $subtitlePath): static
    {
        $this->subtitlePath = $subtitlePath;

        return $this;
    }

    public function getStatus(): ?TextJobStatus
    {
        return $this->status;
    }

    public function setStatus(TextJobStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
