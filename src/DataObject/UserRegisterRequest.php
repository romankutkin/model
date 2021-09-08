<?php

declare(strict_types=1);

namespace App\DataObject;

use App\Contract\RequestInterface;
use App\Validator\Compound as Assert;

class UserRegisterRequest implements RequestInterface
{
    #[Assert\GivenNameRequirements]
    private string $firstName;

    #[Assert\GivenNameRequirements]
    private string $lastName;

    #[Assert\UsernameRequirements]
    private string $username;

    #[Assert\PlainPasswordRequirements]
    private string $plainPassword;

    public function __construct(
        string $firstName,
        string $lastName,
        string $username,
        string $plainPassword
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->plainPassword = $plainPassword;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }
}
