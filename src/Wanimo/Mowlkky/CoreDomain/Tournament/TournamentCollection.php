<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament;

use Wanimo\Mowlkky\CoreDomain\Collection\ArrayCollection;

/**
 * Collection for Tournament entities
 */
class TournamentCollection extends ArrayCollection
{
    /**
     * TournamentCollection constructor.
     * @param array $tournaments
     */
    public function __construct(array $tournaments = [])
    {
        foreach ($tournaments as $tournament) {
            $this->addTournament($tournament);
        }
    }

    /**
     * @param Tournament $tournament
     * @return $this
     */
    public function addTournament(Tournament $tournament)
    {
        $this->elements[] = $tournament;

        return $this;
    }

    /**
     * Check if a new element added to the collection is of the right type.
     *
     * @param mixed $element
     * @return bool
     */
    protected function checkNewElementType($element): bool
    {
        return $element instanceof Tournament;
    }
}
