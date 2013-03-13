<?php

namespace Caesar\UserBundle\Security\Authentication\Provider;

use Caesar\UserBundle\Security\Authentication\Token\WsseUserToken;
use Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class CaesarUserAuthentificationProvider extends DaoAuthenticationProvider {

  private $userProvider;

  public function __construct(UserProviderInterface $userProvider, UserCheckerInterface $userChecker = null, EncoderFactoryInterface $encoderFactory = null, $hideUserNotFoundExceptions = true) {
    parent::__construct($userProvider, $userChecker, "caesar", $encoderFactory, $hideUserNotFoundExceptions);
    $this->userProvider = $userProvider;
  }

  protected function checkAuthentication(UserInterface $user, UsernamePasswordToken $token) {
    $user = $this->userProvider->loadUserByUsername($token->getUsername());

    if ($user) {
      $authenticatedToken = new WsseUserToken($user->getRoles());
      $authenticatedToken->setUser($user);

      return $authenticatedToken;
    }

    throw new AuthenticationException('The authentication failed.');
  }

}