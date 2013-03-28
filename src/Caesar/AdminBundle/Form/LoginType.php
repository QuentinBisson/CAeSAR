<?php

namespace Caesar\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("username", 'text', array('label' => 'form.user.type.label.login', 'trim' => true))
                ->add("plainPassword", "password", array('label' => 'form.user.type.label.password.normal'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array('data_class' => "Caesar\UserBundle\Entity\User"));
    }

    public function getName() {
        return "caesar_adminBundle_loginType";
    }

}

?>
