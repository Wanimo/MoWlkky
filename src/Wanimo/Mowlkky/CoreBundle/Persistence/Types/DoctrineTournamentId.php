<?php

namespace Wanimo\Mowlkky\CoreBundle\Persistence\Types;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentId;

/**
 * Doctrine type for TournamentId
 */
class DoctrineTournamentId extends DoctrineEntityId
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return TournamentId::class;
    }
}