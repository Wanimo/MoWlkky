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
     * @return EncodedPassword
     */
    public function encode(RawPassword $password): EncodedPassword;
}