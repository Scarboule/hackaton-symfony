<?php

namespace App\Entity;

use App\Repository\SlopeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SlopeRepository::class)]
class Slope
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'slopes')]
    private ?User $station = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $difficulty = null;

    #[ORM\Column(nullable: true)]
    private ?bool $manual_open = null;

    #[ORM\Column(nullable: true)]
    private ?bool $manual_close = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $schedule = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $message = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStation(): ?User
    {
        return $this->station;
    }

    public function setStation(?User $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function isManualOpen(): ?bool
    {
        return $this->manual_open;
    }

    public function setManualOpen(?bool $manual_open): self
    {
        $this->manual_open = $manual_open;

        return $this;
    }

    public function isManualClose(): ?bool
    {
        return $this->manual_close;
    }

    public function setManualClose(?bool $manual_close): self
    {
        $this->manual_close = $manual_close;

        return $this;
    }
}
