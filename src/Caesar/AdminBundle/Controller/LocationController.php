<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of LocationController
 *
 * @author bissoqu1
 */
class LocationController extends Controller {

    public function indexAction() {
        return $this->render('CaesarAdminBundle:Location:index.html.twig');
    }

    public function addAction() {
        return $this->render('CaesarAdminBundle:Location:add.html.twig');
    }

    public function updateAction() {
        return $this->render('CaesarAdminBundle:Location:update.html.twig');
    }

    public function deleteAction() {
        return $this->render('CaesarAdminBundle:Location:delete.html.twig');
    }

}

?>
