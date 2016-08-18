<?php

namespace Wanimo\Mowlkky\CoreBundle\Repository\InMemory;

use Wanimo\Mowlkky\CoreDomain\User\User;
use Wanimo\Mowlkky\CoreDomain\User\UserCollection;
use Wanimo\Mowlkky\CoreDomain\User\UserId;
use Wanimo\Mowlkky\CoreDomain\User\UserRepository as UserRepositoryInterface;

/**
 * In memory user repository.
 * Useful mostly for tests.
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var array
     */
    private $users;

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->users = array();
    }

    /**
     * @param UserId $userId
     * @return User|null
     */
    public function find(UserId $userId)
    {
        $user = null;

        if ($this->has($userId)) {
            $user = $this->users[$userId->getValue()];
        }

        return $user;
    }

    /**
     * @return UserCollection
     */
    public function findAll()
    {
        return new UserCollection($this->users);
    }

    /**
     * @param User $user
     * @return UserRepositoryInterface
     */
    public function add(User $user)
    {
        $this->users[$user->getId()->getValue()] = $user;

        return $this;
    }

    /**
     * @param User $user
     * @return UserRepositoryInterface
     */
    public function remove(User $user)
    {
        $userId = $user->getId();

        if ($this->has($userId)) {
            unset($this->users[$userId->getValue()]);
        }
    }

    /**
     * @param UserId $id
     * @return bool
     */
    protected function has(UserId $id)
    {
        return array_key_exists($id->getValue(), $this->users);
    }
}