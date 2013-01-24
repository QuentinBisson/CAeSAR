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
        $builder
                ->add("login")
                ->add("motDePasse", "password")
                ->add("email")
                ->add("nom")
                ->add("prenom");
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
