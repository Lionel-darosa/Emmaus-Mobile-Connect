<?php

namespace App\DataFixtures;

use App\Entity\Agency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AgencyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (Agency::AGENCIES as $singleAgency) {

            $agency = new Agency();

            $agency->setName($singleAgency['name'])
            ->setAddress($singleAgency['address'])
            ->setCity($singleAgency['address'])
            ->setZipcode($singleAgency['zipcode']);

            $manager->persist($agency);

            $this->addReference('agency_' . $agency->getName(), $agency);
        }
        
        $manager->flush();
    }
}
