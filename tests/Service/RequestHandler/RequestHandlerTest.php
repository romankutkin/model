<?php

declare(strict_types=1);

namespace App\Tests\Service\RequestHandler;

use App\Service\RequestHandler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class RequestHandlerTest extends KernelTestCase
{
    public function testHandle()
    {
        self::bootKernel();

        $container = static::getContainer();

        /** @var RequestHandler $requestHandler */
        $requestHandler = $container->get(RequestHandler::class);

        $data = [
            'name' => 'Bar',
        ];

        $request = new Request(
            content: json_encode($data)
        );

        $result = $requestHandler->handle($request, FooDataTransferObject::class);

        $this->assertEquals(true, $result instanceof FooDataTransferObject);
        $this->assertEquals($data['name'], $result->getName());
    }
}
