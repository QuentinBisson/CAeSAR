<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Caesar\UserBundle\Entity\UserRepository

class UserAddControllerTest extends WebTestCase {

  public function testIndex() {
    $client = static::createClient();

    $crawler = $client->request('GET', '/fr/admin/user/add');

    file_put_contents("tutu.txt", $client->getResponse()->getContent());
    //$crawler = $client->followRedirect();
    //$this->assertEquals(1, $crawler->filter('h1:contains("Ajouter")')->count());
    //$this->assertEquals(1, $crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count());

    $this->assertGreaterThan(
      0, $crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count()
    );
  }

  public function testOnlyName() {
    $client = static::createClient();

    $crawler = $client->request('GET', '/fr/admin/user');

    $crawler->filter('tr:contains("1111111")')
    //TODOOOO



    $crawler = $client->request('GET', '/fr/admin/user/add');

    $form = $crawler->selectButton("Ajouter l'utilisateur")->form();

    // définit certaines valeurs
    $form['caesar_userBundle_userType[codeBu]'] = '1111111';
    $form['caesar_userBundle_userType[name]'] = 'Lucas';
    $form['caesar_userBundle_userType[firstname]'] = 'Lucas';
    $form['caesar_userBundle_userType[email]'] = 'Lucas@toot.fr';
    $form['caesar_userBundle_userType[username]'] = 'Lucas';
    $form['caesar_userBundle_userType[plainPassword]'] = 'Lucas';
    $form['caesar_userBundle_userType[confirmPassword]'] = 'Lucas';
    //<input type="text" id="caesar_userBundle_userType_name" name="caesar_userBundle_userType[name]" required="required">
    // soumet le formulaire
    $client->submit($form);

    file_put_contents("tutu.html", $client->getResponse()->getContent());

    //$this->assertTrue($crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count() > 0);
    $this->assertTrue($crawler->filter('html:contains("utilisateur Lucas bob a été ajouté.")')->count() > 0);
    //Lister les utilisateurs
  }

}
