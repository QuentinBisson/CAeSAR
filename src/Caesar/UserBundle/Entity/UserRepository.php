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

    public function identificate($login) {
        $qb = $this->createQueryBuilder('u');
        $qb->where('u.login = :login')
                ->setParameter('login', $login);
        return $qb->getQuery()->getResult();
    }

}

?>
