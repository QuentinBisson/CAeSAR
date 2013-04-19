<?php

namespace Caesar\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ReservationDeleteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('reservationDate', 'date', array(
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            'label' => 'form.reservation.type.label.date',
            'attr' => array('class' => 'date')
        ));
    }

    public function getName() {
        return "caesar_adminBundle_reservationDeleteType";
    }

}