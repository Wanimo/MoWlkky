<?php

namespace Wanimo\Mowlkky\CoreDomain;

interface UnitOfWork
{
    /**
     * @param mixed $object
     * @return UnitOfWork
     */
    public function flush($object = null): UnitOfWork;

    /**
     * @return UnitOfWork
     */
    public function beginTransaction(): UnitOfWork;

    /**
     * @return UnitOfWork
     */
    public function commit(): UnitOfWork;

    /**
     * @return UnitOfWork
     */
    public function rollBack(): UnitOfWork;
}
