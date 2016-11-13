<?php

namespace Tests\Wanimo\Mowlkky\CoreBundle\Repository\InMemory;

use Tests\Wanimo\Mowlkky\CoreBundle\FakeServiceContainer;
use Wanimo\Mowlkky\CoreBundle\Command\Bus;
use Wanimo\Mowlkky\CoreDomain\User\Registration\RegisterUserCommand;

/**
 * Test class for the default command bus
 */
class BusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for the addCommandMapping method.
     */
    public function testAddCommandMapping()
    {
        // Create mocks & stubs
        $serviceId = 'my_fake_register_user_handler_id';

        $command = new RegisterUserCommand();

        $fakeHandler = $this
            ->getMockBuilder(\stdClass::class)
            ->setMethods(['handle'])
            ->getMock();

        $fakeHandler
            ->expects($this->once())
            ->method('handle')
            ->with($this->equalTo($command));

        $container = new FakeServiceContainer();
        $container->set($serviceId, $fakeHandler);

        // Then finally test the bus in a normal case
        $bus = new Bus($container);
        $bus->addCommandMapping(RegisterUserCommand::class, $serviceId);

        $bus->handle($command);

        // With a failure because of an unknown command
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('There is no handler defined in the bus for command %', \stdClass::class));

        $bus = new Bus($container);
        $bus->addCommandMapping(\stdClass::class, $serviceId);

        $bus->handle($command);

        // And a failure because of an unknown service in the container
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(
            sprintf(
                'Handler with service id %s defined in the command bus was not found for command %s',
                $wrongServiceId = uniqid(),
                RegisterUserCommand::class
            )
        );

        $bus = new Bus($container);
        $bus->addCommandMapping(RegisterUserCommand::class, $wrongServiceId);
    }
}
