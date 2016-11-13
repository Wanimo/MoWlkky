<?php

namespace Tests\Wanimo\Mowlkky\CoreBundle\Repository\InMemory;

use Tests\Wanimo\Mowlkky\CoreDomain\User\UserTest;
use Wanimo\Mowlkky\CoreBundle\Repository\InMemory\UserRepository;
use Wanimo\Mowlkky\CoreDomain\User\Email;
use Wanimo\Mowlkky\CoreDomain\User\User;
use Faker;

/**
 * Test class for the in memory UserRepository
 */
class UserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for the find method.
     */
    public function testFindOneByEmail()
    {
        $faker = Faker\Factory::create();

        $repository = new UserRepository();

        $user = UserTest::createStandardTestInstance(['email' => $email = $faker->email]);
        $repository->add($user);
        $foundUser = $repository->findOneByEmail($user->getEmail());
        $otherFoundUser = $repository->findOneByEmail(new Email($faker->email));

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user, $foundUser);
        $this->assertEquals(null, $otherFoundUser);
    }
}
