<?php

declare(strict_types=1);

namespace App\Model;

use App\DataObject\UserRegisterRequest;
use App\Entity\User;
use App\Service\PasswordHasher;
use Doctrine\ORM\EntityManagerInterface;

class UserModel
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
        return new User(
            firstName: $request->getFirstName(),
            lastName: $request->getLastName(),
            username: $request->getUsername(),
            passwordHash: $this->passwordHasher->hash($request->getPlainPassword())
        );
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
