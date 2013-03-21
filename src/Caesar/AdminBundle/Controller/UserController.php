<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\UserBundle\Form\UserSearchType;
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

  /**
   * Lister les utilisateurs gérés dans l'application
   *
   * @param type $page
   * @param type $sort
   * @param type $direction
   * @return type
   */
  public function indexAction($page = 1, $sort = 'codeBu', $direction = 'asc') {
    $nb_per_page = 10; // Nombre d'éléments affichés par page (pour la pagination)
    $searchForm = $this->createForm(new UserSearchType());
    $keywords = null;
    $em = $this->getDoctrine()->getManager();

    $repository_resource = $em->getRepository('CaesarUserBundle:User');

    $request = $this->get('request');
    if ($request->isMethod('POST')) {
      $searchForm->bind($request);
      if ($searchForm->isValid()) {
        $data = $searchForm->getData();
        $keywords = $data['keywords'];
      }
    }
    if (!empty($keywords)) {
      $keywords = explode(" ", $keywords);
    }

    $users = $repository_resource->getUserFromToSortBy($page, $sort, $direction, $keywords);
    $count = $repository_resource->count($keywords);

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

    if ($request->isXmlHttpRequest()) {
      return $this->render("CaesarAdminBundle:User:list.html.twig", $array);
    }

    $array['searchForm'] = $searchForm->createView();

    return $this->render("CaesarAdminBundle:User:index.html.twig", $array);
  }

  /**
   * Action permettant de gérer l'ajout d'un utilisateur
   * @return type
   */
  public function addAction() {
    $em = $this->getDoctrine()->getEntityManager();
    $translator = $this->get('translator');
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
          'notice', $translator->trans('admin.form.users.notice.add', array('%user%' => $user->getName() . ' ' . $user->getFirstname()))
        );
        return $this->redirect($this->generateUrl('caesar_admin_user_homepage'));
      }
    }

    return $this->render('CaesarAdminBundle:User:add.html.twig', array(
          'form' => $form->createView(),
      ));
  }

  /**
   * Action permettant de gérer la mise à jour d'un utilisateur
   *
   * @param type $id
   * @return type
   * @throws type
   */
  public function updateAction($id) {
    $translator = $this->get('translator');
    if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
      $clean = $id;
    } else {
      throw $this->createNotFoundException($translator->trans('admin.form.users.exception', array('%user%' => $id)));
    }

    $em = $this->getDoctrine()->getManager();
    if (isset($clean)) {
      $user = $em->getRepository('CaesarUserBundle:User')
        ->find($clean);
    }

    if (!$user) {
      throw $this->createNotFoundException($translator->trans('admin.form.users.exception', array('%user%' => $id)));
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
            'notice', $translator->trans('admin.form.users.notice.update', array('%user%' => $user->getName() . ' ' . $user->getFirstname()))
          );
          return $this->redirect($this->generateUrl('caesar_admin_user_homepage'));
        } else {
          $this->get('session')->getFlashBag()->add(
            'erreur', $translator->trans('admin.form.users.password.not_empty')
          );
        }
      }
    }

    return $this->render('CaesarAdminBundle:User:update.html.twig', array(
          'form' => $form->createView(), 'user' => $id
      ));
  }

  /**
   * Action permettant de gérer la suppression d'un utilisateur
   *
   * @param type $id
   * @return type
   * @throws type
   */
  public function deleteAction($id) {
    $translator = $this->get('translator');
    if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
      $clean = $id;
    } else {
      throw $this->createNotFoundException($translator->trans('admin.form.users.exception', array('%user%' => $id)));
    }

    $em = $this->getDoctrine()->getManager();
    if (isset($clean)) {
      $user = $em->getRepository('CaesarUserBundle:User')
        ->find($clean);
    }

    if (!$user) {
      throw $this->createNotFoundException($translator->trans('admin.form.users.exception', array('%user%' => $id)));
    }

    $em->remove($user);
    $em->flush();

    $this->get('session')->getFlashBag()->add(
      'notice', $translator->trans('admin.form.users.notice.delete', array('%user%' => $user->getName() . ' ' . $user->getFirstname()))
    );

    return $this->render('CaesarAdminBundle:User:delete.html.twig');
  }

}