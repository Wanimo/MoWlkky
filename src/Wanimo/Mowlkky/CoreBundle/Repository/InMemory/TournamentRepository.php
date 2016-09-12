<?php

namespace Wanimo\Mowlkky\CoreBundle\Repository\InMemory;

use Wanimo\Mowlkky\CoreDomain\Tournament\Tournament;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentCollection;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentId;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentRepository as TournamentRepositoryInterface;

/**
 * In memory tournament repository.
 * Useful mostly for tests.
 */
class TournamentRepository implements TournamentRepositoryInterface
{
    /**
     * @var Tournament[]
     */
    private $tournaments;

    /**
     * TournamentRepository constructor.
     */
    public function __construct()
    {
        $this->tournaments = [];
    }

    /**
     * @param TournamentId $tournamentId
     * @return Tournament|null
     */
    public function find(TournamentId $tournamentId)
    {
        $tournament = null;

        if ($this->has($tournamentId)) {
            $user = $this->tournaments[$tournamentId->getValue()];
        }

        return $tournament;
    }

    /**
     * @param Tournament $tournament
     * @return TournamentRepositoryInterface
     */
    public function add(Tournament $tournament): TournamentRepositoryInterface
    {
        $this->tournaments[$tournament->getId()->getValue()] = $tournament;

        return $this;
    }

    /**
     * @param Tournament $tournament
     * @return TournamentRepositoryInterface
     */
    public function remove(Tournament $tournament): TournamentRepositoryInterface
    {
        $tournamentId = $tournament->getId();

        if ($this->has($tournamentId)) {
            unset($this->tournaments[$tournamentId->getValue()]);
        }

        return $this;
    }

    /**
     * @param TournamentId $id
     * @return bool
     */
    protected function has(TournamentId $id)
    {
        return array_key_exists($id->getValue(), $this->tournaments);
    }
}