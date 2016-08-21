<?php

namespace Wanimo\Mowlkky\CoreDomain\Event;

use Wanimo\Mowlkky\CoreDomain\Collection\ArrayCollection;

/**
 * DomainEvent collection.
 */
class DomainEvents extends ArrayCollection
{
    /**
     * DomainEvents constructor.
     * @param DomainEvent[] $events
     */
    public function __construct(array $events)
    {
        $this->elements = array();

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
        $this->elements[] = $event;

        return $this;
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