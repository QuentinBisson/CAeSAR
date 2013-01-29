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
        $qb->where('u.login = :login or u.codeBu = :login2')
                ->setParameters(array('login' => $login, 'login2' => $login))
                ->andWhere('u.motDePasse = :password')
                ->setParameter('password', $password);
        return $qb->getQuery()->getResult();
    }

    public function identify($login) {
        $qb = $this->createQueryBuilder('u');
        $qb->where('u.login = :login')
                ->setParameter('login', $login)
                ->orWhere('u.codeBU = :login')
                ->setParameter('login', $login);
        return $qb->getQuery()->getResult();
    }

    public function getUserFromToSortBy($page, $sort, $direction) {
        $min = ($page - 1) * 10;
        $max = ($page * 10) - 1;
        //TODO tester count

        $qb = $this->createQueryBuilder('u');
        $qb->where('u.role = \'USER\'')
                ->orderBy('u.' . $sort, $direction)
                ->setFirstResult($min)
                ->setMaxResults($max);
        return $qb->getQuery()->getResult();
    }

    public function count() {
        $qb = $this->createQueryBuilder('u');
        $qb->select('count(u.id)')
                ->where('u.role = \'USER\'');
        return $qb->getQuery()->getSingleScalarResult();
    }

}

?>
