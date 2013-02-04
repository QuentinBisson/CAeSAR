<?php

namespace Caesar\ResourceBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Description of UserRepository
 *
 * @author David
 */
class ResourceRepository extends EntityRepository {

    public function getResourceFromToSortBy($page, $sort, $direction) {
        $nb_per_page = 10;
        $min = ($page - 1) * $nb_per_page;
        $qb = $this->createQueryBuilder('r');
        $qb->orderBy('r.' . $sort, $direction)
                ->setFirstResult($min)
                ->setMaxResults($nb_per_page);
        return $qb->getQuery()->getResult();
    }

    public function count() {
        $qb = $this->createQueryBuilder('r');
        $qb->select('count(r.id)');
        return $qb->getQuery()->getSingleScalarResult();
    }

}

?>
