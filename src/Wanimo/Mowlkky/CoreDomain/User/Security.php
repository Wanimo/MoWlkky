<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

/**
 * Security keys for user access
 * @package Wanimo\Mowlkky\CoreDomain\User
 */
final class Security
{
    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    final public function __construct(string $password, string $salt)
    {
        $this->password = $password;
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }
}
