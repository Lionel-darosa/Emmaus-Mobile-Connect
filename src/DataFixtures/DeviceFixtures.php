<?php

namespace App\DataFixtures;

use App\Entity\Agency;
use App\Entity\Device;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DeviceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 30; $i++) {
            $device = new Device();
            $device->setBrand(array_rand(Device::PHONE));
            $device->setModel(Device::PHONE[$device->getBrand()][array_rand(Device::PHONE[$device->getBrand()])]);
            $device->setRam(Device::RAM[array_rand(Device::RAM)]);
            $device->setStorage(Device::STORAGE[array_rand(Device::STORAGE)]);
            $device->setState(Device::STATE[array_rand(Device::STATE)]);
            $device->setAgency($this->getReference('agency_' . Agency::AGENCIES[array_rand(Agency::AGENCIES)]['name']));

            $manager->persist($device);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AgencyFixtures::class
        ];
    }
}
