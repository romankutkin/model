<?php

declare(strict_types=1);

namespace App\Tests\Service\UserService;

use App\DataObject\UserRegisterRequest;
use App\Service\PasswordHasher;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserServiceTest extends KernelTestCase
{
    public function testCreateUser()
    {
        self::bootKernel();

        $container = static::getContainer();

        /** @var UserService $userService */
        $userService = $container->get(UserService::class);
        $passwordHasher = $container->get(PasswordHasher::class);

        $data = [
            'firstName' => 'Roman',
            'lastName' => 'Kut\'kin',
            'username' => 'romankutkin',
            'plainPassword' => 'secret',
        ];

        $userRegisterRequest = new UserRegisterRequest();

        $userRegisterRequest
            ->setFirstName($data['firstName'])
            ->setLastName($data['lastName'])
            ->setUsername($data['username'])
            ->setPlainPassword($data['plainPassword'])
        ;

        $user = $userService->create($userRegisterRequest);

        $this->assertEquals($user->getFirstName(), $data['firstName']);
        $this->assertEquals($user->getLastName(), $data['lastName']);
        $this->assertEquals($user->getUsername(), $data['username']);
        $this->assertEquals(true, $passwordHasher->verify($user->getPassword(), $data['plainPassword']));
    }
}
