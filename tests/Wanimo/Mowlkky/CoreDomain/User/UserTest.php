<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;

use Wanimo\Mowlkky\CoreDomain\User\Email;
use Wanimo\Mowlkky\CoreDomain\User\Event\UserWasRegistered;
use Wanimo\Mowlkky\CoreDomain\User\Identity;
use Wanimo\Mowlkky\CoreDomain\User\Password\EncodedPassword;
use Wanimo\Mowlkky\CoreDomain\User\Password\PasswordEncoder;
use Wanimo\Mowlkky\CoreDomain\User\Role;
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

        $user = self::createStandardTestInstance($testData);

        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals($testData['firstName'], $user->getIdentity()->getFirstName());
        $this->assertEquals($testData['lastName'], $user->getIdentity()->getLastName());

        $this->assertInstanceOf(Email::class, $user->getEmail());
        $this->assertEquals($testData['email'], $user->getEmail()->getValue());

        $this->assertInstanceOf(Role::class, $user->getRole());
        $this->assertEquals($testData['role'], $user->getRole()->getValue());

        $this->assertInstanceOf(EncodedPassword::class, $user->getPassword());
        $this->assertEquals($testData['password'], $user->getPassword()->getValue());

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals($testData['id'], $user->getId()->getValue());

        $this->assertCount(1, $user->getRecordedEvents());
        $this->assertInstanceOf(UserWasRegistered::class, $user->getRecordedEvents()[0]);
    }

    /**
     * Create a standard instance with random values for tests.
     *
     * @param array $testData Array to force some attribute values. A random one is set if not defined.
     * @return User
     */
    public static function createStandardTestInstance(array $testData = [])
    {
        $faker = Faker\Factory::create();

        $id = array_key_exists('id', $testData) ? $testData['id'] : $faker->uuid;
        $email = array_key_exists('email', $testData) ? $testData['email'] : $faker->email;
        $firstName = array_key_exists('firstName', $testData) ? $testData['firstName'] : $faker->firstName;
        $lastName = array_key_exists('lastName', $testData) ? $testData['lastName'] : $faker->lastName;
        $password = array_key_exists('password', $testData) ? $testData['password'] : $faker->password;
        $salt = array_key_exists('salt', $testData) ? $testData['salt'] : $faker->password;
        $role = array_key_exists('role', $testData) ? $testData['role'] : Role::ROLE_REFEREE;

        $user = User::registerUser(
            new UserId($id),
            new Email($email),
            new Identity($firstName, $lastName),
            new EncodedPassword($password, $salt),
            new Role($role)
        );

        return $user;
    }
}