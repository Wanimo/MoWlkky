<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

use Wanimo\Mowlkky\CoreDomain\AggregateRoot;

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
     * User constructor.
     * @param UserId $id
     * @param Email $email
     * @param $firstName
     * @param $lastName
     * @param Security $securityKeys
     * @param Role $role
     */
    final private function __construct(UserId $id, Email $email, $firstName, $lastName, Security $securityKeys, Role $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->securityKeys = $securityKeys;
        $this->role = $role;
    }

    /**
     * @return UserId
     */
    public function getId()
    {
        return $this->id;
    }
}
