<?php

declare(strict_types=1);

namespace App\ArgumentResolver;

use App\Contract\RequestInterface;
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

        if (in_array(RequestInterface::class, $reflectionClass->getInterfaceNames())) {
            return true;
        }

        return false;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        yield $this->requestHandler->handle($request, $argument->getType());
    }
}
