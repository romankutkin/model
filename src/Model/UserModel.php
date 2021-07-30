<?php

declare(strict_types=1);

namespace App\Model;

use App\DataObject\UserRegisterCommand;
use App\Entity\User;
use App\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserModel
{
    public function __construct(
        private ValidatorInterface $validator
    ) {}

    public function register(UserRegisterCommand $userRegisterCommand): User
    {
        $violations = $this->validator->validate($userRegisterCommand);

        if (count($violations) > 0) {
            throw new ValidationException();
        }

        return new User();
    }
}
