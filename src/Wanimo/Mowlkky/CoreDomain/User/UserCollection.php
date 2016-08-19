<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

/**
 * Collection for User entities
 */
class UserCollection extends \ArrayObject
{
    /**
     * @var User[]
     */
    private $users;

    /**
     * UserCollection constructor.
     * @param array $users
     */
    public function __construct(array $users = [])
    {
        foreach ($this->users as $user) {
            $this->addUser($user);
        }
    }

    /**
     * @param User $user
     * @return $this
     */
    public function addUser(User $user)
    {
        $this->users = $user;

        return $this;
    }
}
