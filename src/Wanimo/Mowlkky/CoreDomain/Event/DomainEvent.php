<?php

namespace Wanimo\Mowlkky\CoreDomain\Event;

use Wanimo\Mowlkky\CoreDomain\AggregateId;

interface DomainEvent
{
    /**
     * @return AggregateId
     */
    public function getAggregateId();
}
