<?php

namespace Wanimo\Mowlkky\CoreDomain;

/**
 * Base class for all aggregates.
 */
abstract class AggregateRoot
{
    /**
     * @var DomainEvent[]
     */
    private $unpublishedEvents = array();

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
        $this->unpublishedEvents = array();

        return $this;
    }
}
