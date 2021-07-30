<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\Validator\Exception\RuntimeException;

class ValidationException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Validation failed.');
    }
}
