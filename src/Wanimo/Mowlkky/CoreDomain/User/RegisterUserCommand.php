<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

use Symfony\Component\Validator\Constraints as Assert;

use Wanimo\Mowlkky\CoreDomain\Command\Command;
use Wanimo\Mowlkky\CoreDomain\Validation\ConstraintsCollection;
use Wanimo\Mowlkky\CoreDomain\Validation\Validatable;

/**
 * Command used to register a new user.
 */
class RegisterUserCommand implements Command, Validatable
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
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

    /**
     * Command constraints for the command validation service.
     *
     * @return ConstraintsCollection
     */
    public static function getValidationConstraints(): ConstraintsCollection
    {
        $constraints = (new ConstraintsCollection())
            ->addAssertions(
                'email', [
                    new Assert\Email(),
                    new Assert\NotBlank()
                ]
            )
            ->addAssertions(
                'password', [
                    new Assert\Length([
                        'min' => 6
                    ])
                ]
            )
            ->addAssertions(
                'firstName', [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => Identity::VALIDATION_PATTERN
                    ])
                ]
            )
            ->addAssertions(
                'lastName', [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => Identity::VALIDATION_PATTERN
                    ])
                ]
            )
            ->addAssertions(
                'role', [
                    new Assert\Choice([
                        'choices' => [Role::ROLE_ADMIN, Role::ROLE_REFEREE]
                    ])
                ]
            );

        return $constraints;
    }
}
