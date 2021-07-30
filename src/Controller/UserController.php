<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * Registers a new user.
     */
    public function register(): JsonResponse
    {
        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }
}

