<?php

namespace Caesar\TagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of TagFormattingType
 *
 * @author David
 */
class FormatListType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('format', 'entity', array(
        'required' => false,
        'class' => 'CaesarTagBundle:Format',
        'property' => 'code',
        'label' => 'form.tag.type.label.format',
        'empty_value' => 'form.tag.choose'
    ));
    ;
  }

  public function getName() {
    return "caesar_tagBundle_formatListType";
  }

}
