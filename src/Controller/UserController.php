<?php

declare(strict_types=1);

namespace App\Controller;

use App\DataObject\UserRegisterCommand;
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
        SerializerInterface $serializer
    ): JsonResponse {
        $registerCommand = $serializer->deserialize(
            $request->getContent(),
            UserRegisterCommand::class,
            'json'
        );

        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }
}

