<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

use Wanimo\Mowlkky\CoreDomain\User\Password\RawPassword;

class RegisterUserCommand
{
    /**
     * @var string
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
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
