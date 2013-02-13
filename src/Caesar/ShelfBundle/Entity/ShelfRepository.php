<?php

namespace Caesar\ShelfBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Description of UserRepository
 *
 * @author David
 */
class ShelfRepository extends EntityRepository {

    public function getShelfFromToSortBy($page, $sort, $direction, $keywords) {
        $nb_per_page = 10;
        $min = ($page - 1) * $nb_per_page;
        $qb = $this->createQueryBuilder('s');
        $qb->orderBy('s.' . $sort, $direction)
                ->setFirstResult($min)
                ->setMaxResults($nb_per_page);

        if (!empty($keywords)) {
            $iteration = 0;
            foreach ($keywords as $string) {
                if ($iteration > 0) {
                    $qb->andWhere("(UPPER(s.name) like UPPER(:name" . $iteration . ")) OR (UPPER(s.description) like UPPER(:desc" . $iteration . "))");
                } else {
                    $qb->where("(UPPER(s.name) like UPPER(:name" . $iteration . ")) OR (UPPER(s.description) like UPPER(:desc" . $iteration . "))");
                }
                $qb->setParameter('name' . $iteration, '%' . $string . '%');
                $qb->setParameter('desc' . $iteration, '%' . $string . '%');
                ++$iteration;
            }
        }
        return $qb->getQuery()->getResult();
    }

    public function count() {
        $qb = $this->createQueryBuilder('s');
        $qb->select('count(s.id)');
        return $qb->getQuery()->getSingleScalarResult();
    }

}

?>
