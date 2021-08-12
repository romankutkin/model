<?php

declare(strict_types=1);

namespace App\DataObject;

use App\Validator\Compound as Assert;

class UserRegisterRequest
{
    #[Assert\GivenNameRequirements]
    private string $firstName;

    #[Assert\GivenNameRequirements]
    private string $lastName;

    #[Assert\UsernameRequirements]
    private string $username;

    #[Assert\PlainPasswordRequirements]
    private string $plainPassword;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
}
