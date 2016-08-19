<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

class RegisterUserCommand
{
    /**
     * @var UserRepository
     */
    private $userRepository;

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
    private $salt;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
     * @return Security
     */
    public function getSecurityKeys(): Security
    {
        return new Security($this->password, $this->salt);
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return new Role($this->role);
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
    public function withPassword(string $password): RegisterUserCommand
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param string $salt
     * @return RegisterUserCommand
     */
    public function withSalt(string $salt): RegisterUserCommand
    {
        $this->salt = $salt;

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
