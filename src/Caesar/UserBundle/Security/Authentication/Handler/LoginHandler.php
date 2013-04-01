<?php

namespace Caesar\UserBundle\Security\Authentication\Handler;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface {

  protected $router;
  protected $security;

  public function __construct(Router $router, SecurityContext $security) {
    $this->router = $router;
    $this->security = $security;
  }

  public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
    $session = $request->getSession();
    if ($this->security->isGranted('ROLE_ADMIN')) {
      $response = new RedirectResponse($this->router->generate('caesar_admin_homepage'));
    } elseif ($this->security->isGranted('ROLE_USER')) {
      $referer_url = $request->headers->get('referer');
      if (strpos($referer_url, 'admin')) {
        $session->getFlashBag()->add(
          'error', "Votre compte ce vous permet pas d'accéder à l'interface d'administration"
        );
      }
      $response = new RedirectResponse($referer_url);
    }
    return $response;
  }

  public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {

    $referer_url = $request->headers->get('referer');
    $response = new RedirectResponse($referer_url);
    $session = $request->getSession();

    $session->set(SecurityContext::AUTHENTICATION_ERROR, $exception);
    return $response;
  }

}