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

    public function __construct($password, $salt)
    {
        $this->password = $password;
        $this->salt = $salt;
    }
}