<?php
namespace Caesar\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $q = $this->createQueryBuilder('u')
                ->where('u.username = :username')
                ->setParameter('username', $username)
                ->orWhere('u.codeBU = :codeBu')
                ->setParameter('cdeBu', $username)
                ->getQuery();
        try {
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            throw new UsernameNotFoundException(sprintf('Unable to find an active admin CaesarUserBundle:User object identified by "%s".', $username), null, 0, $e);
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
    
    public function getUserFromToSortBy($page, $sort, $direction) {
        $nb_per_page = 10;
        $min = ($page - 1) * $nb_per_page;
        $qb = $this->createQueryBuilder('u');
        $qb->where("u.role = 'USER'")
                ->orderBy('u.' . $sort, $direction)
                ->setFirstResult($min)
                ->setMaxResults($nb_per_page);
        return $qb->getQuery()->getResult();
    }

    public function count() {
        $qb = $this->createQueryBuilder('u');
        $qb->select('count(u.id)')
                ->where("u.role = 'USER'");
        return $qb->getQuery()->getSingleScalarResult();
    }

}
