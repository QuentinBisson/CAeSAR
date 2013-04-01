<?php

namespace Caesar\AdminBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class AdminHandler {

  protected $form;
  protected $request;
  protected $em;

  public function __construct(Form $form, Request $request, EntityManager $em) {
    $this->form = $form;
    $this->request = $request;
    $this->em = $em;
  }

  public function process() {
    if ($this->request->getMethod() == 'POST') {
      $this->form->bindRequest($this->request);
      if ($this->form->isValid()) {
        $this->onSuccess($this->form->getData());
        return true;
      }
    }
    return false;
  }

  public function onSuccess($data) {
      // Login process
  }

}

?>
