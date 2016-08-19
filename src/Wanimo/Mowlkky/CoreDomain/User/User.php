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
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

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
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
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
        $user->firstName = $command->getFirstName();
        $user->lastName = $command->getLastName();
        $user->securityKeys = $command->getSecurityKeys();
        $user->role = $command->getRole();

        $user->recordEvent(new UserWasRegistered($user));

        return $user;
    }
}
