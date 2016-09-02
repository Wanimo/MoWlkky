<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;

use Wanimo\Mowlkky\CoreDomain\User\Email;
use Wanimo\Mowlkky\CoreDomain\User\Event\UserWasRegistered;
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

        $encoder = self::createPasswordEncoder($encodedPassword = $faker->sha1);
        $user = User::registerUser(RegisterUserCommandTest::createStandardTestInstance($testData), $encoder);

        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals($testData['firstName'], $user->getIdentity()->getFirstName());
        $this->assertEquals($testData['lastName'], $user->getIdentity()->getLastName());

        $this->assertInstanceOf(Email::class, $user->getEmail());
        $this->assertEquals($testData['email'], $user->getEmail()->getValue());

        $this->assertInstanceOf(Role::class, $user->getRole());
        $this->assertEquals($testData['role'], $user->getRole()->getValue());

        $this->assertInstanceOf(EncodedPassword::class, $user->getPassword());
        $this->assertEquals($encodedPassword, $user->getPassword()->getValue());

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
        $encoder = self::createPasswordEncoder(
            array_key_exists('encodedPassword', $testData) ? $testData['encodedPassword'] : null
        );

        return User::registerUser(RegisterUserCommandTest::createStandardTestInstance($testData), $encoder);
    }

    /**
     * @param string $encodedPassword
     * @return PasswordEncoder
     */
    protected static function createPasswordEncoder($encodedPassword = null): PasswordEncoder
    {
        return new FakePasswordEncoder($encodedPassword);
    }
}