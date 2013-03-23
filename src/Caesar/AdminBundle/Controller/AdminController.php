<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller {

  public function indexAction() {
    return $this->render('CaesarAdminBundle:Admin:index.html.twig');
  }

   public function passwordAction() {
    return $this->render('CaesarAdminBundle:Admin:password.html.twig');
  }

   public function webminingAction() {
    return $this->render('CaesarAdminBundle:Admin:webmining.html.twig');
  }

   public function createBackupAction() {
    return $this->render('CaesarAdminBundle:Admin:createBackup.html.twig');
  }

   public function loadBackupAction() {
    return $this->render('CaesarAdminBundle:Admin:loadBackup.html.twig');
  }

}