<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;

use Wanimo\Mowlkky\CoreBundle\Repository\InMemory\UserRepository;
use Wanimo\Mowlkky\CoreDomain\User\NotUniqueEmailException;
use Wanimo\Mowlkky\CoreDomain\User\RegisterUserHandler;
use Wanimo\Mowlkky\CoreDomain\User\User;
use Faker;

/**
 * Test class for the RegisterUser handler.
 */
class RegisterUserHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for the handle method.
     */
    public function testHandle()
    {
        $faker = Faker\Factory::create();
        $repository = new UserRepository();

        $handler = new RegisterUserHandler($repository);

        $user = $handler->handle(
            RegisterUserCommandTest::createStandardTestInstance(['email' => $email = $faker->email])
        );

        $this->assertInstanceOf(User::class, $user);

        // The User should have been added to the UserRepository
        $this->assertInstanceOf(User::class, $foundUser = $repository->find($user->getId()));
        $this->assertEquals($user, $foundUser);

        // If we try to register another user with the same email, we must be rejected
        $this->expectException(NotUniqueEmailException::class);
        $this->expectExceptionMessage(sprintf('There is already another registered user with email %s', $email));

        $handler->handle(RegisterUserCommandTest::createStandardTestInstance(['email' => $email]));
    }
}