<?php

namespace Tests\Wanimo\Mowlkky\CoreBundle\Repository\InMemory;

use Wanimo\Mowlkky\CoreBundle\Repository\InMemory\UserRepository;
use Wanimo\Mowlkky\CoreDomain\User\RegisterUserCommand;
use Wanimo\Mowlkky\CoreDomain\User\Role;
use Wanimo\Mowlkky\CoreDomain\User\User;
use Wanimo\Mowlkky\CoreDomain\User\UserId;
use Faker;

/**
 * Test class for the in memory UserRepository
 */
class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for the find method.
     */
    public function testFind()
    {
        $faker = Faker\Factory::create();

        $repository = new UserRepository();

        $command = new RegisterUserCommand($repository);
        $command
            ->withEmail($faker->email)
            ->withFirstName($faker->firstName)
            ->withLastName($faker->lastName)
            ->withPassword($faker->password)
            ->withSalt($faker->randomAscii)
            ->withRole(Role::ROLE_REFEREE)
            ->withUserId(new UserId($faker->uuid));

        $user = User::registerUser($command);

        $this->assertInstanceOf(UserRepository::class, $repository->add($user));
        $this->assertInstanceOf(User::class, $foundUser = $repository->find($user->getId()));
        $this->assertEquals($user, $foundUser);
        $this->assertEquals(null, $repository->find(new UserId($faker->uuid)));
    }
}
