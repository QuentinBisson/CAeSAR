<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Caesar\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoadBackupType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('fileName', 'file', array('label' => 'form.backup.load.label'));
    }

    public function getName() {
        return 'LoadBackupType';
    }

}

?>
