<?php

namespace Wanimo\Mowlkky\CoreDomain\Command;

/**
 * Interface for concrete command buses.
 * @package Wanimo\Mowlkky\CoreDomain\Command
 */
interface CommandBus
{
    /**
     * @param Command $command
     */
    public function handle(Command $command);
}