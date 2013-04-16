<?php

namespace Caesar\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class WebminingModuleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add("active_module", 'checkbox', array('label' => 'form.webmining.type.label.active', 'required' => false))
                ->add("authors_key", "text", array('label' => 'form.webmining.type.label.authors'))
                ->add("publisher_key", "text", array('label' => 'form.webmining.type.label.publisher'))
                ->add("published_date_key", "text", array('label' => 'form.webmining.type.label.published_date'))
                ->add("categories_key", "text", array('label' => 'form.webmining.type.label.categories'))
                ->add("language_key", "text", array('label' => 'form.webmining.type.label.language'))
                ->add("description_key", "text", array('label' => 'form.webmining.type.label.description'))
                ->add("page_count_key", "text", array('label' => 'form.webmining.type.label.page_count'))
                ->add("google_books_url", "url", array('label' => 'form.webmining.type.label.google_books_url'));
    }

    public function getName() {
        return "";
    }

}