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
        'REPARABLE' => 0.5,
        'BLOQUE' => 0.9,
        'RECONDITIONABLE' => 0.95,
        'RECONDITIONNE' => 1,
    ];

    public function calculate(Device $device)
    {
        $indiceRAM = $device->getRam();

        $indiceStorage = $device->getStorage();

        $totalPrice = $indiceRAM + $indiceStorage;

        $indiceCondition = $device->getState();

        return $totalPrice * $indiceCondition;
    }
}