<?php

namespace App\Entity;

use App\Repository\WeatherReportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherReportRepository::class)]
class WeatherReport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $temperature = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $station = null;

    #[ORM\Column(length: 255)]
    private ?string $temperatureRange = null;

    #[ORM\Column]
    private ?int $temperatureFelt = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $wind = null;

    #[ORM\Column]
    private ?int $humidity = null;

    #[ORM\Column(length: 255)]
    private ?string $uvIndex = null;

    #[ORM\Column(length: 255)]
    private ?string $avalancheRisk = null;

    #[ORM\Column(length: 255)]
    private ?string $snowQuality = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): self
    {
        $this->temperature = $temperature;

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

    public function getTemperatureRange(): ?string
    {
        return $this->temperatureRange;
    }

    public function setTemperatureRange(string $temperatureRange): self
    {
        $this->temperatureRange = $temperatureRange;

        return $this;
    }

    public function getTemperatureFelt(): ?int
    {
        return $this->temperatureFelt;
    }

    public function setTemperatureFelt(int $temperatureFelt): self
    {
        $this->temperatureFelt = $temperatureFelt;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getWind(): ?int
    {
        return $this->wind;
    }

    public function setWind(int $wind): self
    {
        $this->wind = $wind;

        return $this;
    }

    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    public function setHumidity(int $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getUvIndex(): ?string
    {
        return $this->uvIndex;
    }

    public function setUvIndex(string $uvIndex): self
    {
        $this->uvIndex = $uvIndex;

        return $this;
    }

    public function getAvalancheRisk(): ?string
    {
        return $this->avalancheRisk;
    }

    public function setAvalancheRisk(string $avalancheRisk): self
    {
        $this->avalancheRisk = $avalancheRisk;

        return $this;
    }

    public function getSnowQuality(): ?string
    {
        return $this->snowQuality;
    }

    public function setSnowQuality(string $snowQuality): self
    {
        $this->snowQuality = $snowQuality;

        return $this;
    }
}
