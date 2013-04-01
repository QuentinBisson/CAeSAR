<?php

namespace Caesar\AdminBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class CaesarAdminToken extends AbstractToken {

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