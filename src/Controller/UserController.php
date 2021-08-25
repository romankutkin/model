<?php

declare(strict_types=1);

namespace App\Controller;

use App\DataObject\UserRegisterRequest;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function register(UserRegisterRequest $request, UserService $userService): JsonResponse
    {
        $userService->register($request);

        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }
}

