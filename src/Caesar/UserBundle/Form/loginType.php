<?php

namespace Caesar\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/**
 * Description of loginType
 *
 * @author David
 */
class loginType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("login", 'text', array('label' => 'form.login.type.label.login'))
                ->add("motDePasse", "password", array('label' => 'form.login.type.label.password'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array('data_class' => "Caesar\UserBundle\Entity\User"));
    }

    public function getName() {
        return "caesar_userBundle_loginType";
    }
}

?>
