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
                    $qb->andWhere('s.name like \'%:name' . $iteration . '%\' OR s.description like \'%:description' . $iteration . '%\'');
                } else {
                    $qb->where('s.name like \'%:name' . $iteration . '%\' OR s.description like \'%:description' . $iteration . '%\'');
                }
                $qb->setParameter('name' . $iteration, $string);
                $qb->setParameter('description' . $iteration, $string);
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

    public function findAllResourcesById($id)
    {
        return $this->getEntityManager()->createQueryBuilder()->select('r')
                ->from('\Caesar\ResourceBundle\Entity\Resource', 'r')
                ->where('r.shelf = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getResult();
    }
}

?>
