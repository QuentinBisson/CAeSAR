<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Caesar\ResourceBundle\Entity\Resource;
use Caesar\ShelfBundle\Entity\Shelf;
use Caesar\TagBundle\Entity\Tag;

class ResourceUpdateTest extends WebTestCase{
 
    
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

        $resource->setCode("CAeSAR-0000000001")
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
        $form['caesar_resourceBundle_resourceType[code]'] = 'CAeSAR-0000000002';
        $form['caesar_resourceBundle_resourceType[description]'] = 'Pratique des tests logiciels 2';
        $form['caesar_resourceBundle_resourceType[quantity]'] = 4;
        $form['caesar_resourceBundle_resourceType[url]'] = 'http://www.dinosoria.com/mammifere/raton-laveur-02.jpg';
        $form['caesar_resourceBundle_resourceType[longDescription]'] = 'Auteur: moi, page:259';

        $client->submit($form);
    }

    /**
     * @depends testDataValide
     */
    public function testUpdateDataValide() {
        $client = static::createClient();

        $resource_bis = $this->em->getRepository('CaesarResourceBundle:Resource')->findOneByCode('CAeSAR-0000000002');

        if($resource_bis == null) {
            $resource_bis = $this->em->getRepository('CaesarResourceBundle:Resource')->findOneByCode('CAeSAR-0000000001');
        }
        $this->assertEquals('Pratique des tests logiciels 2', $resource_bis->getDescription());
        $this->assertEquals(4, $resource_bis->getQuantity());
        $this->assertEquals('http://www.dinosoria.com/mammifere/raton-laveur-02.jpg', $resource_bis->getUrl());
        $this->assertEquals('Auteur: moi, page:259', $resource_bis->getLongDescription());
        
        $client->request('GET', '/fr/admin/resource/delete/' . $resource_bis->getId());
    }
}

?>
