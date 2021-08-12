<?php

declare(strict_types=1);

namespace App\Validator\Exception;

use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Reports the result of constraint violations.
 */
class ConstraintViolationException extends ValidationException
{
    public function __construct(
        private ConstraintViolationList $constraintViolationList
    ) {
        parent::__construct();
    }

    public function getConstraintViolations(): ConstraintViolationList
    {
        return $this->constraintViolationList;
    }
}
