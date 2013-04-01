<?php

namespace Caesar\AdminBundle;

use Caesar\AdminBundle\DependencyInjection\Security\Factory\CaesarUserFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CaesarAdminBundle extends Bundle {

  public function build(ContainerBuilder $container) {
    parent::build($container);
    $extension = $container->getExtension('security');
    $extension->addSecurityListenerFactory(new CaesarUserFactory());
  }

}
