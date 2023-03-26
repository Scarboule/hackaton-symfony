<?php

namespace App\Entity;

use App\Repository\FavoriteStationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriteStationRepository::class)]
class FavoriteStation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'favoriteStations')]
    private ?User $user = null;

    #[ORM\ManyToOne]
    private ?User $station = null;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

}
