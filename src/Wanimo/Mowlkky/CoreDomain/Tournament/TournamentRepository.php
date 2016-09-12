<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament;

/**
 * Repository for Tournament entity.
 */
interface TournamentRepository
{
    /**
     * @param TournamentId $tournamentId
     * @return Tournament|null
     */
    public function find(TournamentId $tournamentId);

    /**
     * @param Tournament $tournament
     * @return TournamentRepository
     */
    public function add(Tournament $tournament): TournamentRepository;

    /**
     * @param Tournament $tournament
     * @return TournamentRepository
     */
    public function remove(Tournament $tournament): TournamentRepository;
}
