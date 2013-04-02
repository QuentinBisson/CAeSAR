<?php

namespace Caesar\UserBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class CaesarUserToken extends AbstractToken {

  private $identified;

    public function __construct(array $roles = array()) {
        parent::__construct($roles);
        $this->setAuthenticated(count($roles) > 0);
        $this->identified = false;
    }

    public function getCredentials() {
        return '';
    }

}