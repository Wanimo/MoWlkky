<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

/**
 * User Role
 * @package Wanimo\Mowlkky\CoreDomain\User
 */
final class Role
{
    /**
     * @var string
     */
    private $value;

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