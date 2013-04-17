<?php

namespace Caesar\TagBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FormatRepository extends EntityRepository {

    public function findAllInArray() {
        $qb = $this->createQueryBuilder('u');
        $qb->select();
        return $qb->getQuery()->getArrayResult();
    }

}
