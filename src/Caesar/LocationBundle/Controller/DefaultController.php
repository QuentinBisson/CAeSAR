<?php

namespace Caesar\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CaesarLocationBundle:Default:index.html.twig', array('name' => $name));
    }
}
