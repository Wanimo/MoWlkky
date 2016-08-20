<?php

namespace Wanimo\Mowlkky\CoreDomain\Event;

use Wanimo\Mowlkky\CoreDomain\Collection\ArrayCollection;

/**
 * DomainEvent collection.
 */
class DomainEvents extends ArrayCollection
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
        $this->events = array();

        foreach ($events as $event) {
            $this->addEvent($event);
        }
    }

    /**
     * @param DomainEvent $event
     * @return DomainEvents
     */
    public function addEvent(DomainEvent $event): DomainEvents
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Get the concrete collection elements.
     *
     * @return array
     */
    protected function & getElements(): array
    {
        return $this->events;
    }

    /**
     * Check if a new element added to the collection is of the right type.
     *
     * @param mixed $element
     * @return bool
     */
    protected function checkNewElementType($element): bool
    {
        return $element instanceof DomainEvent;
    }
}