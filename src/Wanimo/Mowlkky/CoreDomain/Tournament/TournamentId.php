<?php

namespace Wanimo\Mowlkky\CoreDomain\Tournament;

use Wanimo\Mowlkky\CoreDomain\AggregateId;

/**
 * Tournament identification type.
 */
class TournamentId implements AggregateId
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * TournamentId constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
