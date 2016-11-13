<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament\Initialization;

use Wanimo\Mowlkky\CoreDomain\Tournament\Name;
use Wanimo\Mowlkky\CoreDomain\Tournament\Tournament;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentId;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentRepository;
use Wanimo\Mowlkky\CoreDomain\User\User;
use Wanimo\Mowlkky\CoreDomain\User\UserId;
use Wanimo\Mowlkky\CoreDomain\User\UserRepository;
use Wanimo\Mowlkky\CoreDomain\UuidGenerator;

final class InitializeNewTournamentHandler
{
    /**
     * @var TournamentRepository
     */
    private $tournamentRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UuidGenerator
     */
    private $uuidGenerator;

    public function __construct(
        TournamentRepository $tournamentRepository, UserRepository $userRepository, UuidGenerator $uuidGenerator
    )
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->userRepository = $userRepository;
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @param InitializeNewTournamentCommand $command
     * @return Tournament
     */
    public function handle(InitializeNewTournamentCommand $command)
    {
        $creator = $this->userRepository->find(new UserId($command->getCreatorId()));

        if (!$creator instanceof User) {
            throw new \InvalidArgumentException(sprintf('There is no user with ID %s', $command->getCreatorId()));
        }

        $tournament = Tournament::initializeNewTournament(
            new TournamentId($this->uuidGenerator->generate()),
            $creator,
            new Name($command->getName()),
            $command->getStartingDate()
        );

        $this->tournamentRepository->add($tournament);

        return $tournament;
    }
}
