<?php

namespace Wanimo\Mowlkky\CoreBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Wanimo\Mowlkky\CoreDomain\User\User;

class UserAuthentication implements UserInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * AuthenticatedUser constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getModel()
    {
        return $this->user;
    }

    /**
     * Returns the roles granted to the user.

     * @return string[] The user roles
     */
    public function getRoles()
    {
        return [
            (string) $this->user->getRole()
        ];
    }

    /**
     * @return string The password
     */
    public function getPassword()
    {
        return (string) $this->user->getPassword()->getValue();
    }

    /**
     * @return string|null The salt
     */
    public function getSalt()
    {
        return (string) $this->user->getPassword()->getSalt();
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return (string) $this->user->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }
}