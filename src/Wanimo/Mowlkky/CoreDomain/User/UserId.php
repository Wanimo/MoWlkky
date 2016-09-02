<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

use Wanimo\Mowlkky\CoreDomain\AggregateId;

/**
 * User identification type.
 */
class UserId implements AggregateId
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * UserId constructor.
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
}