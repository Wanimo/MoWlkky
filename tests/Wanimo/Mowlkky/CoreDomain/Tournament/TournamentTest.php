<?php

namespace Tests\Wanimo\Mowlkky\CoreDomain\Tournament;

use Faker;
use Tests\Wanimo\Mowlkky\CoreDomain\User\UserTest;
use Wanimo\Mowlkky\CoreDomain\Tournament\Event\TournamentInitialized;
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

        $testData = [
            'name' => $faker->email,
            'creator' => UserTest::createStandardTestInstance(),
            'dateStart' => $faker->dateTimeThisMonth,
            'id' => $faker->uuid
        ];

        $tournament = self::createStandardTestInstance($testData);

        $this->assertInstanceOf(Tournament::class, $tournament);

        $this->assertEquals($testData['name'], (string) $tournament->getName());
        $this->assertEquals($testData['creator'], $tournament->getCreator());
        $this->assertEquals($testData['id'], (string) $tournament->getId());
        $this->assertEquals($testData['dateStart'], $tournament->getStartDate());

        $this->assertCount(1, $tournament->getRecordedEvents());
        $this->assertInstanceOf(TournamentInitialized::class, $tournament->getRecordedEvents()[0]);
    }

    /**
     * Create a standard instance with random values for tests.
     *
     * @param array $testData Array to force some attribute values. A random one is set if not defined.
     *
     * @return Tournament
     */
    public static function createStandardTestInstance(array $testData = [])
    {
        $faker = Faker\Factory::create();

        $id = array_key_exists('id', $testData) ? $testData['id'] : $faker->uuid;
        $creator = array_key_exists('creator', $testData) ? $testData['creator'] : null;
        $name = array_key_exists('name', $testData) ? $testData['name'] : $faker->title;
        $dateStart = array_key_exists('dateStart', $testData) ? $testData['dateStart'] : $faker->dateTimeThisMonth;

        $tournament = Tournament::initializeNewTournament(
            new TournamentId($id),
            $creator,
            $dateStart,
            new Name($name)
        );

        return $tournament;
    }
}