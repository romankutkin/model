<?php

declare(strict_types=1);

namespace App\Validator\Compound;

use App\Entity\User;
use App\Validator\Constraint as CustomAssert;
use Symfony\Component\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
class UsernameRequirements extends Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank([
                'normalizer' => 'trim',
            ]),
            new Assert\Length([
                'max' => 255,
            ]),
            new CustomAssert\UniqueEntityValue([
                'entity' => User::class,
                'field' => 'username',
            ]),
        ];
    }
}
