<?php

namespace Wanimo\Mowlkky\BackBundle\Event;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Wanimo\Mowlkky\CoreDomain\UnitOfWork;
use Wanimo\Mowlkky\CoreDomain\User\User;
use Wanimo\Mowlkky\CoreDomain\User\UserRepository;

/**
 * Authentication listener to catch authentication successes and fill the last login date of the connected user.
 * @package Wanimo\Mowlkky\BackBundle\Event
 */
class AuthenticationListener
{
    /** @var  UnitOfWork */
    private $uow;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * AuthenticationListener constructor.
     * @param UnitOfWork $uow
     * @param UserRepository $userRepository
     */
    public function __construct(UnitOfWork $uow, UserRepository $userRepository)
    {
        $this->uow = $uow;
        $this->userRepository = $userRepository;
    }

    /**
     * On authentication success
     * @param InteractiveLoginEvent $event
     */
    public function onAuthenticationSuccess(InteractiveLoginEvent $event)
    {
        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser()->getModel();

        $user->login();
        $this->uow->flush($user);
    }
}