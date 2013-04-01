<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Caesar\UserBundle\Entity\UserRepository;
use Caesar\AdminBundle\Tests\Controller;

class UserAddDeleteTest extends WebTestCase {

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
    $crawler = $client->request('GET', '/fr/admin/user/add');

    
    $this->assertGreaterThan(
      0, $crawler->filter('html:contains("Ajouter un nouvel utilisateur")')->count()
    );
  }

    public function testAddDeleteSeveralNames() {            

        $arrResult = array();
        $arrLines = file('src\Caesar\AdminBundle\Tests\Controller\user.csv');
        foreach($arrLines as $line) {
            $arrResult[] = explode( ',', $line);
        }
        foreach($arrResult as $res) {
            $this->testAdd($res[0],$res[1],$res[2],$res[3],$res[4],$res[5],$res[6]);
        }


    }

    public function testAdd($code = '11111', $name = 'Lucas', $firstname='Lucas', $email = 'Lucas@lucas.fr',
         $username="Lucas", $plainPassword='Lucasdu76', $confirmPassword='Lucasdu76')
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/fr/admin/user/add');

        echo "Test sur :".$code." ,".$name." ,".$firstname." ,".$email." ,".$username." ,".$plainPassword." ,".$confirmPassword."\n";

        $form = $crawler->selectButton("Ajouter l'utilisateur")->form();

        // définit certaines valeurs
        $form['caesar_userBundle_userType[codeBu]'] = $code;
        $form['caesar_userBundle_userType[name]'] = $name;
        $form['caesar_userBundle_userType[firstname]'] = $firstname;
        $form['caesar_userBundle_userType[email]'] = $email;
        $form['caesar_userBundle_userType[username]'] = $username;
        $form['caesar_userBundle_userType[plainPassword]'] = $plainPassword;
        $form['caesar_userBundle_userType[confirmPassword]'] = $confirmPassword;
        
        // soumet le formulaire
        $client->submit($form);       


        $repository_user = $this->em->getRepository('CaesarUserBundle:User');
        $users = $repository_user->getUserFromToSortBy(1, 'codeBu', 'asc');
        $count = $repository_user->count(); //compte nb users pour calcul nb de pages (10/page)
        

        $crawler = $client->request('GET', '/fr/admin/user');

        echo "\nname :".$name."\n"; 
        $this->assertTrue($crawler->filter('html:contains("'.$name.'")')->count() > 0);
        
        /* Suppression de l'utilisateur */
        $crawler = $client->request('GET', '/fr/admin/user');
        $link = $crawler->filterXpath("//tr[@id='".$code."']//a")->eq(1)->link();
        $crawler = $client->click($link);
        
    }

}
