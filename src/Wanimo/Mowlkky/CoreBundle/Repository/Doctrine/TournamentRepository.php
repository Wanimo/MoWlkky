<?php

namespace Wanimo\Mowlkky\CoreBundle\Repository\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use Wanimo\Mowlkky\CoreDomain\Tournament\Tournament;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentId;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentRepository as TournamentRepositoryInterface;

/**
 * Doctrine tournament repository.
 */
class TournamentRepository implements TournamentRepositoryInterface
{
    /**
     * @var ObjectRepository
     */
    private $source;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * TournamentRepository constructor.
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->objectManager = $om;
        $this->source = $om->getRepository(Tournament::class);
    }

    /**
     * @param TournamentId $tournamentId
     * @return Tournament|null
     */
    public function find(TournamentId $tournamentId)
    {
        return $this->source->find($tournamentId);
    }

    /**
     * @param Tournament $tournament
     * @return TournamentRepositoryInterface
     */
    public function add(Tournament $tournament): TournamentRepositoryInterface
    {
        $this->objectManager->persist($tournament);

        return $this;
    }

    /**
     * @param Tournament $tournament
     * @return TournamentRepositoryInterface
     */
    public function remove(Tournament $tournament): TournamentRepositoryInterface
    {
        $this->objectManager->remove($tournament);

        return $this;
    }
}
