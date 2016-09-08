<?php

namespace Wanimo\Mowlkky\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class CommandBusPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('mowlkky.command.bus')) {
            return;
        }

        $busDefinition = $container->findDefinition('mowlkky.command.bus');

        // Find all service IDs with the mowlkky.command_handler tag
        $taggedServices = $container->findTaggedServiceIds('mowlkky.command_handler');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $busDefinition->addMethodCall('addCommandMapping', array($attributes['command'], $id));
            }
        }
    }
}