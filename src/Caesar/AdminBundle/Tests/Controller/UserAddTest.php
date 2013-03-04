<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserAddControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/admin/user/add');

        //$crawler = $client->followRedirect();
        //$this->assertEquals(1, $crawler->filter('h1:contains("Ajouter")')->count());
        //$this->assertEquals(1, $crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count());
        
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count()
        );
    }

    /*public function testOnlyName()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/user/add');

        $form = $crawler->selectButton('Ajouter l\'utilisateur')->form();

		// définit certaines valeurs
		$form['name'] = 'Lucas';
		
		// soumet le formulaire
		$crawler = $client->submit($form);

        $this->assertTrue($crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count() > 0);
    }*/
}
