<?php

namespace Wanimo\Mowlkky\CoreDomain;

/**
 * DomainEvent collection.
 */
class DomainEvents
{
    /**
     * @var DomainEvent[]
     */
    private $events;

    /**
     * DomainEvents constructor.
     * @param DomainEvent[] $events
     */
    public function __construct(array $events)
    {
        foreach ($events as $event) {
            $this->addEvent($event);
        }
    }

    /**
     * @param DomainEvent $event
     * @return $this
     */
    public function addEvent(DomainEvent $event)
    {
        $this->events[] = $event;

        return $this;
    }
}