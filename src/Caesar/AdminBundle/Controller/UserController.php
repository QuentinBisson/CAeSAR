<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of UserController
 *
 * @author bissoqu1
 */
class UserController extends Controller {

    public function indexAction($page = 1) {
        $em = $this->getDoctrine()->getEntityManager();

 
        //Création de la requête : Exemple
        $dql = "SELECT u FROM CaesarUserBundle:User u";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $page/* page number */, 20/* limit per page */
        );

        return $this->render("CaesarAdminBundle:User:index.html.twig",
                array('pagination' => $pagination)
        );
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
