<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament;

use DateTime;
use Wanimo\Mowlkky\CoreDomain\AggregateRoot;
use Wanimo\Mowlkky\CoreDomain\Game\GameCollection;
use Wanimo\Mowlkky\CoreDomain\Player\PlayerCollection;
use Wanimo\Mowlkky\CoreDomain\Tournament\Event\TournamentInitialized;
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
    protected $startDate;

    /**
     * @var DateTime
     */
    protected $creationDate;

    /**
     * @var DateTime
     */
    protected $lastUpdateDate;

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
    public function getStartDate(): DateTime
    {
        return $this->startDate;
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
     * @param TournamentId $id
     * @param User $creator
     * @param DateTime $startDate
     * @param Name $name
     * @return Tournament
     */
    public static function initializeNewTournament(
        TournamentId $id, User $creator, DateTime $startDate, Name $name = null
    ): Tournament
    {
        $tournament = new self;

        $tournament->id = $id;
        $tournament->creator = $creator;
        $tournament->startDate = $startDate;
        $tournament->name = $name;

        $tournament->recordEvent(new TournamentInitialized($tournament));

        return $tournament;
    }
}