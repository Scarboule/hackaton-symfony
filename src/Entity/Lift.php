<?php

namespace App\Entity;

use App\Repository\LiftRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiftRepository::class)]
class Lift
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lifts')]
    private ?LiftType $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $manual_open = null;

    #[ORM\Column(nullable: true)]
    private ?bool $manual_close = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $schedule = [];

    #[ORM\ManyToOne(inversedBy: 'lifts')]
    private ?User $station = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?LiftType
    {
        return $this->type;
    }

    public function setType(?LiftType $type): self
    {
        $this->type = $type;

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

    public function getSchedule(): array
    {
        return $this->schedule;
    }

    public function setSchedule(?array $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
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

    public function setManual_open(?bool $manual_open): self
    {
        $this->manual_open = $manual_open;

        return $this;
    }
    public function setManual_close(?bool $manual_close): self
    {
        $this->manual_close = $manual_close;

        return $this;
    }
}
