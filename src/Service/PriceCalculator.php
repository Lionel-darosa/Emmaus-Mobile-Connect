<?php

namespace App\Service;

use App\Entity\Device;

class PriceCalculator
{
    public const RAM_INDICES = [
        2 => 10,
        3 => 15,
        4 => 20,
        6 => 30,
        8 => 30,
        12 => 30,
        16 => 30,
    ];

    public const STORAGE_INDICES = [
        16 => 10,
        32 => 30,
        64 => 50,
        128 => 50,
        256 => 50,
        512 => 50,
        1000 => 50,
    ];

    public const STATES = [
        'RÉPARABLE' => 0.5,
        'BLOQUÉ' => 0.9,
        'RECONDITIONNABLE' => 0.95,
        'RECONDITIONNÉ' => 1,
    ];

    public function calculate(Device $device)
    {
        $indiceRAM = self::RAM_INDICES[$device->getRam()];

        $indiceStorage = self::STORAGE_INDICES[$device->getStorage()];

        $totalPrice = $indiceRAM + $indiceStorage;

        $indiceState = self::STATES[$device->getState()];

        return $totalPrice * $indiceState;
    }
}
