<?php

namespace Wanimo\Mowlkky\CoreDomain;

/**
 * Interface for the concrete Uuid generators.
 * @package Wanimo\Mowlkky\CoreDomain
 */
interface UuidGenerator
{
    public function generate(): string;
}