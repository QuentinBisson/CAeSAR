<?php

namespace Caesar\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Caesar\UserBundle\Entity\User;

class LoadUserAdmin implements FixtureInterface {

    public function load(ObjectManager $manager) {
        $userAdmin = new User();
        $userAdmin->setCodeBu(1);
        $userAdmin->setUsername("admin");
        $userAdmin->setName("admin");
        $userAdmin->setFirstname("admin");
        $userAdmin->setRole("ROLE_ADMIN");
        $userAdmin->setPassword("8450eca01665516d9aeb5317764902b78495502637c96192c81b1683d32d691a0965cf037feca8b9ed9ee6fc6ab8f27fce8f77c4fd9b4a442a00fc317b8237e6");
        $userAdmin->setEmail("admin@caesar.fr");
        $manager->persist($userAdmin);
        $manager->flush();
    }

}

?>
