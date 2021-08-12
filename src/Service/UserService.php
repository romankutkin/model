<?php

declare(strict_types=1);

namespace App\Service;

use App\DataObject\UserRegisterRequest;
use App\Entity\User;
use App\Validator\Exception\ConstraintViolationException;
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

        if ($violations->count() > 0) {
            throw new ConstraintViolationException($violations);
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
