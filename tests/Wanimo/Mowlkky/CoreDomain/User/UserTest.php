<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;

use Wanimo\Mowlkky\CoreDomain\User\Email;
use Wanimo\Mowlkky\CoreDomain\User\Event\UserWasRegistered;
use Wanimo\Mowlkky\CoreDomain\User\Role;
use Wanimo\Mowlkky\CoreDomain\User\Security;
use Wanimo\Mowlkky\CoreDomain\User\User;
use Wanimo\Mowlkky\CoreDomain\User\UserId;
use Faker;

/**
 * Test class for the User entity.
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for the registerUser method.
     */
    public function testRegisterUser()
    {
        $faker = Faker\Factory::create();
        $testData = [
            'email' => $faker->email,
            'firstName' => $faker->firstName,
            'lastName' => $faker->lastName,
            'password' => $faker->password,
            'salt' => $faker->randomAscii,
            'role' => $faker->randomDigitNotNull % 2 == 0 ? Role::ROLE_ADMIN : Role::ROLE_REFEREE,
            'id' => $faker->uuid
        ];

        $user = User::registerUser(RegisterUserCommandTest::createStandardTestInstance($testData));

        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals($testData['firstName'], $user->getIdentity()->getFirstName());
        $this->assertEquals($testData['lastName'], $user->getIdentity()->getLastName());

        $this->assertInstanceOf(Email::class, $user->getEmail());
        $this->assertEquals($testData['email'], $user->getEmail()->getValue());

        $this->assertInstanceOf(Role::class, $user->getRole());
        $this->assertEquals($testData['role'], $user->getRole()->getValue());

        $this->assertInstanceOf(Security::class, $user->getSecurityKeys());
        $this->assertEquals($testData['salt'], $user->getSecurityKeys()->getSalt());
        $this->assertEquals($testData['password'], $user->getSecurityKeys()->getPassword());

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals($testData['id'], $user->getId()->getValue());

        $this->assertCount(1, $user->getRecordedEvents());
        $this->assertInstanceOf(UserWasRegistered::class, $user->getRecordedEvents()[0]);
    }

    /**
     * Create a standard instance with random values for tests.
     *
     * @param array $testData
     * @return User
     */
    public static function createRandomTestInstance(array $testData = [])
    {
        return User::registerUser(RegisterUserCommandTest::createStandardTestInstance($testData));
    }
}