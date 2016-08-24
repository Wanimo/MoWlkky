<?php

namespace Wanimo\Mowlkky\CoreBundle\Repository\Doctrine;

use Wanimo\Mowlkky\CoreDomain\User\Email;
use Wanimo\Mowlkky\CoreDomain\User\User;
use Wanimo\Mowlkky\CoreDomain\User\UserCollection;
use Wanimo\Mowlkky\CoreDomain\User\UserId;
use Wanimo\Mowlkky\CoreDomain\User\UserRepository as UserRepositoryInterface;

/**
 * Doctrine user repository.
 */
class UserRepository implements UserRepositoryInterface
{

    /**
     * @param UserId $userId
     * @return User|null
     */
    public function find(UserId $userId)
    {
        // TODO: Implement find() method.
    }

    /**
     * @return UserCollection
     */
    public function findAll(): UserCollection
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param Email $email
     * @return User
     */
    public function findOneByEmail(Email $email)
    {
        // TODO: Implement findOneByEmail() method.
    }

    /**
     * @param User $user
     * @return UserRepositoryInterface
     */
    public function add(User $user): UserRepositoryInterface
    {
        // TODO: Implement add() method.
    }

    /**
     * @param User $user
     * @return UserRepositoryInterface
     */
    public function remove(User $user): UserRepositoryInterface
    {
        // TODO: Implement remove() method.
    }
}