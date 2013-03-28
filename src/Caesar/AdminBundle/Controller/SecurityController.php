<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Caesar\AdminBundle\Form\LoginType;
use Caesar\AdminBundle\Form\LoginHandler;

class SecurityController extends Controller {

    public function loginAction() {
        $form = $this->createForm(new LoginType());
        return $this->render('CaesarAdminBundle:Security:login.html.twig', array(
                    'form' => $form->createView()
                ));
    }

}
