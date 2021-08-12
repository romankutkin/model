<?php

declare(strict_types=1);

namespace App\Validator\Compound;

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
        ];
    }
}
