<?php

namespace Caesar\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SubscriptionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("active_subscription", 'checkbox', array('label' => 'form.subscription.active', 'required' => false));
    }

    public function getName() {
        return "";
    }

}