<?php

namespace Caesar\UserBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Caesar\UserBundle\Entity\User;

class UserProfileHandler {

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
        $password = $user->getPassword();
        if (!empty($password)) {
            $plainPassword = $user->getPlainPassword();
            if (!empty($plainPassword)) {
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $user->setPassword($encoder->encodePassword($plainPassword, $user->getSalt()));
            }
        }
        $this->em->flush();
    }

}
