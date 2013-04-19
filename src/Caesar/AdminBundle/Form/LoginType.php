<?php

namespace Caesar\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("_username", 'text', array('label' => 'form.user.type.label.login', 'trim' => true))
                ->add("_password", "password", array('label' => 'form.user.type.label.password.normal'));
    }

    public function getName() {
        return "";
    }

}