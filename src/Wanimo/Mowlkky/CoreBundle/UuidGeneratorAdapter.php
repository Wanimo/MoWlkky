<?php

namespace Wanimo\Mowlkky\CoreBundle;

use Wanimo\Mowlkky\CoreDomain\UuidGenerator;
use Ramsey\Uuid\Uuid;

/**
 * Adaptor for an external uuid generation library.
 */
class UuidGeneratorAdapter implements UuidGenerator
{
    /**
     * @return string
     */
    public function generate(): string
    {
        return Uuid::uuid4();
    }
}