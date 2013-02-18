<?php

namespace Caesar\ResourceBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Description of UserRepository
 *
 * @author David
 */
class ResourceRepository extends EntityRepository {

    public function getResourceFromToSortBy($page, $sort, $direction, $keywords) {
        $nb_per_page = 10;
        $min = ($page - 1) * $nb_per_page;
        $qb = $this->createQueryBuilder('r');
        $qb->orderBy('r.' . $sort, $direction)
                ->setFirstResult($min)
                ->setMaxResults($nb_per_page);
        if (!empty($keywords)) {
            $iteration = 0;
            foreach ($keywords as $string) {
                if ($iteration > 0) {
                    $qb->andWhere("r.description like :desc" . $iteration . " OR r.longDescription like :long" . $iteration);
                } else {
                    $qb->where("r.description like :desc" . $iteration . " OR r.longDescription like :long" . $iteration);
                }
                $qb->setParameter('desc' . $iteration, '%' . $string . '%');
                $qb->setParameter('long' . $iteration, '%' . $string . '%');
                ++$iteration;
            }
        }
        return $qb->getQuery()->getResult();
    }

    public function count() {
        $qb = $this->createQueryBuilder('r');
        $qb->select('count(r.id)');
        return $qb->getQuery()->getSingleScalarResult();
    }

}

?>
