<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Caesar\ShelfBundle\Entity\Shelf;

class ShelfUpdateTest extends WebTestCase {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $id;

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

    public function testDataValide() {
        $client = static::createClient();
        $shelf = new Shelf();
        $shelf->setName("étagére 1")
                ->setDescription("A gauche dans la salle");
        $this->em->persist($shelf);
        $this->em->flush();

        $crawler = $client->request('GET', '/fr/admin/shelf/update/' . $shelf->getId());
        $this->id = $shelf->getId();
        $form = $crawler->selectButton("Modifier l'emplacement")->form();
        $form['caesar_shelfBundle_shelfType[name]'] = 'étagére 2';
        $form['caesar_shelfBundle_shelfType[description]'] = 'A droite dans la salle';

        $client->submit($form);
    }

    /**
     * @depends testDataValide
     */
    public function testUpdateDataValide() {
        $client = static::createClient();

        $shelf_bis = $this->em->getRepository('CaesarShelfBundle:Shelf')->findOneByName('étagére 2');

        $this->assertEquals('étagére 2', $shelf_bis->getName());
        $this->assertEquals('A droite dans la salle', $shelf_bis->getDescription());

        $client->request('GET', '/fr/admin/shelf/delete/' . $shelf_bis->getId());
    }

    public function testDatainValide() {
        $client = static::createClient();
        $shelf = new Shelf();
        $shelf->setName("étagére 1")
                ->setDescription("A gauche dans la salle");
        $this->em->persist($shelf);
        $this->em->flush();

        $crawler = $client->request('GET', '/fr/admin/shelf/update/' . $shelf->getId());
        $this->id = $shelf->getId();
        $form = $crawler->selectButton("Modifier l'emplacement")->form();
        $form['caesar_shelfBundle_shelfType[name]'] = '     ';
        $form['caesar_shelfBundle_shelfType[description]'] = '         ';

        $client->submit($form);
    }

    /**
     * @depends testDataValide
     */
    public function testUpdateDatainValide() {
        $client = static::createClient();

        $shelf_bis = $this->em->getRepository('CaesarShelfBundle:Shelf')->findOneByName('étagére 1');

        $this->assertEquals('étagére 1', $shelf_bis->getName());
        $this->assertEquals('A gauche dans la salle', $shelf_bis->getDescription());

        $client->request('GET', '/fr/admin/shelf/delete/' . $shelf_bis->getId());
    }

}

?>
