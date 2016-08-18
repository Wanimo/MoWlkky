<?php

namespace Wanimo\Mowlkky\CoreDomain;

interface DomainEvent
{
    /**
     * @return AggregateId
     */
    public function getAggregateId();
}
