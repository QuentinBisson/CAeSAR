<?php

namespace Caesar\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ResourceSkeletonType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("skeleton", 'textarea', array('label' => 'form.resource.type.label.skeleton', 'required' => false));
    }

    public function getName() {
        return "";
    }

}