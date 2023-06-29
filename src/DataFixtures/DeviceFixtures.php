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
            $device->setStorage((array_keys(Device::STORAGE))[mt_rand(0, count(Device::STORAGE) - 1)][0]);               
            $device->setState(Device::STATE[array_rand(Device::STATE)]);
            $device->setAgency($this->getReference('agency_' . Agency::AGENCIES[array_rand(Agency::AGENCIES)]['name']));

            if (Device::PHONE[$device->getBrand()] == 'iphone') {
                $device->setImage(Device::IMG_IPHONE);
            }

            if (Device::PHONE[$device->getBrand()] == 'samsung') {
                $device->setImage(Device::IMG_SAMSUNG);
            }

            if (Device::PHONE[$device->getBrand()] == 'alcatel') {
                $device->setImage(Device::IMG_ALCATEL);
            }
            
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
