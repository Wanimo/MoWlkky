<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

/**
 * Repository for User entity.
 */
interface UserRepository
{
    /**
     * @param UserId $userId
     * @return User|null
     */
    public function find(UserId $userId);

    /**
     * @return UserCollection
     */
    public function findAll();

    /**
     * @param User $user
     * @return $this
     */
    public function add(User $user);

    /**
     * @param User $user
     * @return $this
     */
    public function remove(User $user);
}