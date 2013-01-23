<?php

namespace Caesar\WebMiningBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CaesarWebMiningBundle:Default:index.html.twig', array('name' => $name));
    }
}
