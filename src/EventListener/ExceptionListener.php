<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\ConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $response = new JsonResponse();

        if ($exception instanceof ConstraintViolationException) {
            $violations = $exception->getConstraintViolations();
            $errors = [];

            foreach ($violations as $violation) {
                $errors[] = [
                    'code' => $violation->getCode(),
                    'source' => [
                        'pointer' => '/data/attributes/' . $violation->getPropertyPath(),
                    ],
                    'detail' => $violation->getMessage(),
                ];
            }

            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setContent(\json_encode([
                'errors' => $errors,
            ]));
        }

        $event->setResponse($response);
    }
}
