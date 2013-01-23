<?php

namespace Caesar\TagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CaesarTagBundle:Default:index.html.twig', array('name' => $name));
    }
}
