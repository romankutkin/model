<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class PasswordHasher
{
    private PasswordHasherInterface $passwordHasher;

    public function __construct(PasswordHasherFactoryInterface $factory)
    {
        $this->passwordHasher = $factory->getPasswordHasher(User::class);
    }

    public function hash(string $plainPassword): string
    {
        return $this->passwordHasher->hash($plainPassword);
    }
}
