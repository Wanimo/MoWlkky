<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament;

use DateTime;
use Wanimo\Mowlkky\CoreDomain\AggregateRoot;
use Wanimo\Mowlkky\CoreDomain\Game\GameCollection;
use Wanimo\Mowlkky\CoreDomain\Player\PlayerCollection;
use Wanimo\Mowlkky\CoreDomain\Tournament\Initialization\TournamentWasInitialized;
use Wanimo\Mowlkky\CoreDomain\User\User;

/**
 * Tournament entity
 */
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
     * @return TournamentId
     */
    public function getId(): TournamentId
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return User
     */
    public function getCreator(): User
    {
        return $this->creator;
    }

    /**
     * @return DateTime
     */
    public function getStartingDate(): DateTime
    {
        return $this->startingDate;
    }

    /**
     * @return DateTime
     */
    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    /**
     * @return DateTime
     */
    public function getLastUpdateDate(): DateTime
    {
        return $this->lastUpdateDate;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return PlayerCollection
     */
    public function getPlayers(): PlayerCollection
    {
        return $this->players;
    }

    /**
     * @return GameCollection
     */
    public function getGames(): GameCollection
    {
        return $this->games;
    }

    /**
     * @param TournamentId $id
     * @param User $creator
     * @param Name $name
     * @param DateTime $startingDate
     * @return Tournament
     */
    public static function initializeNewTournament(TournamentId $id, User $creator, Name $name, DateTime $startingDate): Tournament
    {
        $tournament = new self;

        $tournament->id = $id;
        $tournament->creator = $creator;
        $tournament->name = $name;
        $tournament->startingDate = $startingDate;

        $tournament->recordEvent(new TournamentWasInitialized($tournament));

        return $tournament;
    }


}