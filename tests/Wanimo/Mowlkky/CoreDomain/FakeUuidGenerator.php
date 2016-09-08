<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain;

use Wanimo\Mowlkky\CoreDomain\UuidGenerator;

/**
 * Fake Uuid generator for tests purpose.
 */
class FakeUuidGenerator implements UuidGenerator
{
    public function generate(): string
    {
        return uniqid();
    }
}