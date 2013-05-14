<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * A tester quand la session et tout sera en place
 */
class UpdatePasswordAdminTest extends WebTestCase {

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
        /*$client = static::createClient();
        $crawler = $client->request('GET', '/fr/admin/login');

        $form = $crawler->selectButton("Connexion")->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'adminadmin';

        $client->submit($form);
        $crawler = $client->request('GET', '/fr/admin/password/');

        $user = static::$kernel->getContainer()->get('security.context')->getToken()->getUser();

        $form = $crawler->selectButton("Changer le mot de passe")->form();
        $form['caesar_userBundle_changePasswordType[currentPassword]'] = $user->getPassword();
        $form['caesar_userBundle_changePasswordType[newPassword]'] = 'testDePassword';
        $form['caesar_userBundle_changePasswordType[confirmPassword]'] = 'testDePassword';

        $client->submit($form);*/
    }

    /**
     * @depends testDataValide
     */
    public function testUpdateDataValide() {
        /*$user = static::$kernel->getContainer()->get('security.context')->getToken()->getUser();

        $user_bis = $this->em->getRepository('CaesarResourceBundle:Resource')->findOneById($user->getId());
        $encoder = static::$kernel->getContainer()->get('security.encoder_factory')->getEncoder($user);
        $this->assertEquals($encoder->encodePassword('testDePassword', $user_bis->getSalt()), $user_bis->getPassword());*/
    }

}