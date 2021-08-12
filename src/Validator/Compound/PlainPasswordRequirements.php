<?php

declare(strict_types=1);

namespace App\Validator\Compound;

use Symfony\Component\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
class PlainPasswordRequirements extends Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\Length([
                'min' => 8,
                'max' => 255,
            ]),
        ];
    }
}
