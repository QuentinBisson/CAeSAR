<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Caesar\UserBundle\Entity\User;
use Caesar\UserBundle\Form\UserType;

/**
 * Description of UserController
 *
 * @author bissoqu1
 */
class UserController extends Controller {

    public function indexAction($page = 1) {
        $em = $this->getDoctrine()->getEntityManager();


        //Création de la requête : Exemple
        $dql = "SELECT u FROM CaesarUserBundle:User u WHERE u.role NOT LIKE 'ADMINISTRATEUR'";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $page/* page number */, 10/* limit per page */
        );

        return $this->render("CaesarAdminBundle:User:index.html.twig", array('pagination' => $pagination)
        );
    }

    public function addAction(Request $request) {
        $user = new User();
        
        $form = $this->createForm(new UserType(), $user);
        
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                // effectuez quelques actions, comme sauvegarder la tâche dans
                // la base de données
                
                //return $this->redirect($this->generateUrl('task_success'));
            }
        }

        return $this->render('CaesarAdminBundle:User:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function updateAction(Request $request, $id) {
        
        
        //getUser
        $user = new User();
        
        $form = $this->createForm(new UserType(), $user);
        
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                // effectuez quelques actions, comme sauvegarder la tâche dans
                // la base de données
                
                //return $this->redirect($this->generateUrl('task_success'));
            }
        }
        
        return $this->render('CaesarAdminBundle:User:update.html.twig');
    }

    public function deleteAction() {
        return $this->render('CaesarAdminBundle:User:delete.html.twig');
    }

}

?>
