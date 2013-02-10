<?php

namespace Caesar\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        return $this->render('CaesarUserBundle:User:login.html.twig');
    }
    
    public function registerAction()
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $formHandler = new UserHandler($form, $this->get('request'), $this->get('doctrine')->getEntityManager());
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
