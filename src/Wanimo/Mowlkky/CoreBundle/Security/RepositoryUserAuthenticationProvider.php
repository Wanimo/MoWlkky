<?php

namespace Wanimo\Mowlkky\CoreBundle\Security;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Wanimo\Mowlkky\CoreDomain\User\Email;
use Wanimo\Mowlkky\CoreDomain\User\User;
use Wanimo\Mowlkky\CoreDomain\User\UserRepository;

/**
 * Provider for users from a repository.
 */
class RepositoryUserAuthenticationProvider implements UserProviderInterface
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * RepositoryUserProvider constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        $user = $this->repository->findOneByEmail(new Email($username));

        if (!$user instanceof User) {
            throw new UsernameNotFoundException();
        }

        return new UserAuthentication($user);
    }

    /**
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof UserAuthentication) {
            throw new UnsupportedUserException();
        }

        $user = $this->repository->findOneByEmail(new Email($user->getUsername()));

        return new UserAuthentication($user);
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return UserAuthentication::class;
    }
}
