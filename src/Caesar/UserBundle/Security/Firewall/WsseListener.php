<?php

namespace Caesar\UserBundle\Security\Firewall;

use Caesar\UserBundle\Security\Authentication\Token\CaesarUserToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Http\Firewall\AbstractAuthenticationListener;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Security\Http\Session\SessionAuthenticationStrategyInterface;

class WsseListener extends AbstractAuthenticationListener {

  public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager, SessionAuthenticationStrategyInterface $sessionStrategy, HttpUtils $httpUtils, $httpKernel, $options = array()) {
    parent::__construct(
      $securityContext, $authenticationManager, $sessionStrategy, $httpUtils, "caesar", new DefaultAuthenticationSuccessHandler($httpUtils, $options), new DefaultAuthenticationFailureHandler($httpKernel, $httpUtils, $options), array_merge(
        array(
          'username_parameter' => 'username',
          'intention' => 'authenticate',
          'post_only' => true
        ), $options));
  }

  protected function attemptAuthentication(Request $request) {
    $matches = explode("=", $request->getContent());
    if (count($matches) != 2 || $matches[0] !== "_username") {
      return null;
    }

    $token = new CaesarUserToken();
    $token->setUser($matches[1]);
    return $this->authenticationManager->authenticate($token);
  }

}