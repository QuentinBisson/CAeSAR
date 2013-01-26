<?php

namespace Caesar\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Description of UserRepository
 *
 * @author David
 */
class UserRepository extends EntityRepository {

    public function authentificate($login, $password) {
        $qb = $this->createQueryBuilder('u');
        $qb->where('u.login = :login')
                ->setParameter('login', $login)
                ->andWhere('u.password = :password')
                ->setParameter(':password', $password);
        return $qb->getQuery()->getResult();
    }

    public function identify($login) {
        $qb = $this->createQueryBuilder('u');
        $qb->where('u.login = :login')
                ->setParameter('login', $login);
        return $qb->getQuery()->getResult();
    }

    public function getUserFromToSortBy($page, $sort, $direction) {
        $min = ($page - 1) * 10;
        $max = ($page * 10) - 1;
          //TODO tester count
        
        $qb = $this->createQueryBuilder('u');
        $qb->where('u.role = \'USER\'')
                ->orderBy('u.'. $sort, $direction)
                ->setFirstResult($min)
                ->setMaxResults($max);
         return $qb->getQuery()->getResult();
    }

}

?>
