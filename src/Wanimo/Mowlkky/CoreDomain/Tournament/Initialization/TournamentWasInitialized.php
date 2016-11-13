<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament\Initialization;

use Wanimo\Mowlkky\CoreDomain\AggregateId;
use Wanimo\Mowlkky\CoreDomain\Event\DomainEvent;
use Wanimo\Mowlkky\CoreDomain\Tournament\Tournament;

/**
 * Domain event recorded when a new tournament is initialized.
 */
final class TournamentWasInitialized implements DomainEvent
{
    /**
     * @var Tournament
     */
    private $tournament;

    /**
     * TournamentWasInitialized constructor.
     * @param Tournament $tournament
     */
    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    /**
     * @return AggregateId
     */
    public function getAggregateId()
    {
        return $this->tournament->getId();
    }
}
