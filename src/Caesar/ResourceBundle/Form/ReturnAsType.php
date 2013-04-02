<?php

namespace Caesar\ResourceBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of UserType
 *
 * @author David
 */
class ReturnAsType extends AbstractType {

  private $resource;

  function __construct($resource) {
    $this->resource = $resource;
  }

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $users = array();
    foreach ($this->resource->getBorrowings() as $b) {
      array_push($users, $b->getUser()->getId());
    }

    $builder->add('user', 'entity', array(
        'class' => 'CaesarUserBundle:User',
        'property' => 'userDescription',
        'label' => 'form.return.type.label.user',
        'empty_value' => 'form.user.choose',
        'query_builder' => function(EntityRepository $er) use ($users) {
          return $er->createQueryBuilder('u')
              ->where('u.id in (:users)')
              ->setParameter('users', $users)
              ->orderBy('u.name', 'ASC');
        }
    ));
  }

  public function getName() {
    return "caesar_resourceBundle_resourceReturnType";
  }

}