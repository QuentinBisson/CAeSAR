<?php

namespace Caesar\ResourceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of UserType
 *
 * @author David
 */
class BorrowingSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("archived", 'checkbox ', array('label' => 'form.borrowings.type.label.archived'))
                ->add("userDisplay", "entity", array('required' => false, 'read_only' => true, 'label' => 'form.borrowings.type.label.user'))
                ->add("resourceDisplay", "text", array('required' => false, 'read_only' => true, 'label' => 'form.borrowings.type.label.resource'))
                ->add("user", "hidden", array('required' => false))
                ->add('resource', 'hidden', array('required' => false));
    }

    public function getName() {
        return "caesar_userBundle_borrowingSearchType";
    }

}

?>
