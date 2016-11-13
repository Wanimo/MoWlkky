<?php

namespace Wanimo\Mowlkky\CoreDomain\User\Registration;

use Wanimo\Mowlkky\CoreDomain\AggregateId;
use Wanimo\Mowlkky\CoreDomain\Event\DomainEvent;
use Wanimo\Mowlkky\CoreDomain\User\User;

/**
 * Domain event recorded when a new user is registered.
 */
final class UserWasRegistered implements DomainEvent
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserWasRegistered constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return AggregateId
     */
    public function getAggregateId()
    {
        return $this->user->getId();
    }
}
