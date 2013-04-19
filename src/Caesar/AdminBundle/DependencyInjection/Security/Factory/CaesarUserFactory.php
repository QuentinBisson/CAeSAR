<?php

namespace Caesar\AdminBundle\DependencyInjection\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

class CaesarUserFactory implements SecurityFactoryInterface {

    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint) {
        $providerId = 'security.authentication.provider.admin.' . $id;
        $container
                ->setDefinition($providerId, new DefinitionDecorator('caesar_admin.security.authentication.provider'));

        $listenerId = 'security.authentication.listener.admin.' . $id;
        $listener = $container->setDefinition($listenerId, new DefinitionDecorator('caesar_admin.security.authentication.listener'));

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