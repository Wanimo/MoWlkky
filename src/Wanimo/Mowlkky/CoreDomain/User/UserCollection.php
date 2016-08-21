<?php

namespace Wanimo\Mowlkky\CoreDomain\User;
use Wanimo\Mowlkky\CoreDomain\Collection\ArrayCollection;

/**
 * Collection for User entities
 */
class UserCollection extends ArrayCollection
{
    /**
     * UserCollection constructor.
     * @param array $users
     */
    public function __construct(array $users = [])
    {
        foreach ($this->elements as $user) {
            $this->addUser($user);
        }
    }

    /**
     * @param User $user
     * @return $this
     */
    public function addUser(User $user)
    {
        $this->elements = $user;

        return $this;
    }

    /**
     * Check if a new element added to the collection is of the right type.
     *
     * @param mixed $element
     * @return bool
     */
    protected function checkNewElementType($element): bool
    {
        return $element instanceof User;
    }
}
