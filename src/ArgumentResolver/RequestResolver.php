<?php

declare(strict_types=1);

namespace App\ArgumentResolver;

use App\DataObject\Interface\DataTransferObject;
use App\Service\RequestHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class RequestResolver implements ArgumentValueResolverInterface
{
    public function __construct(
        private RequestHandler $requestHandler
    ) {}

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $reflectionClass = new \ReflectionClass($argument->getType());

        return in_array(DataTransferObject::class, $reflectionClass->getInterfaceNames());
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        yield $this->requestHandler->handle($request, $argument->getType());
    }
}
