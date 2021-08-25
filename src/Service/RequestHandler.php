<?php

declare(strict_types=1);

namespace App\Service;

use App\Validator\Exception\ConstraintViolationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestHandler
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) {}

    public function handle(Request $request, string $targetClass): object
    {
        $object = $this->serializer->deserialize($request->getContent(), $targetClass, 'json');

        $violations = $this->validator->validate($object);

        if ($violations->count() > 0) {
            throw new ConstraintViolationException($violations);
        }

        return $object;
    }
}
