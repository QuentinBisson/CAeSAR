<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Caesar\UserBundle\Entity\UserRepository;

class UserAddControllerTest extends WebTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getEntityManager()
        ;
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/admin/user/add');

        file_put_contents("tutu.txt", $client->getResponse()->getContent());
        //$crawler = $client->followRedirect();
        //$this->assertEquals(1, $crawler->filter('h1:contains("Ajouter")')->count());
        //$this->assertEquals(1, $crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count());
        
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count()
        );
    }

    public function testOnlyName()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/admin/user');

        /*$td = $crawler->filter('tr:contains("1111111")');
        $link = $crawler->selectLink('Supprimer l\'utilisateur')->link();
        echo $link->getUri();
        $crawler = $client->click($link);*/

        file_put_contents("add.html", $client->getResponse()->getContent());

        //$td = $crawler->filter('tr:contains("1111111")');
        $link = $crawler->filterXpath("//tr[@id='12']//a")->eq(0)->link();


        $crawler = $client->click($link);



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

        $repository_user = $this->em->getRepository('CaesarUserBundle:User');

        $users = $repository_user->getUserFromToSortBy(1, 'codeBu', 'asc');
        $count = $repository_user->count();

        echo "\n";
        echo $count;
        echo "\nBONJOUR\n";

        file_put_contents("tutu.html", $client->getResponse()->getContent());

        //$crawler = $client->request('GET', '/fr/admin/user');

        //$this->assertTrue($crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("1111111")')->count() == 1);
        //Lister les utilisateurs
    }
}
