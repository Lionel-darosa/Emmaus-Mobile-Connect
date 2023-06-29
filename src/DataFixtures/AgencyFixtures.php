<?php

namespace App\DataFixtures;

use App\Entity\Agency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AgencyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        foreach (Agency::AGENCIES as $agency) {

            $agency = new Agency();

            $agency->setName($agency['name'])
            ->setAddress($agency['address'])
            ->setCity($agency['address'])
            ->setZipcode($agency['zipcode']);

            $manager->persist($agency);

            $this->addReference('agency_' . $agency->getName(), $agency);
        }
        
        $manager->flush();
    }
}
