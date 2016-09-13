<?php

namespace Wanimo\Mowlkky\CoreBundle\Persistence;

use Doctrine\ORM\EntityManager;
use Wanimo\Mowlkky\CoreDomain\UnitOfWork;

/**
 * Unit of Work for Doctrine
 */
class DoctrineUnitOfWork implements UnitOfWork
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * DoctrineUnitOfWork constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return UnitOfWork
     */
    public function flush(): UnitOfWork
    {
        // TODO : handle DomainEvents somewhere here.

        $this->entityManager->flush();

        return $this;
    }

    /**
     * @return UnitOfWork
     */
    public function beginTransaction(): UnitOfWork
    {
        $this->entityManager->getConnection()->beginTransaction();

        return $this;
    }

    /**
     * @return UnitOfWork
     */
    public function rollBack(): UnitOfWork
    {
        $this->entityManager->getConnection()->rollBack();

        return $this;
    }

    /**
     * @return UnitOfWork
     */
    public function commit(): UnitOfWork
    {
        $this->entityManager->getConnection()->commit();

        return $this;
    }
}