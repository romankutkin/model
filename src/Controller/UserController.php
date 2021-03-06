<?php

declare(strict_types=1);

namespace App\Controller;

use App\Attribute\HandleRequest;
use App\DataObject\UserRegisterRequest;
use App\Service\UserModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function register(
        #[HandleRequest] UserRegisterRequest $request,
        UserModel $userModel
    ): JsonResponse {
        $userModel->register($request);

        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }
}

