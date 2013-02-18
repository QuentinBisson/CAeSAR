<?php

// src/Acme/WebserviceUserBundle/Security/User/WebserviceUserProvider.php
namespace Caesar\UserBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
    public function authentificate($username, $password) {
        $qb = $this->createQueryBuilder('u');
        $qb->where('u.username = :username or u.codeBu = :codeBu')
                ->setParameters(array('username' => $username, 'codeBu' => $username))
                ->andWhere('u.password = :password')
                ->setParameter('password', $password);
        return $qb->getQuery()->getResult();
    }

    public function identify($username) {
        $qb = $this->createQueryBuilder('u');
        $qb->where('u.username = :username')
                ->setParameter('username', $username)
                ->orWhere('u.codeBU = :codeBu')
                ->setParameter('cdeBu', $username);
        return $qb->getQuery()->getResult();
    }
    
    public function loadUserByUsername($username)
    {
        $q = $this
                ->createQueryBuilder('u')
                ->where('u.username = :username OR u.codeBu = :codeBu')
                ->setParameter('username', $username)
                ->setParameter('codeBu', $username)
                ->getQuery()
        ;

        try {
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            throw new UsernameNotFoundException(sprintf('Unable to find an active admin AcmeUserBundle:User object identified by "%s".', $username), null, 0, $e);
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }

        return $this->find($user->getId());
    }

    public function supportsClass($class)
    {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }
}

?>
