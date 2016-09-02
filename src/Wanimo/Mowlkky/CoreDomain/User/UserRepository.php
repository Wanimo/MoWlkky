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
    public function findAll(): UserCollection;

    /**
     * @param Email $email
     * @return User
     */
    public function findOneByEmail(Email $email);

    /**
     * @param User $user
     * @return UserRepository
     */
    public function add(User $user): UserRepository;

    /**
     * @param User $user
     * @return UserRepository
     */
    public function remove(User $user): UserRepository;
}