<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

use Wanimo\Mowlkky\CoreDomain\User\Password\RawPassword;

class RegisterUserCommand
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $role;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return new Email($this->email);
    }

    /**
     * @return RawPassword
     */
    public function getRawPassword(): RawPassword
    {
        return new RawPassword($this->password);
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return new Role($this->role);
    }

    /**
     * @return Identity
     */
    public function getIdentity(): Identity
    {
        return new Identity($this->firstName, $this->lastName);
    }

    /**
     * @param UserId $userId
     * @return RegisterUserCommand
     */
    public function withUserId(UserId $userId): RegisterUserCommand
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param string $email
     * @return RegisterUserCommand
     */
    public function withEmail(string $email): RegisterUserCommand
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $password
     * @return RegisterUserCommand
     */
    public function withRawPassword(string $password): RegisterUserCommand
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param string $role
     * @return RegisterUserCommand
     */
    public function withRole(string $role): RegisterUserCommand
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @param string $firstName
     * @return RegisterUserCommand
     */
    public function withFirstName(string $firstName): RegisterUserCommand
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @param string $lastName
     * @return RegisterUserCommand
     */
    public function withLastName(string $lastName): RegisterUserCommand
    {
        $this->lastName = $lastName;

        return $this;
    }
}
