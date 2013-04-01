<?php

namespace Caesar\UserBundle;

use Caesar\UserBundle\DependencyInjection\Security\Factory\CaesarUserFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CaesarUserBundle extends Bundle {

  public function build(ContainerBuilder $container) {
    parent::build($container);
    $extension = $container->getExtension('security');
    $extension->addSecurityListenerFactory(new CaesarUserFactory());
  }

}
