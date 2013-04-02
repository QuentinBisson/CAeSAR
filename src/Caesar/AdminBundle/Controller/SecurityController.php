<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\AdminBundle\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller {

  public function loginAction() {
    $request = $this->getRequest();
    $translator = $this->get('translator');
    $session = $request->getSession();
    $security = $this->get('security.context');
    $form = $this->createForm(new LoginType());

    if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
      if ($security->isGranted('ROLE_ADMIN')) {
        return $this->redirect($this->generateUrl('caesar_admin_homepage'));
      }
    }

    // get the login error if there is one
    if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
      $error = $request->attributes->get(
        SecurityContext::AUTHENTICATION_ERROR
      );
    } else {
      $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
      $session->remove(SecurityContext::AUTHENTICATION_ERROR);
    }

    return $this->render('CaesarAdminBundle:Security:login.html.twig', array(
          'form' => $form->createView(),
          'error' => $error
      ));
  }

}
