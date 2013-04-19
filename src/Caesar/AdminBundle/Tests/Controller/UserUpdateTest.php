<?php

namespace Caesar\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Caesar\UserBundle\Entity\User;

class UserUpdateTest extends WebTestCase {

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
        $user = new User();
        $encoder = static::$kernel->getContainer()->get('security.encoder_factory')->getEncoder($user);
        $user->setCodeBu(123)
                ->setUserName("tototo")
                ->setPassword($encoder->encodePassword("totootototototo", $user->getSalt()))
                ->setEmail("toto@toto.fr")
                ->setName("totooo")
                ->setFirstName("totooooo")
                ->setRole("ROLE_USER");
        $this->em->persist($user);
        $this->em->flush();

        $crawler = $client->request('GET', '/fr/admin/user/update/' . $user->getId());

        $form = $crawler->selectButton("Modifier l'utilisateur")->form();
        $form['caesar_userBundle_userUpdateType[name]'] = 'titi';
        $form['caesar_userBundle_userUpdateType[firstname]'] = 'titi';
        $form['caesar_userBundle_userUpdateType[email]'] = 'titi@titi.fr';
        $form['caesar_userBundle_userUpdateType[username]'] = 'tititi';
        $form['caesar_userBundle_userUpdateType[plainPassword]'] = 'titititi';
        $form['caesar_userBundle_userUpdateType[confirmPassword]'] = 'titititi';

        $client->submit($form);
    }

    /**
     * @depends testDataValide
     */
    public function testUpdateDataValide() {
        $client = static::createClient();

        $user_bis = $this->em->getRepository('CaesarUserBundle:User')->findOneByCodeBu(123);

        $this->assertEquals('titi', $user_bis->getName());
        $this->assertEquals('titi', $user_bis->getFirstName());
        $this->assertEquals('titi@titi.fr', $user_bis->getEmail());
        $this->assertEquals('tititi', $user_bis->getUsername());

        $encoder = static::$kernel->getContainer()->get('security.encoder_factory')->getEncoder($user_bis);
        $this->assertEquals($encoder->encodePassword('titititi', $user_bis->getSalt()), $user_bis->getPassword());

        $client->request('GET', '/fr/admin/user/delete/' . $user_bis->getId());
    }

    public function testDataInValide() {
        $client = static::createClient();
        $user = new User();
        $encoder = static::$kernel->getContainer()->get('security.encoder_factory')->getEncoder($user);
        $user->setCodeBu(124)
                ->setUserName("tototo")
                ->setPassword($encoder->encodePassword("totootototototo", $user->getSalt()))
                ->setEmail("toto@toto.fr")
                ->setName("totooo")
                ->setFirstName("totooooo")
                ->setRole('ROLE_USER');
        $this->em->persist($user);
        $this->em->flush();

        $crawler = $client->request('GET', '/fr/admin/user/update/' . $user->getId());

        $form = $crawler->selectButton("Modifier l'utilisateur")->form();
        $form['caesar_userBundle_userUpdateType[name]'] = 'titi5';
        $form['caesar_userBundle_userUpdateType[firstname]'] = 'titi5';
        $form['caesar_userBundle_userUpdateType[email]'] = 'titi';
        $form['caesar_userBundle_userUpdateType[username]'] = 'titi';
        $form['caesar_userBundle_userUpdateType[plainPassword]'] = 'toto';
        $form['caesar_userBundle_userUpdateType[confirmPassword]'] = 'toto';

        $client->submit($form);
    }

    /**
     * @depends testDataInValide
     */
    public function testUpdateDataInValide() {
        $client = static::createClient();

        $user_bis = $this->em->getRepository('CaesarUserBundle:User')->findOneByCodeBu(124);

        $this->assertEquals('totooo', $user_bis->getName());
        $this->assertEquals('totooooo', $user_bis->getFirstName());
        $this->assertEquals('toto@toto.fr', $user_bis->getEmail());
        $this->assertEquals('tototo', $user_bis->getUsername());

        $encoder = static::$kernel->getContainer()->get('security.encoder_factory')->getEncoder($user_bis);
        $this->assertEquals($encoder->encodePassword('totootototototo', $user_bis->getSalt()), $user_bis->getPassword());

        $client->request('GET', '/fr/admin/user/delete/' . $user_bis->getId());
    }

}

?>
