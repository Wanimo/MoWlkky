<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament\Initialization;

use DateTime;
use Wanimo\Mowlkky\CoreDomain\Command\Command;
use Wanimo\Mowlkky\CoreDomain\Validation\ConstraintsCollection;
use Wanimo\Mowlkky\CoreDomain\Validation\Validatable;

/**
 * Command used to create and initialize a new tournament.
 */
class InitializeNewTournamentCommand implements Command, Validatable
{
    /**
     * @var string
     */
    private $creatorId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var DateTime
     */
    private $startingDate;

    /**
     * @return string
     */
    public function getCreatorId(): string
    {
        return $this->creatorId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTime
     */
    public function getStartingDate(): DateTime
    {
        return $this->startingDate;
    }

    /**
     * @param string $creator
     * @return InitializeNewTournamentCommand
     */
    public function withCreator(string $creator): InitializeNewTournamentCommand
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @param string $name
     * @return InitializeNewTournamentCommand
     */
    public function withName(string $name): InitializeNewTournamentCommand
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param DateTime $startingDate
     * @return InitializeNewTournamentCommand
     */
    public function withStartingDate(DateTime $startingDate): InitializeNewTournamentCommand
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    /**
     * @return ConstraintsCollection
     */
    public static function getValidationConstraints(): ConstraintsCollection
    {

    }
}
