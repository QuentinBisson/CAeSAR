<?php

namespace Caesar\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        return $this->render('CaesarUserBundle:User:register.html.twig');
    }
    
    public function profileAction()
    {
        return $this->render('CaesarUserBundle:User:profile.html.twig');
    }
}
