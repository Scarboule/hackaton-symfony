<?php

namespace App\Entity;

use App\Repository\LostAndFoundObjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LostAndFoundObjectRepository::class)]
class LostAndFoundObject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $found_date = null;

    #[ORM\ManyToOne(inversedBy: 'lostAndFoundObjects')]
    private ?Slope $slope = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFoundDate(): ?\DateTimeInterface
    {
        return $this->found_date;
    }

    public function setFoundDate(\DateTimeInterface $found_date): self
    {
        $this->found_date = $found_date;

        return $this;
    }

    public function getSlope(): ?Slope
    {
        return $this->slope;
    }

    public function setSlope(?Slope $slope): self
    {
        $this->slope = $slope;

        return $this;
    }
}
