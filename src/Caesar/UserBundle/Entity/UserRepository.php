<?php

namespace Caesar\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserRepository extends EntityRepository implements UserProviderInterface {

    public function loadUserByUsername($username) {
        $q = $this->createQueryBuilder('u')
                ->where('u.username = :username')
                ->setParameter('username', $username)
                ->orWhere('u.codeBu = :codeBu')
                ->setParameter('codeBu', $username)
                ->getQuery();
        $user = $q->getOneOrNullResult();
        if ($user == null) {
            throw new UsernameNotFoundException(sprintf('Unable to find an active admin CaesarUserBundle:User object identified by "%s".', $username), null, 0);
        }
        return $user;
    }

    public function authenticate($username, $password) {
        $q = $this->createQueryBuilder('u')
                ->where('u.username = :username')
                ->setParameter('username', $username)
                ->orWhere('u.codeBu = :codeBu')
                ->setParameter('codeBu', $username)
                ->andWhere('u.password = :password')
                ->setParameter('password', $password)
                ->getQuery();
        $user = $q->getOneOrNullResult();
        return $user;
    }

    public function refreshUser(UserInterface $user) {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }

        return $this->find($user->getId());
    }

    public function supportsClass($class) {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }

    public function getUserFromToSortBy($page, $sort, $direction, $keywords = array()) {
        $nb_per_page = 10;
        $min = ($page - 1) * $nb_per_page;
        $qb = $this->createQueryBuilder('u');
        $qb->where("u.role = 'ROLE_USER'")
                ->orderBy('u.' . $sort, $direction)
                ->setFirstResult($min)
                ->setMaxResults($nb_per_page);
        if (!empty($keywords)) {
            $iteration = 0;
            foreach ($keywords as $string) {
                if ($iteration > 0) {
                    $qb->andWhere("u.username like :user" . $iteration . " OR u.name like :name" . $iteration . " OR u.firstname like :first" . $iteration);
                } else {
                    $qb->andWhere("u.username like :user" . $iteration . " OR u.name like :name" . $iteration . " OR u.firstname like :first" . $iteration);
                }
                $qb->setParameter('user' . $iteration, '%' . $string . '%');
                $qb->setParameter('name' . $iteration, '%' . $string . '%');
                $qb->setParameter('first' . $iteration, '%' . $string . '%');
                ++$iteration;
            }
        }

        return $qb->getQuery()->getResult();
    }

    public function count($keywords = array()) {
        $qb = $this->createQueryBuilder('u');
        $qb->select('count(u.id)')
                ->where("u.role = 'ROLE_USER'");
        if (!empty($keywords)) {
            $iteration = 0;
            foreach ($keywords as $string) {
                if ($iteration > 0) {
                    $qb->andWhere("u.username like :user" . $iteration . " OR u.name like :name" . $iteration . " OR u.firstname like :first" . $iteration);
                } else {
                    $qb->andWhere("u.username like :user" . $iteration . " OR u.name like :name" . $iteration . " OR u.firstname like :first" . $iteration);
                }
                $qb->setParameter('user' . $iteration, '%' . $string . '%');
                $qb->setParameter('name' . $iteration, '%' . $string . '%');
                $qb->setParameter('first' . $iteration, '%' . $string . '%');
                ++$iteration;
            }
        }
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findAllInArray() {
        $qb = $this->createQueryBuilder('u');
        $qb->select();
        return $qb->getQuery()->getArrayResult();
    }

}
