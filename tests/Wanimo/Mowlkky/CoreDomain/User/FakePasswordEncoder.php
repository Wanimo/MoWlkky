<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;

use Faker;
use Wanimo\Mowlkky\CoreDomain\User\Password\EncodedPassword;
use Wanimo\Mowlkky\CoreDomain\User\Password\PasswordEncoder;
use Wanimo\Mowlkky\CoreDomain\User\Password\RawPassword;

/**
 * Fake password encoder used for tests purpose only.
 * @package Tests\Wanimo\Mowlkky\CoreDomain\User
 */
class FakePasswordEncoder implements PasswordEncoder
{
    /**
     * @var string
     */
    private $encodedPasswordValue;

    /**
     * FakePasswordEncoder constructor.
     * @param string|null $encodedPasswordValue
     */
    public function __construct(string $encodedPasswordValue = null)
    {
        if (is_null($encodedPasswordValue)) {
            $encodedPasswordValue = Faker\Factory::create()->sha1;
        }

        $this->encodedPasswordValue = $encodedPasswordValue;
    }

    /**
     * @param RawPassword $password
     * @return EncodedPassword
     */
    public function encode(RawPassword $password): EncodedPassword
    {
        return new EncodedPassword($this->encodedPasswordValue);
    }
}