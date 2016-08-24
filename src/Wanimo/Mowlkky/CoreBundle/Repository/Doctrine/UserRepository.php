<?php

namespace Wanimo\Mowlkky\CoreBundle\Repository\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
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
     * @var ObjectRepository
     */
    private $source;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * UserRepository constructor.
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->objectManager = $om;
        $this->source = $om->getRepository(User::class);
    }

    /**
     * @param UserId $userId
     * @return User|null
     */
    public function find(UserId $userId)
    {
        return $this->source->find($userId);
    }

    /**
     * @return UserCollection
     */
    public function findAll(): UserCollection
    {
        return new UserCollection($this->source->findAll());
    }

    /**
     * @param Email $email
     * @return User
     */
    public function findOneByEmail(Email $email)
    {
        return $this->source->findOneBy(['email' => $email]);
    }

    /**
     * @param User $user
     * @return UserRepositoryInterface
     */
    public function add(User $user): UserRepositoryInterface
    {
        $this->objectManager->persist($user);

        return $this;
    }

    /**
     * @param User $user
     * @return UserRepositoryInterface
     */
    public function remove(User $user): UserRepositoryInterface
    {
        $this->objectManager->remove($user);

        return $this;
    }
}
