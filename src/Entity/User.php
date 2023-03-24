<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo_url = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $presentation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $station_name = null;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: Slope::class)]
    private Collection $slopes;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: Lift::class)]
    private Collection $lifts;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: WeatherReport::class)]
    private Collection $weatherReports;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: Shop::class)]
    private Collection $shops;

    public function __construct()
    {
        $this->slopes = new ArrayCollection();
        $this->lifts = new ArrayCollection();
        $this->shops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logo_url;
    }

    public function setLogoUrl(?string $logo_url): self
    {
        $this->logo_url = $logo_url;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getStationName(): ?string
    {
        return $this->station_name;
    }

    public function setStationName(?string $station_name): self
    {
        $this->station_name = $station_name;

        return $this;
    }

    /**
     * @return Collection<int, Slope>
     */
    public function getSlopes(): Collection
    {
        return $this->slopes;
    }

    public function addSlope(Slope $slope): self
    {
        if (!$this->slopes->contains($slope)) {
            $this->slopes->add($slope);
            $slope->setStation($this);
        }

        return $this;
    }

    public function removeSlope(Slope $slope): self
    {
        if ($this->slopes->removeElement($slope)) {
            // set the owning side to null (unless already changed)
            if ($slope->getStation() === $this) {
                $slope->setStation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lift>
     */
    public function getLifts(): Collection
    {
        return $this->lifts;
    }

    public function addLift(Lift $lift): self
    {
        if (!$this->lifts->contains($lift)) {
            $this->lifts->add($lift);
            $lift->setStation($this);
        }

        return $this;
    }

    public function removeLift(Lift $lift): self
    {
        if ($this->lifts->removeElement($lift)) {
            // set the owning side to null (unless already changed)
            if ($lift->getStation() === $this) {
                $lift->setStation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WeatherReport>
     */
    public function getWeatherReports(): Collection
    {
        return $this->weatherReports;
    }

    public function addWeatherReport(WeatherReport $weatherReport): self
    {
        if (!$this->weatherReports->contains($weatherReport)) {
            $this->weatherReports->add($weatherReport);
            $weatherReport->setStation($this);
        }

        return $this;
    }

    public function removeWeatherReport(WeatherReport $weatherReport): self
    {
        if ($this->weatherReports->removeElement($weatherReport)) {
            // set the owning side to null (unless already changed)
            if ($weatherReport->getStation() === $this) {
                $weatherReport->setStation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Shop>
     */
    public function getShops(): Collection
    {
        return $this->shops;
    }

    public function addShop(Shop $shop): self
    {
        if (!$this->shops->contains($shop)) {
            $this->shops->add($shop);
            $shop->setStation($this);
        }

        return $this;
    }

    public function removeShop(Shop $shop): self
    {
        if ($this->shops->removeElement($shop)) {
            // set the owning side to null (unless already changed)
            if ($shop->getStation() === $this) {
                $shop->setStation(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        if ($this->getStationName() === null) {
            return '';
        }
        return $this->getStationName();
    }
}
