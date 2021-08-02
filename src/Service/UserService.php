<?php

declare(strict_types=1);

namespace App\Service;

use App\DataObject\UserRegisterRequest;
use App\Entity\User;
use App\Exception\ValidationException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserService
{
    public function __construct(
        private ValidatorInterface $validator,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function create(UserRegisterRequest $registerRequest): User
    {
        $violations = $this->validator->validate($registerRequest);

        if (count($violations) > 0) {
            throw new ValidationException();
        }

        $user = new User();

        $passwordHash = $this->passwordHasher->hashPassword($user, $registerRequest->getPlainPassword());

        $user
            ->setFirstName($registerRequest->getFirstName())
            ->setLastName($registerRequest->getLastName())
            ->setUsername($registerRequest->getUsername())
            ->setPassword($passwordHash)
        ;

        return $user;
    }
}
