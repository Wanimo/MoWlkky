<?php

namespace Wanimo\Mowlkky\CoreDomain;

interface UnitOfWork
{
    /**
     * @return UnitOfWork
     */
    public function flush(): UnitOfWork;

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
