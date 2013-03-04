<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin');

                file_put_contents("toto.txt", $client->getResponse()->getContent());


        $this->assertTrue($crawler->filter('html:contains("administration")')->count() > 0);
    }
}
