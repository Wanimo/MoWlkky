<?php

namespace Wanimo\Mowlkky\CoreBundle\Persistence\Types;
use Wanimo\Mowlkky\CoreDomain\User\UserId;

/**
 * Doctrine type for UserId
 */
class DoctrineUserId extends DoctrineEntityId
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return UserId::class;
    }
}