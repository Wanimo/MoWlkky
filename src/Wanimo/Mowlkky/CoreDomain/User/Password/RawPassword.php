<?php

namespace Wanimo\Mowlkky\CoreDomain\User\Password;

/**
 * Raw password for user access
 * @package Wanimo\Mowlkky\CoreDomain\User
 */
final class RawPassword
{
    /**
     * @var string
     */
    private $value;

    final public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param PasswordEncoder $encoder
     * @param string $salt
     * @return EncodedPassword
     */
    public function encode(PasswordEncoder $encoder, $salt)
    {
        return $encoder->encode($this, $salt);
    }
}
