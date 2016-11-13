<?php

namespace Wanimo\Mowlkky\CoreBundle\Repository\Doctrine;

use ArrayIterator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Wanimo\Mowlkky\CoreBundle\Specification\Processor\Processor as SpecificationProcessor;
use Wanimo\Mowlkky\CoreDomain\Specification;
use Wanimo\Mowlkky\CoreDomain\Tournament\Tournament;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentCollection;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentId;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentRepository as TournamentRepositoryInterface;

/**
 * Doctrine tournament repository.
 */
class TournamentRepository implements TournamentRepositoryInterface
{
    /**
     * @var EntityRepository
     */
    private $source;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var SpecificationProcessor
     */
    private $specificationProcessor;

    /**
     * TournamentRepository constructor.
     * @param EntityManager $em
     * @param SpecificationProcessor $specificationProcessor
     */
    public function __construct(EntityManager $em, SpecificationProcessor $specificationProcessor)
    {
        $this->entityManager = $em;
        $this->source = $em->getRepository(Tournament::class);
        $this->specificationProcessor = $specificationProcessor;
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
        $this->entityManager->persist($tournament);

        return $this;
    }

    /**
     * @param Tournament $tournament
     * @return TournamentRepositoryInterface
     */
    public function remove(Tournament $tournament): TournamentRepositoryInterface
    {
        $this->entityManager->remove($tournament);

        return $this;
    }

    /**
     * @param Specification $specification
     * @return TournamentCollection
     */
    public function match(Specification $specification): TournamentCollection
    {
        $qb = $this->source->createQueryBuilder('t');

        /** @var ArrayIterator $result */
        $result = $this->specificationProcessor->applyOnTarget($qb, $specification);

        return new TournamentCollection($result->getArrayCopy());
    }
}
