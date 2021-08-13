<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueEntityValueValidator extends ConstraintValidator
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueEntityValue) {
            throw new UnexpectedTypeException($constraint, UniqueEntityValue::class);
        }

        $repository = $this->entityManager->getRepository($constraint->entity);

        $result = $repository->findBy([
            $constraint->field => $value,
        ]);

        if (!$result) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->setCode(UniqueEntityValue::NOT_UNIQUE_VALUE_ERROR)
            ->addViolation()
        ;
    }
}
