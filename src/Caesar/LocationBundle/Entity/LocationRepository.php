<?php

namespace Caesar\LocationBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Description of UserRepository
 *
 * @author David
 */
class LocationRepository extends EntityRepository {

    public function getLocationFromToSortBy($page, $sort, $direction) {
        $nb_per_page = 10;
        $min = ($page - 1) * $nb_per_page;
        $qb = $this->createQueryBuilder('l');
        $qb->orderBy('l.' . $sort, $direction)
                ->setFirstResult($min)
                ->setMaxResults($nb_per_page);
        return $qb->getQuery()->getResult();
    }

    public function count() {
        $qb = $this->createQueryBuilder('l');
        $qb->select('count(l.id)');
        return $qb->getQuery()->getSingleScalarResult();
    }

}

?>
