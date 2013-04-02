<?php

namespace Caesar\ResourceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of ResourceType
 *
 * @author David
 */
class ResourceSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("keywords", 'search', array('label' => 'form.resource.type.label.search', 'trim' => true, 'required' => false));
    }

    public function getName() {
        return "caesar_resourceBundle_resourceSearchType";
    }

}