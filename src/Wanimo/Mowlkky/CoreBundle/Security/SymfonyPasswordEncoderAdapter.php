<?php

namespace Wanimo\Mowlkky\CoreBundle\Security;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface as SymfonyPasswordEncoder;
use Wanimo\Mowlkky\CoreDomain\User\Password\EncodedPassword;
use Wanimo\Mowlkky\CoreDomain\User\Password\PasswordEncoder;
use Wanimo\Mowlkky\CoreDomain\User\Password\RawPassword;

/**
 * Class PasswordEncoderAdapter
 * @package Wanimo\Mowlkky\CoreBundle\Security
 */
class SymfonyPasswordEncoderAdapter implements PasswordEncoder
{
    /**
     * @var SymfonyPasswordEncoder
     */
    private $encoder;

    public function __construct(SymfonyPasswordEncoder $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param RawPassword $password
     * @param string $salt
     * @return EncodedPassword
     */
    public function encode(RawPassword $password, string $salt): EncodedPassword
    {
        return new EncodedPassword($this->encoder->encodePassword($password->getValue(), $salt), $salt);
    }
}