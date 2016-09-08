<?php

namespace Wanimo\Mowlkky\CoreBundle\Command;

use Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Wanimo\Mowlkky\CoreDomain\Command\Command;
use Wanimo\Mowlkky\CoreDomain\Command\CommandBus;

/**
 * Basis command bus to route a command to its dedicated handler.
 * @package Wanimo\Mowlkky\CoreBundle\Command
 */
class Bus implements CommandBus
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var array
     */
    private $commandsMapping;

    /**
     * Bus constructor.
     * @param ContainerInterface $container Required to lazy load handlers.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->commandsMapping = [];
    }

    /**
     * @param string $commandClass Command class name
     * @param string $handlerServiceId Service id corresponding to the mapped handler in the DI container.
     *
     * @return Bus
     */
    public function addCommandMapping(string $commandClass, string $handlerServiceId): Bus
    {
        $this->commandsMapping[$commandClass] = $handlerServiceId;

        return $this;
    }

    /**
     * @param Command $command
     * @return object
     * @throws Exception
     */
    protected function getHandler(Command $command)
    {
        $className = get_class($command);

        if (!array_key_exists($className, $this->commandsMapping)) {
            throw new Exception(sprintf('There is no handler defined in the bus for command %', $className));
        }

        $serviceId = $this->commandsMapping[$className];

        if (!$this->container->has($serviceId)) {
            throw new Exception(
                sprintf(
                    'Handler with service id %s defined in the command bus was not found for command %s',
                    $serviceId,
                    $className
                )
            );
        }

        return $this->container->get($serviceId);
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command)
    {
        $handler = $this->getHandler($command);

        $handler->handle($command);
    }
}
