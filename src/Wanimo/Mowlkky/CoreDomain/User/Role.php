<?php

namespace Wanimo\Mowlkky\CoreDomain\User;
use Psr\Log\InvalidArgumentException;

/**
 * User Role
 * @package Wanimo\Mowlkky\CoreDomain\User
 */
final class Role
{
    const ROLE_ADMIN = 'admin';
    const ROLE_REFEREE = 'referee';

    /**
     * @var string
     */
    private $value;

    /**
     * Role constructor.
     * @param $role
     */
    final public function __construct(string $role)
    {
        $role = strtolower($role);

        if (!in_array($role, [self::ROLE_ADMIN, self::ROLE_REFEREE])) {
            throw new InvalidArgumentException(sprintf('Invalid role name %s', $role));
        }

        $this->value = $role;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Role
     */
    public static function createAdministratorRole(): Role
    {
        return new self(self::ROLE_ADMIN);
    }

    /**
     * @return Role
     */
    public static function createRefereeRole(): Role
    {
        return new self(self::ROLE_REFEREE);
    }
}