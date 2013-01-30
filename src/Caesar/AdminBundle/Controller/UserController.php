<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Caesar\UserBundle\Entity\User;
use Caesar\UserBundle\Form\UserType;

/**
 * Description of UserController
 *
 * @author bissoqu1
 */
class UserController extends Controller {

    public function indexAction($page = 1, $sort = 'id', $direction = 'asc') {
        $nb_per_page = 10; // Nombre d'éléments affichés par page (pour la pagination)
        $em = $this->getDoctrine()->getManager();

        $repository_user = $em->getRepository('CaesarUserBundle:User');

        $users = $repository_user->getUserFromToSortBy($page, $sort, $direction);
        $count = $repository_user->count();

        /* Pagination */
        $total = $count;
        $pagination = array(
            'cur' => $page,
            'max' => floor($total / $nb_per_page),
        );

        $request = $this->get('request');
        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarAdminBundle:User:list.html.twig", array(
                        'users' => $users,
                        'page' => $page,
                        'sort' => $sort,
                        'direction' => $direction,
                        'count' => $count,
                        'pagination' => $pagination));
        }

        return $this->render("CaesarAdminBundle:User:index.html.twig", array(
                    'users' => $users,
                    'page' => $page,
                    'sort' => $sort,
                    'direction' => $direction,
                    'count' => $count,
                    'pagination' => $pagination));
    }

    public function addAction() {
        $user = new User();

        $form = $this->createForm(new UserType(), $user);
        $request = $this->get('request');
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

    public function updateAction($id) {
        $user = $this->getDoctrine()
                ->getRepository('CaesarUserBundle:User')
                ->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Produit non trouvé avec id ' . $id);
        }
        $form = $this->createForm(new UserType(), $user);
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                
            }
        }

        return $this->render('CaesarAdminBundle:User:update.html.twig', array(
                    'form' => $form->createView(), 'user' => $id
                ));
        return new Response("ok");
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
