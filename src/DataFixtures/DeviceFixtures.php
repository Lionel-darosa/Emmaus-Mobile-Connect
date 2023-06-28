<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DeviceFixtures extends Fixture
{
    public const USER = [
        [
            'brand' => 'Apple', 'model' => 'iPhone1', 'RAM' => '2', 'storage' => '0600000001', 'email' => 'info1@emmaus.fr', 'password' => '1111', 'role' => User::ROLE_ADMIN,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
