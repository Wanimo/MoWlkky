<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;

use Wanimo\Mowlkky\CoreBundle\Repository\InMemory\UserRepository;
use Wanimo\Mowlkky\CoreDomain\User\Email;
use Wanimo\Mowlkky\CoreDomain\User\Event\UserWasRegistered;
use Wanimo\Mowlkky\CoreDomain\User\RegisterUserCommand;
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
    public function testExecute()
    {
        $faker = Faker\Factory::create();
        $repository = new UserRepository();
        $command = new RegisterUserCommand($repository);
        $command
            ->withEmail($email = $faker->email)
            ->withFirstName($firstName = $faker->firstName)
            ->withLastName($lastName = $faker->lastName)
            ->withPassword($password = $faker->password)
            ->withSalt($salt = $faker->randomAscii)
            ->withRole($role = $faker->randomDigitNotNull % 2 == 0 ? Role::ROLE_ADMIN : Role::ROLE_REFEREE)
            ->withUserId(new UserId($userId = $faker->uuid));

        $user = User::registerUser($command);

        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals($firstName, $user->getFirstName());
        $this->assertEquals($lastName, $user->getLastName());

        $this->assertInstanceOf(Email::class, $user->getEmail());
        $this->assertEquals($email, $user->getEmail()->getValue());

        $this->assertInstanceOf(Role::class, $user->getRole());
        $this->assertEquals($role, $user->getRole()->getValue());

        $this->assertInstanceOf(Security::class, $user->getSecurityKeys());
        $this->assertEquals($salt, $user->getSecurityKeys()->getSalt());
        $this->assertEquals($password, $user->getSecurityKeys()->getPassword());

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals($userId, $user->getId()->getValue());

        $this->assertCount(1, $user->getRecordedEvents());
        $this->assertInstanceOf(UserWasRegistered::class, $user->getRecordedEvents()[0]);
    }
}