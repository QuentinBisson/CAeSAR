<?php

namespace Caesar\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Description of ChangePasswordType
 *
 */
class ChangePasswordType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $min8Constraint = new Length(array('min' => 8));
        $notBlankConstraint = new NotBlank();
        $builder->add("currentPassword", 'password', array('label' => 'form.user.type.label.password.current', 'constraints' => $notBlankConstraint))
                ->add("newPassword", 'password', array('label' => 'form.user.type.label.password.new', 'constraints' => array($notBlankConstraint, $min8Constraint)))
                ->add("confirmPassword", 'password', array('label' => 'form.user.type.label.password.confirm', 'constraints' => array($notBlankConstraint, $min8Constraint)));
    }

    public function getName() {
        return "caesar_userBundle_changePasswordType";
    }

}

?>
