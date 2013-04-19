<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Caesar\AdminBundle\Tests\Controller;

class ShelfAddControllerTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getEntityManager()
        ;
    }

    public function testIndex() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/admin/shelf/add');


        $this->assertGreaterThan(
                0, $crawler->filter('html:contains("Ajouter un nouvel emplacement")')->count()
        );
    }

    public function testAddShelfFromCSV() {
        $arrResult = array();
        $arrLines = file('src\Caesar\AdminBundle\Tests\Controller\shelf.csv');
        foreach ($arrLines as $line) {
            $arrResult[] = explode(',', $line);
        }
        foreach ($arrResult as $res) {
            $this->testAddShelf($res[0], $res[1]);
        }
    }

    public function testAddShelf($name = 'Etagere', $description = 'Une étagère') {
        $client = static::createClient();
        $crawler = $client->request('GET', '/fr/admin/shelf/add');

        echo "Test sur :" . $name . " ," . $description . "\n";

        $form = $crawler->selectButton("Ajouter l'emplacement")->form();

        // définit certaines valeurs

        $form['caesar_shelfBundle_shelfType[name]'] = $name;
        $form['caesar_shelfBundle_shelfType[description]'] = $description;

        // soumet le formulaire
        $client->submit($form);


        $repository_user = $this->em->getRepository('CaesarUserBundle:User');
        $users = $repository_user->getUserFromToSortBy(1, 'codeBu', 'asc');
        $count = $repository_user->count(); //compte nb users pour calcul nb de pages (10/page)



        $crawler = $client->request('GET', '/fr/admin/shelf');

        $this->assertTrue($crawler->filter('html:contains("' . $name . '")')->count() > 0);

        //Suppression de l'utilisateur
        $crawler = $client->request('GET', '/fr/admin/shelf');
        $link = $crawler->filterXpath("//tr[@id='" . $name . "']//a")->eq(1)->link();
        $crawler = $client->click($link);
    }

}
