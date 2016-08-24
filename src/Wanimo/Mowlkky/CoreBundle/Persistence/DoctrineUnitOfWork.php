<?php

namespace Wanimo\Mowlkky\CoreBundle\Persistence;

use Doctrine\Common\Persistence\ObjectManager;
use Wanimo\Mowlkky\CoreDomain\UnitOfWork;

/**
 * Unit of Work for Doctrine
 */
class DoctrineUnitOfWork implements UnitOfWork
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * DoctrineUnitOfWork constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @return UnitOfWork
     */
    public function commit(): UnitOfWork
    {
        // TODO : handle DomainEvents somewhere here.

        $this->objectManager->flush();

        return $this;
    }
}