<?php

namespace Wanimo\Mowlkky\CoreBundle\Repository\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
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
     * @var EntityRepository
     */
    private $source;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * UserRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
        $this->source = $em->getRepository(User::class);
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
        return $this->source->findOneBy(['email.value' => $email->getValue()]);
    }

    /**
     * @param User $user
     * @return UserRepositoryInterface
     */
    public function add(User $user): UserRepositoryInterface
    {
        $this->entityManager->persist($user);

        return $this;
    }

    /**
     * @param User $user
     * @return UserRepositoryInterface
     */
    public function remove(User $user): UserRepositoryInterface
    {
        $this->entityManager->remove($user);

        return $this;
    }
}
