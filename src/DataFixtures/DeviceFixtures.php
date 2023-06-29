<?php

namespace App\DataFixtures;

use App\Entity\Agency;
use App\Entity\Device;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Service\PriceCalculator;
use Faker\Factory;

class DeviceFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private PriceCalculator $priceCalculator) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 30; $i++) {
            $device = new Device();
            $device->setBrand(array_rand(Device::PHONE));
            $device->setModel(Device::PHONE[$device->getBrand()][array_rand(Device::PHONE[$device->getBrand()])]);
            $device->setRam(Device::RAM[array_rand(Device::RAM)]);
            $device->setStorage((array_keys(Device::STORAGE))[mt_rand(0, count(Device::STORAGE) - 1)][0]);               
            $device->setState(Device::STATE[array_rand(Device::STATE)]);
            $device->setAgency($this->getReference('agency_' . Agency::AGENCIES[array_rand(Agency::AGENCIES)]['name']));
            $device->setScreenSize($faker->randomFloat(1, 4, 10));

            if ($device->getBrand() == 'apple') {
                $device->setImage(Device::IMG_IPHONE);
            } elseif ($device->getBrand() == 'samsung') {
                $device->setImage(Device::IMG_SAMSUNG);
            } else {
                $device->setImage(Device::IMG_ALCATEL);
            }

            $device->setPrice($this->priceCalculator->calculate($device));

            
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
