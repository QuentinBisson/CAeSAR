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
    $builder
      ->add("code", 'text', array('label' => 'form.tag.type.label.code', 'required' => false))
      ->add("marginLeft", 'number', array('label' => 'form.tag.type.label.margin.left', 'precision' => 2, 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("marginTop", 'number', array('label' => 'form.tag.type.label.margin.top', 'precision' => 2, 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("horizontalGap", 'number', array('label' => 'form.tag.type.label.gap.horizontal', 'precision' => 2, 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("verticalGap", 'number', array('label' => 'form.tag.type.label.gap.vertical', 'precision' => 2, 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("height", 'number', array('label' => 'form.tag.type.label.height', 'precision' => 2, 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("width", 'number', array('label' => 'form.tag.type.label.width', 'precision' => 2, 'attr' => array('min' => 0, 'step' => 'any')))
      ->add("columns", 'integer', array('label' => 'form.tag.type.label.columns', 'attr' => array('min' => 1)))
      ->add("rows", 'integer', array('label' => 'form.tag.type.label.rows', 'attr' => array('min' => 1)));
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver) {
    parent::setDefaultOptions($resolver);
    $resolver->setDefaults(array('data_class' => "Caesar\TagBundle\Entity\Format"));
  }

  public function getName() {
    return "caesar_tagBundle_tagFormattingType";
  }

}