<?php

namespace App\Entity;

use App\Repository\DeviceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeviceRepository::class)]
class Device
{
    public const PHONE = [
        'Iphone' => ['Iphone8', 'Iphone9'],
        'Samsung' => ['S8', 'S9'],
        'Alcatel' => ['A9', 'A10'],
    ] ;

    public const STATE = [
        'DEE', 'REPARABLE', 'BLOQUE', 'RECONDITIONABLE', 'RECONDITIONNE'
    ];

    public const RAM = [
        2, 4, 8, 12, 16
    ];

    public const STORAGE = [
        16, 32, 64, 128, 256, 512,
    ];

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
    private ?string $state = null;

    #[ORM\ManyToOne(inversedBy: 'devices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agency $agency = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $soldAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getRam(): ?int
    {
        return $this->ram;
    }

    public function setRam(int $ram): void
    {
        $this->ram = $ram;
    }

    public function getStorage(): ?int
    {
        return $this->storage;
    }

    public function setStorage(int $storage): void
    {
        $this->storage = $storage;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price = null): void
    {
        $this->price = $price;
    }

    public function getImage(): ?string
    {
        return 'uploads/phonePics' . $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getSoldAt(): ?\DateTimeImmutable
    {
        return $this->soldAt;
    }

    public function setSoldAt(?\DateTimeImmutable $soldAt): void
    {
        $this->soldAt = $soldAt;
    }

    public function getAgency(): ?Agency
    {
        return $this->agency;
    }

    public function setAgency(?Agency $agency): void
    {
        $this->agency = $agency;
    }

}
