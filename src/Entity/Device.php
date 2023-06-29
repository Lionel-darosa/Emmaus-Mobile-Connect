<?php

namespace App\Entity;

use App\Entity\Agency;
use App\Repository\DeviceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DeviceRepository::class)]
class Device
{

    public const PHONE = [
        'Apple' => [
            'iPhone 8' => 'iPhone_8',
            'iPhone 9' => 'iPhone_9'
        ],
        'Samsung' => [
            'Galaxy S9' => 'Samsung_9',
            'Galaxy S10' => 'Samsung_10'
        ],
        'Alcatel' => [
            'F 530' => 'F 530',
            '4039' => '4039'
        ]
    ] ;

    public const STATE = [
        'RÉPARABLE', 'BLOQUÉ', 'RECONDITIONNABLE', 'RECONDITIONNÉ',
    ];

    public const RAM = [
        '2GB' => 2,
        '4GB' => 4,
        '8GB' => 8,
        '12GB' => 12,
        '16GB' => 16
    ];

    public const STORAGE = [
        '32GB' => 32,
        '64GB' => 64,
        '128GB' => 128,
        '256GB' => 256,
        '512GB' => 512,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable:true)]
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
    private ?\DateTime $soldAt = null;

    #[ORM\Column]
    private ?float $screenSize = null;

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
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getSoldAt(): ?\DateTime
    {
        return $this->soldAt;
    }

    public function setSoldAt(?\DateTime $soldAt): void
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

    public function getScreenSize(): ?float
    {
        return $this->screenSize;
    }

    public function setScreenSize(float $screenSize): static
    {
        $this->screenSize = $screenSize;

        return $this;
    }

}
