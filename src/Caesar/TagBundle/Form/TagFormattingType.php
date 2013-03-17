<?php

namespace Caesar\TagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of TagFormattingType
 *
 * @author David
 */
class TagFormattingType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add("marginLeft", 'text', array('label' => 'form.tag.type.label.margin.left', 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("marginTop", 'text', array('label' => 'form.tag.type.label.margin.top', 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("horizontalGap", 'text', array('label' => 'form.tag.type.label.gap.horizontal', 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("verticalGap", 'text', array('label' => 'form.tag.type.label.gap.vertical', 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("height", 'text', array('label' => 'form.tag.type.label.height', 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("width", 'text', array('label' => 'form.tag.type.label.width', 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("columns", 'integer', array('label' => 'form.tag.type.label.columns', 'attr' => array('min' => 1)))
      ->add("rows", 'integer', array('label' => 'form.tag.type.label.rows', 'attr' => array('min' => 1)));
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    parent::setDefaultOptions($resolver);
    $resolver->setDefaults(array('data_class' => "Caesar\TagBundle\Form\Entity\Format"));
  }

  public function getName() {
    return "caesar_tagBundle_tagFormattingType";
  }

}