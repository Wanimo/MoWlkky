<?php

namespace Wanimo\Mowlkky\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('MoWlkky : organisez vos tournois de Molkky', $crawler->filter('body h1')->text());
    }
}
