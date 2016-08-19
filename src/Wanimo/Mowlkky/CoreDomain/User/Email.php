<?php

namespace Wanimo\Mowlkky\CoreDomain\User;
use InvalidArgumentException;

/**
 * Email value object
 */
final class Email
{
    /**
     * @var string
     */
    private $value;

    /**
     * Email constructor.
     * @param $value
     */
    public function __construct($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('"%s" is not a valid email', $value));
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}