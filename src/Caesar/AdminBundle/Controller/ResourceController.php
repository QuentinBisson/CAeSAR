<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of ResourceController
 *
 * @author bissoqu1
 */
class ResourceController extends Controller {

    public function listAction() {
        return $this->render('CaesarAdminBundle:Resource:list.html.twig');
    }

    public function addAction() {
        return $this->render('CaesarAdminBundle:Resource:add.html.twig');
    }

    public function updateAction() {
        return $this->render('CaesarAdminBundle:Resource:update.html.twig');
    }

    public function deleteAction() {
        return $this->render('CaesarAdminBundle:Resource:delete.html.twig');
    }
    
    public function skeletonAction() {
        return $this->render('CaesarAdminBundle:Resource:skeleton.html.twig');
    }

}

?>
