<?php

namespace Wanimo\Mowlkky\CoreDomain;

interface UnitOfWork
{
    /**
     * @return UnitOfWork
     */
    public function commit(): UnitOfWork;
}
