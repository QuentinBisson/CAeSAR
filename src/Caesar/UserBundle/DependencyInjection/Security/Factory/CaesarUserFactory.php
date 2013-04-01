<?php

namespace Caesar\UserBundle\DependencyInjection\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

class CaesarUserFactory implements SecurityFactoryInterface {

  public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint) {
    $providerId = 'security.authentication.provider.' . $id;
    $container
      ->setDefinition($providerId, new DefinitionDecorator('caesar.security.authentication.provider'));

    $listenerId = 'security.authentication.listener.' . $id;
    $listener = $container->setDefinition($listenerId, new DefinitionDecorator('caesar.security.authentication.listener'));

    return array($providerId, $listenerId, $defaultEntryPoint);
  }

  public function getKey() {
    return 'http_basic';
  }

  public function getPosition() {
    return 'pre_auth';
  }

  public function addConfiguration(NodeDefinition $builder) {

  }

}