<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

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