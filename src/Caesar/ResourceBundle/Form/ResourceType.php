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
class ResourceType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("code", 'integer', array('label' => 'form.resource.type.label.code'))
                ->add("description", "text", array('label' => 'form.resource.type.label.description'))
                ->add("longDescription", "textarea", array('label' => 'form.resource.type.label.long.description'))
                ->add("quantity", 'integer', array('label' => 'form.resource.type.quantity'))
                ->add("image", "file", array('label' => 'form.resource.type.image'))
                ->add('shelf', 'entity', array(
                    'class' => 'CaesarShelfBundle:Shelf',
                    'property' => 'name',
                    'label'=> 'form.resource.type.label.shelf'
                 ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
                array('data_class' => "Caesar\ResourceBundle\Entity\Resource"));
    }

    public function getName() {
        return "caesar_resourceBundle_resourceType";
    }

}

?>
