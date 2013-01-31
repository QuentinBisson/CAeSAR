<?php

namespace Caesar\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of UserType
 *
 * @author David
 */
class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("codeBU", 'integer', array('label' => 'form.user.type.label.codeBu'))
                ->add("nom", 'text', array('label' => 'form.user.type.label.name', 'trim' => true))
                ->add("prenom", 'text', array('label' => 'form.user.type.label.firstname', 'trim' => true))
                ->add("email", "email", array('label' => 'form.user.type.label.email', 'trim' => true))
                ->add("login", 'text', array('label' => 'form.user.type.label.login', 'trim' => true))
                ->add("motDePasse", "password", array('label' => 'form.user.type.label.password.normal'))
                ->add("confirmMotDePasse", "password", array('label' => 'form.user.type.label.password.confirm'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array('data_class' => "Caesar\UserBundle\Entity\User"));
    }

    public function getName() {
        return "caesar_userBundle_userType";
    }

}

?>
