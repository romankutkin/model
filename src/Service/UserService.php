<?php

declare(strict_types=1);

namespace App\Service;

use App\DataObject\UserRegisterRequest;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function create(UserRegisterRequest $request): User
    {
        $user = new User();

        $passwordHash = $this->passwordHasher->hashPassword($user, $request->getPlainPassword());

        $user
            ->setFirstName($request->getFirstName())
            ->setLastName($request->getLastName())
            ->setUsername($request->getUsername())
            ->setPassword($passwordHash)
        ;

        return $user;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function update(): void
    {
        $this->entityManager->flush();
    }
}
