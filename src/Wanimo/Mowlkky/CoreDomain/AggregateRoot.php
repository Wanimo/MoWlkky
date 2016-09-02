<?php

namespace Wanimo\Mowlkky\CoreDomain;

use Wanimo\Mowlkky\CoreDomain\Event\DomainEvent;
use Wanimo\Mowlkky\CoreDomain\Event\DomainEvents;

/**
 * Base class for all aggregates.
 */
abstract class AggregateRoot
{
    /**
     * @var DomainEvent[]
     */
    private $unpublishedEvents = [];

    /**
     * @param DomainEvent $event
     * @return $this
     */
    protected function recordEvent(DomainEvent $event)
    {
        $this->unpublishedEvents[] = $event;

        return $this;
    }

    /**
     * @return DomainEvents
     */
    public function getRecordedEvents()
    {
        return new DomainEvents($this->unpublishedEvents);
    }

    /**
     * @return $this
     */
    public function clearRecordedEvents()
    {
        $this->unpublishedEvents = [];

        return $this;
    }
}
