<?php

declare(strict_types=1);

namespace App\Tests\Model;

use App\DataObject\UserRegisterRequest;
use App\Service\PasswordHasher;
use App\Service\UserModel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserModelTest extends KernelTestCase
{
    public function testCreateUser()
    {
        self::bootKernel();

        $container = static::getContainer();

        /** @var UserModel $userModel */
        $userModel = $container->get(UserModel::class);
        $passwordHasher = $container->get(PasswordHasher::class);

        $data = [
            'firstName' => 'Roman',
            'lastName' => 'Kut\'kin',
            'username' => 'romankutkin',
            'plainPassword' => 'secret',
        ];

        $user = $userModel->create(new UserRegisterRequest(
            firstName: $data['firstName'],
            lastName: $data['lastName'],
            username: $data['username'],
            plainPassword: $data['plainPassword']
        ));

        $this->assertEquals($user->getFirstName(), $data['firstName']);
        $this->assertEquals($user->getLastName(), $data['lastName']);
        $this->assertEquals($user->getUsername(), $data['username']);
        $this->assertEquals(true, $passwordHasher->verify($user->getPassword(), $data['plainPassword']));
    }
}
