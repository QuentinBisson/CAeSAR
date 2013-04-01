<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Caesar\AdminBundle\Tests\Controller;

class ResourceAddControllerTest extends WebTestCase
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

        $crawler = $client->request('GET', '/fr/admin/resource/add');

        
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Ajouter une nouvelle ressource")')->count()
        );
    }

    public function testAddDeleteSeveralResources() {            

        $arrResult = array();
        $arrLines = file('..\src\Caesar\AdminBundle\Tests\Controller\resource.csv');
        foreach($arrLines as $line) {
            $arrResult[] = explode( ',', $line);
        }
        foreach($arrResult as $res) {
            $this->testAdd($res[0],$res[1],$res[2],$res[3],$res[4],$res[5]);
        }


    }

    public function testAdd($code = '9782360570409', $description = 'Manuel de Russe vol 1', $quantity='1', $shelf='107',
    		$url='http://connectnigeria.com/articles/wp-content/uploads/2012/12/Google.jpg', $longDescription='Oui.')
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/fr/admin/resource/add');

        echo "Test sur :".$code." ,".$description." \n";

        $form = $crawler->selectButton("Ajouter la ressource")->form();

        // définit certaines valeurs
        $form['caesar_resourceBundle_resourceType[code]'] = $code;
        $form['caesar_resourceBundle_resourceType[description]'] = $description;
        $form['caesar_resourceBundle_resourceType[quantity]'] = $quantity;
        $form['caesar_resourceBundle_resourceType[shelf]']->select($shelf);
        //$form['caesar_resourceBundle_resourceType[local]']->upload($local);
        $form['caesar_resourceBundle_resourceType[url]'] = $url;
        $form['caesar_resourceBundle_resourceType[path]'] = $url;
               
        $form['caesar_resourceBundle_resourceType[longDescription]'] = $longDescription;
        
        
        // soumet le formulaire
        $client->submit($form);    

        file_put_contents("admin.html", $client->getResponse()->getContent());
        
        $repository_user = $this->em->getRepository('CaesarUserBundle:User');
        $users = $repository_user->getUserFromToSortBy(1, 'codeBu', 'asc');
        $count = $repository_user->count(); //compte nb users pour calcul nb de pages (10/page)
        

        $crawler = $client->request('GET', '/fr/admin/resource');

        //echo "\n name :".$name."\n"; 
        $this->assertTrue($crawler->filter('html:contains("'.$code.'")')->count() > 0);
        
        /* Suppression de l'utilisateur */
        $crawler = $client->request('GET', '/fr/admin/resource');
        $link = $crawler->filterXpath("//tr[@id='".$code."']//a")->eq(1)->link();
        $crawler = $client->click($link);
        
    }

   
}
