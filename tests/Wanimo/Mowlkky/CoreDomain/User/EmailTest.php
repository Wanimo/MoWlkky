<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;

use InvalidArgumentException;
Use Faker;
use Wanimo\Mowlkky\CoreDomain\User\Email;

/**
 * Test for the Email value object.
 */
class EmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for the constructor to check format validation
     */
    public function testConstruct()
    {
        $faker = Faker\Factory::create();
        $this->assertEquals(null, $this->newAndCatchException($faker->email));
        $this->assertInstanceOf(InvalidArgumentException::class, $this->newAndCatchException($faker->randomAscii));
    }

    /**
     * @param string $email
     * @return InvalidArgumentException|null
     */
    private function newAndCatchException(string $email)
    {
        $exception = null;

        try {
            new Email($email);
        } catch(InvalidArgumentException $e) {
            $exception = $e;
        }

        return $exception;
    }
}