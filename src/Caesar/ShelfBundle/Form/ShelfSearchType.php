<?php

namespace Caesar\ShelfBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of ShelfType
 *
 * @author David
 */
class ShelfSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("keywords", 'search', array('label' => 'form.shelf.type.label.search', 'trim' => true, 'required' => false));
    }

    public function getName() {
        return "caesar_shelfBundle_shelfSearchType";
    }

}

?>
