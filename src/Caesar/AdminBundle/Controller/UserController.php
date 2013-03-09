<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\UserBundle\Entity\User;
use Caesar\UserBundle\Form\UserType;
use Caesar\UserBundle\Form\UserUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of UserController
 *
 * @author bissoqu1
 */
class UserController extends Controller {

    public function indexAction($page = 1, $sort = 'codeBu', $direction = 'asc') {

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

        $array = array(
            'users' => $users,
            'page' => $page,
            'sort' => $sort,
            'direction' => $direction,
            'count' => $count,
            'pagination' => $pagination);

        $request = $this->get('request');
        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarAdminBundle:User:list.html.twig", $array);
        }

        return $this->render("CaesarAdminBundle:User:index.html.twig", $array);
    }

    public function addAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $request = $this->get('request');

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $user = $form->getData();
                $user->setRole('ROLE_USER');
                $plainPassword = $user->getPlainPassword();
                if (!empty($plainPassword)) {
                    $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                    $user->setPassword($encoder->encodePassword($plainPassword, $user->getSalt()));
                }
                $em->persist($user);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'notice', 'L\'utilisateur ' . $user->getName() . ' ' . $user->getFirstname() . ' a été ajouté.'
                );
                return $this->redirect($this->generateUrl('caesar_admin_user_homepage'));
            }
        }

        return $this->render('CaesarAdminBundle:User:add.html.twig', array(
                    'form' => $form->createView(),
                ));
    }

    public function updateAction($id) {
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException('L\'identifiant ' . $id . ' n\'est pas valide.');
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $user = $em->getRepository('CaesarUserBundle:User')
                    ->find($clean);
        }

        if (!$user) {
            throw $this->createNotFoundException('Produit non trouvé avec id ' . $id);
        }

        $user->setConfirmPassword($user->getPlainPassword());

        $form = $this->createForm(new UserUpdateType(), $user);
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $user = $form->getData();
                $password = $user->getPassword();
                if (!empty($password)) {
                    $plainPassword = $user->getPlainPassword();
                    if (!empty($plainPassword)) {
                        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                        $user->setPassword($encoder->encodePassword($plainPassword, $user->getSalt()));
                    }
                    //TODO verifirer unicité codebu et login
                    $em->flush();
                    $this->get('session')->getFlashBag()->add(
                            'notice', 'L\'utilisateur ' . $user->getName() . ' ' . $user->getFirstname() . ' a été modifié.'
                    );
                    return $this->redirect($this->generateUrl('caesar_admin_user_homepage'));
                } else {
                    $this->get('session')->getFlashBag()->add(
                            'erreur', 'Le mot de passe ne peut pas être vide.'
                    );
                }
            }
        }

        return $this->render('CaesarAdminBundle:User:update.html.twig', array(
                    'form' => $form->createView(), 'user' => $id
                ));
    }

    public function deleteAction($id) {
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException('L\'identifiant ' . $id . ' n\'est pas valide.');
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $user = $em->getRepository('CaesarUserBundle:User')
                    ->find($clean);
        }

        if (!$user) {
            throw $this->createNotFoundException('Produit non trouvé avec id ' . $id);
        }

        $em->remove($user);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', 'L\'utilisateur ' . $user->getName() . ' ' . $user->getFirstname() . ' a été supprimé.'
        );

        return $this->render('CaesarAdminBundle:User:delete.html.twig');
    }

}

?>
