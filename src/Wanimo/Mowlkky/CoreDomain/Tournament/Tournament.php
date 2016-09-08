<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament;

use DateTime;
use Wanimo\Mowlkky\CoreDomain\AggregateRoot;
use Wanimo\Mowlkky\CoreDomain\Player\GameCollection;
use Wanimo\Mowlkky\CoreDomain\Player\PlayerCollection;
use Wanimo\Mowlkky\CoreDomain\User\User;

class Tournament extends AggregateRoot
{
    /**
     * @var TournamentId
     */
    protected $id;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var User
     */
    protected $creator;

    /**
     * @var DateTime
     */
    protected $startingDate;

    /**
     * @var DateTime
     */
    protected $creationDate;

    /**
     * @var DateTime
     */
    protected $lastUpdateDate;

    /**
     * @var Status
     */
    protected $status;

    /**
     * @var PlayerCollection
     */
    protected $players;

    /**
     * @var GameCollection
     */
    protected $games;

    /**
     * Tournament constructor.
     */
    final private function __construct()
    {
        $this->creationDate = new DateTime();
        $this->lastUpdateDate = new DateTime();
        $this->status = new Status(Status::STATUS_CREATING);
        $this->games = new GameCollection();
        $this->players = new PlayerCollection();
    }

    /**
     * @param InitializeNewTournamentCommand $command
     * @return Tournament
     */
    public static function initializeNewTournament(InitializeNewTournamentCommand $command): Tournament
    {
        $tournament = new self;

        return $tournament;
    }
}