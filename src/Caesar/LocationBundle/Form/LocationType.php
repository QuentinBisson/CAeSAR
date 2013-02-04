<?php

namespace Caesar\LocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of LocationType
 *
 * @author David
 */
class LocationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("name", 'text', array('label' => 'form.location.type.label.name', 'trim' => true))
                ->add("description", 'textarea', array('label' => 'form.location.type.label.description', 'trim' => true));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array('data_class' => "Caesar\LocationBundle\Entity\Location"));
    }

    public function getName() {
        return "caesar_locationBundle_locationType";
    }

}

?>
