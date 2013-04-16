<?php

namespace Caesar\UserBundle\Security\Authentication\Provider;

use Caesar\UserBundle\Security\Authentication\Token\CaesarUserToken;
use Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class CaesarUserAuthentificationProvider extends DaoAuthenticationProvider {

  public function __construct(UserProviderInterface $userProvider, UserCheckerInterface $userChecker = null, EncoderFactoryInterface $encoderFactory = null, $hideUserNotFoundExceptions = true) {
    parent::__construct($userProvider, $userChecker, "caesar", $encoderFactory, $hideUserNotFoundExceptions);
    $this->userProvider = $userProvider;
    $this->encoderFactory = $encoderFactory;
  }

  protected function checkAuthentication(UserInterface $userInterface, UsernamePasswordToken $token) {
    $user = $this->userProvider->loadUserByUsername($token->getUsername());
    if ($user) {
      if (!in_array('ROLE_ADMIN', $user->getRoles())) {
        $authenticatedToken = new CaesarUserToken($user->getRoles());
        $authenticatedToken->setUser($user);
        $user->setIdentified(true);
        if ($token->getCredentials() != null && $token->getCredentials() != "" && $user->getPassword() === $token->getCredentials()) {
			$user->setAuthentified(true);
		}
        return $authenticatedToken;
      } else {
        throw new AuthenticationException('Un administrateur ne peut accéder ....');
      }
    }
    throw new AuthenticationException('The authentication failed.');
  }

}
