<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;

use InvalidArgumentException;
use Wanimo\Mowlkky\CoreDomain\User\Role;

/**
 * Test for the Role value object.
 */
class RoleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for the constructor to check format validation
     */
    public function testConstruct()
    {
        $referee = new Role(Role::ROLE_REFEREE);
        $this->assertEquals(Role::ROLE_REFEREE, $referee->getValue());

        $admin = new Role(Role::ROLE_ADMIN);
        $this->assertEquals(Role::ROLE_ADMIN, $admin->getValue());

        $this->assertEquals($referee, Role::createRefereeRole());
        $this->assertEquals($admin, Role::createAdministratorRole());

        $this->expectException(InvalidArgumentException::class);
        new Role('UnknownRole');
    }
}