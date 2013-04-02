<?php

namespace Caesar\ShelfBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of ShelfType
 *
 * @author David
 */
class ShelfType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("name", 'text', array('label' => 'form.shelf.type.label.name', 'trim' => true))
                ->add("description", 'textarea', array('label' => 'form.shelf.type.label.description', 'trim' => true));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array('data_class' => "Caesar\ShelfBundle\Entity\Shelf"));
    }

    public function getName() {
        return "caesar_shelfBundle_shelfType";
    }

}

?>
