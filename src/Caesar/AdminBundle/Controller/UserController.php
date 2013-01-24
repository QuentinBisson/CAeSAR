<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of UserController
 *
 * @author bissoqu1
 */
class UserController extends Controller {

    public function listAction() {
        return $this->render('CaesarAdminBundle:User:list.html.twig');
    }

    public function addAction() {
        return $this->render('CaesarAdminBundle:User:add.html.twig');
    }

    public function updateAction() {
        return $this->render('CaesarAdminBundle:User:update.html.twig');
    }

    public function deleteAction() {
        return $this->render('CaesarAdminBundle:User:delete.html.twig');
    }

}

?>
