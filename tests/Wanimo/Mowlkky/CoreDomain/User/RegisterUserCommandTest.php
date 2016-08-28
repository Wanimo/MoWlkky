<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;

use Faker;
use Wanimo\Mowlkky\CoreDomain\User\RegisterUserCommand;
use Wanimo\Mowlkky\CoreDomain\User\Role;
use Wanimo\Mowlkky\CoreDomain\User\UserId;

class RegisterUserCommandTest
{
    /**
     * Create a standard instance with random values for tests.
     *
     * @param array $testData
     * @return RegisterUserCommand
     */
    public static function createStandardTestInstance(array $testData = [])
    {
        $faker = Faker\Factory::create();

        $command = new RegisterUserCommand();
        $command
            ->withEmail(array_key_exists('email', $testData) ? $testData['email'] : $faker->email)
            ->withFirstName(array_key_exists('firstName', $testData) ? $testData['firstName'] : $faker->firstName)
            ->withLastName(array_key_exists('lastName', $testData) ? $testData['lastName'] : $faker->lastName)
            ->withRawPassword(array_key_exists('password', $testData) ? $testData['password'] : $faker->password)
            ->withRole(array_key_exists('role', $testData) ? $testData['role'] : Role::ROLE_REFEREE)
            ->withUserId(
                new UserId(array_key_exists('id', $testData) ? $testData['id'] : $faker->uuid)
            );

        return $command;
    }
}