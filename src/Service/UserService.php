<?php

declare(strict_types=1);

namespace App\Service;

use App\DataObject\UserRegisterRequest;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private PasswordHasher $passwordHasher
    ) {}

    public function register(UserRegisterRequest $request): void
    {
        $this->save($this->create($request));
    }

    public function create(UserRegisterRequest $request): User
    {
        $user = new User();

        $user
            ->setFirstName($request->getFirstName())
            ->setLastName($request->getLastName())
            ->setUsername($request->getUsername())
            ->setPasswordHash($this->passwordHasher->hash($request->getPlainPassword()))
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
