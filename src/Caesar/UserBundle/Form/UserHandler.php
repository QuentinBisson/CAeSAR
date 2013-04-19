<?php

namespace Caesar\UserBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Caesar\UserBundle\Entity\User;

class UserHandler {

    protected $form;
    protected $request;
    protected $em;
    protected $encoder;

    public function __construct(Form $form, Request $request, EntityManager $em, $encoder) {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
        $this->encoder = $encoder;
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

    public function onSuccess(User $user) {
        $user->setPassword($this->encoder->encodePassword($user->getPlainPassword(), $user->getSalt()));
        $user->setRole('ROLE_USER');
        $this->em->persist($user);
        $this->em->flush();
    }

}

?>
