<?php

namespace App\Manager;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function register(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
