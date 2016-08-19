<?php

namespace Wanimo\Mowlkky\CoreDomain\Event;
use Traversable;

/**
 * DomainEvent collection.
 */
class DomainEvents implements \Countable
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
     * @param $index
     * @return DomainEvent
     */
    public function get(int $index): DomainEvent
    {
        return $this->events[$index];
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->events);
    }
}