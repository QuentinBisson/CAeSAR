<?php

namespace Caesar\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase {

    public function testInformations() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/fr/consult/9782757822747');
        $this->assertTrue($crawler->filter('html:contains("Un oeuf de fer")')->count() > 0);
    }  
    

}
