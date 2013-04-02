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
        $builder->add("code", 'text', array('label' => 'form.resource.type.label.code'))
                ->add("description", "text", array('label' => 'form.resource.type.label.description'))
                ->add("longDescription", "textarea", array('label' => 'form.resource.type.label.long.description', 'required' => false))
                ->add("quantity", 'integer', array('label' => 'form.resource.type.label.quantity'))
                ->add("local", "file", array('label' => 'form.resource.type.label.local', 'required' => false))
                ->add("url", "url", array('label' => 'form.resource.type.label.url', 'required' => false))
                ->add("path", "hidden", array('required' => false))
                ->add('shelf', 'entity', array(
                    'class' => 'CaesarShelfBundle:Shelf',
                    'property' => 'name',
                    'label'=> 'form.resource.type.label.shelf',
                    'empty_value' => 'form.resource.choose'
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