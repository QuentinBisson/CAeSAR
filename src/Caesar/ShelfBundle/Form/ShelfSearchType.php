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
class ShelfSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("searchShelf", 'search', array('label' => 'form.shelf.type.label.search', 'trim' => true));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array('data_class' => "Caesar\ShelfBundle\Entity\Shelf"));
    }

    public function getName() {
        return "caesar_shelfBundle_shelfSearchType";
    }

}

?>
