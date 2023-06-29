<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 30; $i++) { 
                $user = new User();

                $user->setEmail($faker->email())
                    ->setPassword($this->passwordHasher->hashPassword($user, 'password'))
                    ->setFirstname($faker->firstName())
                    ->setLastname($faker->lastName())
                    ->setAgency($this->getReference('agency_' . mt_rand(1,4)));
                    if ($i <= 29) {
                        $user->setRoles(User::ROLE_EMPLOYEE);
                    } else {
                        $user->setRoles(User::ROLE_ADMIN);
                    }
                    

                $manager->persist($user);
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
