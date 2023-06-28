<?php

namespace App\Entity;

use App\Repository\DeviceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeviceRepository::class)]
class Device
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $brand = null;

    #[ORM\Column(length: 100)]
    private ?string $model = null;

    #[ORM\Column]
    private ?int $ram = null;

    #[ORM\Column]
    private ?int $storage = null;

    #[ORM\Column(length: 100)]
    private ?string $condition = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?bool $availability = null;

    #[ORM\ManyToOne(inversedBy: 'devices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $store = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getRam(): ?int
    {
        return $this->ram;
    }

    public function setRam(int $ram): static
    {
        $this->ram = $ram;

        return $this;
    }

    public function getStorage(): ?int
    {
        return $this->storage;
    }

    public function setStorage(int $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function getCondition(): ?string
    {
        return $this->condition;
    }

    public function setCondition(string $condition): static
    {
        $this->condition = $condition;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): static
    {
        $this->availability = $availability;

        return $this;
    }

    public function getStore(): ?User
    {
        return $this->store;
    }

    public function setStore(?User $store): static
    {
        $this->store = $store;

        return $this;
    }
}
