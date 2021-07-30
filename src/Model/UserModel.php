<?php

declare(strict_types=1);

namespace App\Model;

use App\DataObject\UserRegisterCommand;
use App\Entity\User;

class UserModel
{
    public function register(UserRegisterCommand $command): User
    {
        return new User();
    }
}
