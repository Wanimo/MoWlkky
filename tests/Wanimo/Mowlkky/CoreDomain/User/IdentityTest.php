<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\User;
use InvalidArgumentException;
use Wanimo\Mowlkky\CoreDomain\User\Identity;

/**
 * Test for the Identity value object.
 */
class IdentityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for the constructor to check format validation
     */
    public function testConstruct()
    {
        $this->assertEquals(null, $this->newAndCatchException('John', 'Doe'));
        $this->assertEquals(null, $this->newAndCatchException('John Bobby', 'Doe'));
        $this->assertEquals(null, $this->newAndCatchException('John-Bobby', 'Doe'));
        $this->assertEquals(null, $this->newAndCatchException('John', 'Doedoe Deedon'));
        $this->assertEquals(null, $this->newAndCatchException('John', 'Doedoe-Deedon'));
        $this->assertEquals(null, $this->newAndCatchException('John\'s', 'Doedoe\'Deedon'));
        $this->assertEquals(null, $this->newAndCatchException('Jön', 'Doe'));
        $this->assertEquals(null, $this->newAndCatchException('Jön', 'Döe'));
        $this->assertInstanceOf(InvalidArgumentException::class, $this->newAndCatchException('J@hn', 'Doe'));
        $this->assertInstanceOf(InvalidArgumentException::class, $this->newAndCatchException('John', 'D0e'));
        $this->assertInstanceOf(InvalidArgumentException::class, $this->newAndCatchException('-John', 'Doe'));
        $this->assertInstanceOf(InvalidArgumentException::class, $this->newAndCatchException(' John', 'Doe'));
        $this->assertInstanceOf(InvalidArgumentException::class, $this->newAndCatchException('John', '-Doe'));
        $this->assertInstanceOf(InvalidArgumentException::class, $this->newAndCatchException('John', ' Doe'));
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @return InvalidArgumentException|null
     */
    private function newAndCatchException(string $firstName, string $lastName)
    {
        $exception = null;

        try {
            new Identity($firstName, $lastName);
        } catch(InvalidArgumentException $e) {
            $exception = $e;
        }

        return $exception;
    }
}