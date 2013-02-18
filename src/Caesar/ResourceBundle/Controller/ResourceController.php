<?php

namespace Caesar\ResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CaesarResourceBundle:Resource:index.html.twig');
    }
    
    public function consultAction()
    {
        return $this->render('CaesarResourceBundle:Resource:consultation.html.twig');
    }
}
