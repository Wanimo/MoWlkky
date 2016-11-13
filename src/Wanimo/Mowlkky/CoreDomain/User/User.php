<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

use DateTime;
use Wanimo\Mowlkky\CoreDomain\AggregateRoot;
use Wanimo\Mowlkky\CoreDomain\User\Registration\UserWasRegistered;
use Wanimo\Mowlkky\CoreDomain\User\Password\EncodedPassword;

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
     * @var EncodedPassword
     */
    protected $password;

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
     * @return EncodedPassword
     */
    public function getPassword(): EncodedPassword
    {
        return $this->password;
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
     * @return User
     */
    public function login(): User
    {
        $this->lastConnectionDate = new DateTime();

        return $this;
    }

    /**
     * Register a new user
     *
     * @param UserId $id
     * @param Email $email
     * @param Identity $identity
     * @param EncodedPassword $password
     * @param Role $role
     *
     * @return User
     */
    public static function registerUser(UserId $id, Email $email, Identity $identity, EncodedPassword $password, Role $role)
    {
        $user = new self;

        $user->id = $id;
        $user->email = $email;
        $user->identity = $identity;
        $user->password = $password;
        $user->role = $role;

        $user->recordEvent(new UserWasRegistered($user));

        return $user;
    }
}
