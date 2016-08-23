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
        $this->assertContains('Mo<span>W</span>lkky', $crawler->filter('body h1')->html());
        $this->assertContains(
            'Préparez, organisez, visualisez vos tournois de Molkky !',
            $crawler->filter('.jumbotron .container p')->text()
        );
    }
}
