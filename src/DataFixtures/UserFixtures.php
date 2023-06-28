<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USER = [
        [
            'address' => '1 rue du Dôme', 'zipcode' => '75001', 'city' => 'Paris', 'phone' => '0600000001', 'email' => 'info1@emmaus.fr', 'password' => '1111', 'role' => User::ROLE_ADMIN,
        ],
        [
            'address' => '2 rue du Dôme', 'zipcode' => '75001', 'city' => 'Paris', 'phone' => '0600000002', 'email' => 'info2@emmaus.fr', 'password' => '2222', 'role' => User::ROLE_EMPLOYEE,
        ],
        [
            'address' => '3 rue du Dôme', 'zipcode' => '69003', 'city' => 'Lyon', 'phone' => '0600000003', 'email' => 'info3@emmaus.fr', 'password' => '3333', 'role' => User::ROLE_EMPLOYEE,
        ],
        [
            'address' => '4 rue du Dôme', 'zipcode' => '17002', 'city' => 'La Rochelle', 'phone' => '0600000004', 'email' => 'info4@emmaus.fr', 'password' => '4444', 'role' => User::ROLE_EMPLOYEE,
        ],
    ];

    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USER as $person) {
            if ($person['role'] == User::ROLE_EMPLOYEE) {
                $user = new User();

                $user->setAddress($person['address'])
                    ->setZipcode($person['zipcode'])
                    ->setCity($person['city'])
                    ->setPhoneNumber($person['phone'])
                    ->setEmail($person['email'])
                    ->setPassword($this->passwordHasher->hashPassword($user, 'password'));

                $manager->persist($user);
            }

            $manager->flush();
        }
    }
}
