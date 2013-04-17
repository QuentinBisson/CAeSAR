<?php

namespace CAeSAR\UserBundle\DataFixtures\ORM;

use CAeSAR\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $arrResult = array();
        $arrLines = file('src/Caesar/UserBundle/DataFixtures/ORM/userFixtures.csv');
        $encoder = $this->container->get('security.encoder_factory')->getEncoder(new User());

        foreach ($arrLines as $line) {
            $arrResult[] = explode(',', $line);
        }
        foreach ($arrResult as $res) {
            $userAdmin = new User();
            $userAdmin->setCodeBu($res[0]);
            $userAdmin->setName($res[4]);
            $userAdmin->setFirstname($res[5]);
            $userAdmin->setEmail($res[3]);
            $userAdmin->setUsername($res[1]);
            $userAdmin->setPassword($encoder->encodePassword($res[2], $userAdmin->getSalt()));
            $userAdmin->setRole('ROLE_USER');
            $manager->persist($userAdmin);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 1; // the order in which fixtures will be loaded
    }

}