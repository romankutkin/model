<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\PasswordHasher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function __construct(
        private PasswordHasher $passwordHasher
    ) {}

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
