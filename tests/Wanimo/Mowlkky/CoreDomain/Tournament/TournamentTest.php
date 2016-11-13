<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\Tournament;

use Faker;
use Tests\Wanimo\Mowlkky\CoreDomain\User\UserTest;
use Wanimo\Mowlkky\CoreDomain\Tournament\Initialization\TournamentWasInitialized;
use Wanimo\Mowlkky\CoreDomain\Tournament\Name;
use Wanimo\Mowlkky\CoreDomain\Tournament\Tournament;
use Wanimo\Mowlkky\CoreDomain\Tournament\TournamentId;

/**
 * Test class for the Tournament entity.
 */
class TournamentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for the initializeNewTournament method.
     */
    public function testInitializeNewTournament()
    {
        $faker = Faker\Factory::create();

        $id = new TournamentId($faker->uuid);
        $creator = UserTest::createStandardTestInstance();
        $name = new Name($faker->name);
        $startingDate =  $faker->dateTimeBetween('now', '+6 months');

        $tournament = Tournament::initializeNewTournament($id, $creator, $name, $startingDate);

        $this->assertInstanceOf(Tournament::class, $tournament);

        $this->assertEquals($name, $tournament->getName());

        $this->assertInstanceOf(TournamentId::class, $tournament->getId());
        $this->assertEquals($id, $tournament->getId()->getValue());

        $this->assertInstanceOf(Name::class, $tournament->getName());
        $this->assertEquals($name, $tournament->getName()->getValue());

        $this->assertInstanceOf(\DateTime::class, $tournament->getStartingDate());
        $this->assertEquals($startingDate, $tournament->getStartingDate());

        $this->assertCount(1, $tournament->getRecordedEvents());
        $this->assertInstanceOf(TournamentWasInitialized::class, $tournament->getRecordedEvents()[0]);
    }

    /**
     * Create a standard instance with random values for tests.
     *
     * @param array $testData Array to force some attribute values. A random one is set if not defined.
     * @return Tournament
     */
    public static function createStandardTestInstance(array $testData = [])
    {
        $faker = Faker\Factory::create();

        $id = array_key_exists('id', $testData) ? $testData['id'] : $faker->uuid;
        $creator = array_key_exists('creator', $testData) ? $testData['creator'] : UserTest::createStandardTestInstance();
        $name = array_key_exists('name', $testData) ? $testData['name'] : sprintf('%s Tournament', $faker->monthName);
        $startingDate = array_key_exists('startingDate', $testData) ? $testData['startingDate'] : $faker->dateTimeBetween('now', '+6 months');

        $tournament = Tournament::initializeNewTournament(
            new TournamentId($id),
            $creator,
            new Name($name),
            $startingDate
        );

        return $tournament;
    }
}