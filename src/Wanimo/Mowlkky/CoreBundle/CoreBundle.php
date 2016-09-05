<?php

namespace Wanimo\Mowlkky\CoreBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Wanimo\Mowlkky\CoreBundle\DependencyInjection\Compiler\CommandBusPass;

class CoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new CommandBusPass());
    }
}
