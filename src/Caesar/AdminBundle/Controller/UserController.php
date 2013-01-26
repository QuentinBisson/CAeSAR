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

    public function indexAction($page = 1, $sort = 'u.codeBu', $direction = 'asc') {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQueryBuilder()
                        ->add('select', 'u')
                        ->add('from', 'Caesar\UserBundle\Entity\User u')
                        ->add('where', 'u.role = \'USER\'')
                        ->addOrderBy($sort, $direction)->getQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $page, 10, array('sort' => $sort, 'direction' => $direction)
        );

        return $this->render("CaesarAdminBundle:User:index.html.twig", array(
                    'pagination' => $pagination, 'page' => $page,
                    'sort' => $sort, 'direction' => $direction,
                    'options' => array('translationDomain'=> 'messages')));
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

        $user = $this->getDoctrine()
                ->getRepository('CaesarUserBundle:User')
                ->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Produit non trouvé avec id ' . $id);
        }

        $form = $this->createForm(new UserType(), $user);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                
            }
        }

        return $this->render('CaesarAdminBundle:User:update.html.twig', array(
                    'form' => $form->createView(),
                ));
    }

    public function deleteAction($id) {
        $user = $this->getDoctrine()
                ->getRepository('CaesarUserBundle:User')
                ->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Produit non trouvé avec id ' . $id);
        }

        return $this->render('CaesarAdminBundle:User:delete.html.twig');
    }

}

?>
