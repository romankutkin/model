<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UserFixtures extends Fixture
{
    private PasswordHasherInterface $passwordHasher;

    public function __construct(PasswordHasherFactoryInterface $hasherFactory)
    {
        $this->passwordHasher = $hasherFactory->getPasswordHasher(User::class);
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user
            ->setFirstName('Roman')
            ->setLastName('Kut\'kin')
            ->setUsername('romankutkin')
            ->setPasswordHash($this->passwordHasher->hash('secret'))
        ;

        $manager->persist($user);

        $manager->flush();
    }
}
