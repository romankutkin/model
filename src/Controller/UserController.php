<?php

declare(strict_types=1);

namespace App\Controller;

use App\DataObject\UserRegisterRequest;
use App\Model\UserModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    /**
     * Registers a new user.
     */
    public function register(
        Request $request,
        UserModel $userModel,
        SerializerInterface $serializer
    ): JsonResponse {
        $registerRequest = $serializer->deserialize(
            $request->getContent(),
            UserRegisterRequest::class,
            'json'
        );

        $userModel->register($registerRequest);

        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }
}

