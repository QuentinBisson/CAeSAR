<?php

namespace Caesar\ShelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CaesarShelfBundle:Default:index.html.twig', array('name' => $name));
    }
}
