<?php

namespace Wanimo\Mowlkky\CoreDomain\User\Password;

/**
 * Interface for concrete password encoders.
 * @package Wanimo\Mowlkky\CoreDomain\User\Password
 */
interface PasswordEncoder
{
    /**
     * @param RawPassword $password
     * @param string $salt
     * @return EncodedPassword
     */
    public function encode(RawPassword $password, string $salt): EncodedPassword;
}