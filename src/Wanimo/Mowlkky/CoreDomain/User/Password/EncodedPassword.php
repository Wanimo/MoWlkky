<?php

namespace Wanimo\Mowlkky\CoreDomain\User\Password;

/**
 * Encoded password for user access
 * @package Wanimo\Mowlkky\CoreDomain\User
 */
final class EncodedPassword
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $salt;

    /**
     * EncodedPassword constructor.
     * @param string $value
     * @param string $salt
     */
    final public function __construct(string $value, string $salt)
    {
        $this->value = $value;
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }
}
