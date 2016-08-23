<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

use DateTime;
use Wanimo\Mowlkky\CoreDomain\AggregateRoot;
use Wanimo\Mowlkky\CoreDomain\User\Event\UserWasRegistered;

class User extends AggregateRoot
{
    /**
     * @var UserId
     *
     */
    protected $id;

    /**
     * @var Email
     */
    protected $email;

    /**
     * @var Identity
     */
    protected $identity;

    /**
     * @var Security
     */
    protected $securityKeys;

    /**
     * @var Role
     */
    protected $role;

    /**
     * @var DateTime
     */
    protected $registrationDate;

    /**
     * @var DateTime
     */
    protected $lastUpdateDate;

    /**
     * @var DateTime
     */
    protected $lastConnectionDate;

    /**
     * User constructor.
     */
    final private function __construct()
    {
        $this->registrationDate = new DateTime();
        $this->lastUpdateDate = new DateTime();
    }

    /**
     * @return UserId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Identity
     */
    public function getIdentity(): Identity
    {
        return $this->identity;
    }

    /**
     * @return Security
     */
    public function getSecurityKeys(): Security
    {
        return $this->securityKeys;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return DateTime
     */
    public function getRegistrationDate(): DateTime
    {
        return $this->registrationDate;
    }

    /**
     * @return DateTime
     */
    public function getLastUpdateDate(): DateTime
    {
        return $this->lastUpdateDate;
    }

    /**
     * @return DateTime
     */
    public function getLastConnectionDate(): DateTime
    {
        return $this->lastConnectionDate;
    }

    /**
     * @param RegisterUserCommand $command
     * @return User
     */
    public static function registerUser(RegisterUserCommand $command)
    {
        $user = new self;

        $user->id = $command->getUserId();
        $user->email = $command->getEmail();
        $user->identity = $command->getIdentity();
        $user->securityKeys = $command->getSecurityKeys();
        $user->role = $command->getRole();

        $user->recordEvent(new UserWasRegistered($user));

        return $user;
    }
}
