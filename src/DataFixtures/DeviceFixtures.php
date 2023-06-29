<?php

namespace App\DataFixtures;

use App\Entity\Device;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DeviceFixtures extends Fixture
{
    

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 30; $i++) {
        $device = new Device();

        $device->setBrand(Device::PHONE[mt_rand(0, 2)])
            ->setModel(Device::PHONE[rand(0, 2)][rand(0, 1)])
            ->setRam(Device::PHONE[mt_rand(0, 4)])
            ->setStorage(mt_rand(0, 32))
            ->setCondition(Device::CONDITION[mt_rand(0, 5)])
            ->setAgency($this->getReference('agency_' . mt_rand(1,4)));

        $manager->persist($device);
        }
        $manager->flush();
    }
}
