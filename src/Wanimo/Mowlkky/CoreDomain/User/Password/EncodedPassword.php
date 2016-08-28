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
}
