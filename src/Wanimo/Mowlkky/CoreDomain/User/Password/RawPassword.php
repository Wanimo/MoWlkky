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
     * @return EncodedPassword
     */
    public function encode(PasswordEncoder $encoder)
    {
        return $encoder->encode($this);
    }
}
