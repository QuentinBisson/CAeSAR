<?php

namespace Caesar\AdminBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Http\Firewall\AbstractAuthenticationListener;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Security\Http\Session\SessionAuthenticationStrategyInterface;

class CaesarAdminListener extends AbstractAuthenticationListener {

    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager, SessionAuthenticationStrategyInterface $sessionStrategy, HttpUtils $httpUtils, $httpKernel, $options = array()) {
        parent::__construct(
                $securityContext, $authenticationManager, $sessionStrategy, $httpUtils, "caesar_admin", new DefaultAuthenticationSuccessHandler($httpUtils, $options), new DefaultAuthenticationFailureHandler($httpKernel, $httpUtils, $options), array_merge(
                        array(
            'username_parameter' => 'username',
            'intention' => 'authenticate',
            'post_only' => true
                        ), $options));
    }

    protected function attemptAuthentication(Request $request) {
        die();
        $matches = explode("=", $request->getContent());
        $split = explode("&", $matches[1]);

        if (count($matches) != 3 || $matches[0] !== "_username" || $split[1] != "_password") {
            return null;
        }

        $token = new UsernamePasswordToken();
        $token->setUser($matches[1]);
        $token->setCredentials($matches[2]);
        return $this->authenticationManager->authenticate($token);
    }

}