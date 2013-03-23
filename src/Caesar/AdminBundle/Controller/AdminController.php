<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\UserBundle\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller {

  public function indexAction() {
    return $this->render('CaesarAdminBundle:Admin:index.html.twig');
  }

  public function passwordAction() {
    $translator = $this->get('translator');
    $user = $this->get('security.context')->getToken()->getUser();
    $form = $this->createForm(new ChangePasswordType());

    $request = $this->get('request');
    if ($request->isMethod('POST')) {
      $form->bind($request);
      if ($form->isValid()) {
        $data = $form->getData();

        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $encoded = $encoder->encodePassword($data['currentPassword'], $user->getSalt());
        if ($encoded === $user->getPassword()) {
          if ($data['newPassword'] === $data['confirmPassword']) {
            //handle data
            $newPassword = $encoder->encodePassword($data['newPassword'], $user->getSalt());
            $em = $this->getDoctrine()->getManager();
            $userInDB = $em->getRepository('CaesarUserBundle:User')->find($user->getId());
            $user->setPassword($newPassword);
            $userInDB->setPassword($newPassword);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
              'notice', $translator->trans('admin.form.users.notice.password.changed')
            );
            return $this->redirect($this->generateUrl('caesar_admin_homepage'));
          } else {
            $this->get('session')->getFlashBag()->add(
              'error', $translator->trans('admin.form.users.password.not_same')
            );
          }
        } else {
          $this->get('session')->getFlashBag()->add(
            'error', $translator->trans('admin.form.users.password.no_match')
          );
        }
      }
    }

    return $this->render('CaesarAdminBundle:Admin:password.html.twig', array('form' => $form->createView()));
  }

  public function webminingAction() {
    return $this->render('CaesarAdminBundle:Admin:webmining.html.twig');
  }

  public function createBackupAction() {
    return $this->render('CaesarAdminBundle:Admin:createBackup.html.twig');
  }

  public function loadBackupAction() {
    return $this->render('CaesarAdminBundle:Admin:loadBackup.html.twig');
  }

}