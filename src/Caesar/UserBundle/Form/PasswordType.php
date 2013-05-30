<?php

namespace Caesar\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of PasswordType
 *
 * @author David
 */
class PasswordType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("plainPassword", 'password', array('label' => 'form.password.type.label.password'));
    }

    public function getName() {
        return "caesar_userBundle_passwordType";
    }

}

?>
