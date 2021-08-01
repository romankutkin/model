<?php

declare(strict_types=1);

namespace App\Service;

use App\DataObject\UserRegisterRequest;
use App\Entity\User;
use App\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserService
{
    public function __construct(
        private ValidatorInterface $validator
    ) {}

    public function register(UserRegisterRequest $registerRequest): User
    {
        $violations = $this->validator->validate($registerRequest);

        if (count($violations) > 0) {
            throw new ValidationException();
        }

        return new User();
    }
}
