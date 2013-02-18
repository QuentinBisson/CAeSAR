<?php

namespace Caesar\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Caesar\UserBundle\Entity\User;
use Caesar\UserBundle\Form\UserType;
use Caesar\UserBundle\Form\UserHandler;

class UserController extends Controller
{ 
    public function indexAction()
    {
        return $this->render('CaesarUserBundle:User:index.html.twig');
    }
    
    public function searchAction()
    {
    	return $this->render('CaesarUserBundle:User:search.html.twig');
    }
    
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'CaesarUserBundle:User:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }
    
    public function registerAction()
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $formHandler = new UserHandler($form, $this->get('request'), $this->get('doctrine')->getEntityManager(), $this->get('security.encoder_factory')->getEncoder($user));
        if ($formHandler->process()) {
            $this->get('session')->setFlash('success', 'Inscription réussie');
            return $this->redirect($this->generateUrl('caesar_client_homepage'));
        }
        return $this->render('CaesarUserBundle:User:register.html.twig', array('form' => $form->createView()));
    }
    
    public function profileAction()
    {
        return $this->render('CaesarUserBundle:User:profile.html.twig');
    }
}
