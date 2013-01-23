<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('CaesarAdminBundle:Admin:index.html.twig');
    }
}
