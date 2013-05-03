<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Caesar\ResourceBundle\Entity\Resource;
use Caesar\ShelfBundle\Entity\Shelf;

class ResourceUpdateTest extends WebTestCase {

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

    public function testDataValide() {
        $client = static::createClient();
        $resource = new Resource();
        $shelf = new Shelf();
        $shelf->setName("étagére 5")
                ->setDescription("A gauche dans la salle");
        $this->em->persist($shelf);

        $resource->setCode("C-0000000061")
                ->setShelf($shelf)
                ->setDescription("Pratique des tests logiciels")
                ->setLongDescription("Autre: moi, page:259")
                ->setQuantity(3)
                ->setPath("img.png")
        ;
        $this->em->persist($resource);
        $this->em->flush();
        $crawler = $client->request('GET', '/fr/admin/resource/update/' . $resource->getId());

        $form = $crawler->selectButton("Modifier la ressource")->form();
        $form['caesar_resourceBundle_resourceType[code]'] = 'C-0000000061';
        $form['caesar_resourceBundle_resourceType[description]'] = 'Pratique des tests logiciels 2';
        $form['caesar_resourceBundle_resourceType[quantity]'] = 4;
        $form['caesar_resourceBundle_resourceType[longDescription]'] = 'Auteur: moi, page:259';

        $client->submit($form);
    }

    /**
     * @depends testDataValide
     */
    public function testUpdateDataValide() {

        $resource_bis = $this->em->getRepository('CaesarResourceBundle:Resource')->findOneByCode('C-0000000061');

        $this->assertEquals('Pratique des tests logiciels 2', $resource_bis->getDescription());
        $this->assertEquals(4, $resource_bis->getQuantity());
        $this->assertEquals('Auteur: moi, page:259', $resource_bis->getLongDescription());

        $this->em->remove($resource_bis);
        $this->em->remove($resource_bis->getShelf());
        $this->em->flush();
    }

    public function testDataInValide() {
        $client = static::createClient();
        $resource = new Resource();
        $shelf = new Shelf();
        $shelf->setName("étagére 6")
                ->setDescription("A gauche dans la salle");
        $this->em->persist($shelf);

        $resource->setCode("C-0000000061")
                ->setShelf($shelf)
                ->setDescription("Pratique des tests logiciels")
                ->setLongDescription("Autre: moi, page:259")
                ->setQuantity(3)
                ->setPath("img.png")
        ;
        $this->em->persist($resource);
        $this->em->flush();
        $crawler = $client->request('GET', '/fr/admin/resource/update/' . $resource->getId());

        $form = $crawler->selectButton("Modifier la ressource")->form();
        $form['caesar_resourceBundle_resourceType[code]'] = 'Aaazaz';
        $form['caesar_resourceBundle_resourceType[description]'] = 'Pratique des tests logiciels 2';
        $form['caesar_resourceBundle_resourceType[quantity]'] = 'a';
        $form['caesar_resourceBundle_resourceType[longDescription]'] = 'Auteur: moi, page:259';

        $client->submit($form);
    }

    /**
     * @depends testDataInValide
     */
    public function testUpdateDataInValide() {

        $resource_bis = $this->em->getRepository('CaesarResourceBundle:Resource')->findOneByCode('C-0000000061');

        $this->assertEquals('Pratique des tests logiciels', $resource_bis->getDescription());
        $this->assertEquals(3, $resource_bis->getQuantity());
        $this->assertEquals('Autre: moi, page:259', $resource_bis->getLongDescription());

        $this->em->remove($resource_bis);
        $this->em->remove($resource_bis->getShelf());
        $this->em->flush();
    }

}

?>
