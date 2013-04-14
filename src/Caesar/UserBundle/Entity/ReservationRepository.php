<?php

namespace Caesar\UserBundle\Entity;

use DateTime;
use Doctrine\ORM\EntityRepository;

/**
 * ReservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservationRepository extends EntityRepository {

    public function getReservationsFromToSortBy($page, $sort, $direction, $user = null) {
        $nb_per_page = 10;
        $min = ($page - 1) * $nb_per_page;
        $qb = $this->createQueryBuilder('r');
        if ($user != null) {
            $qb->where('r.user = :user');
            $qb->setParameter("user", $user->getId());
        }

        $qb->orderBy('r.' . $sort, $direction)
                ->setFirstResult($min)
                ->setMaxResults($nb_per_page);
        return $qb->getQuery()->getResult();
    }

    public function getOldFromToSortBy(DateTime $date) {
        $qb = $this->createQueryBuilder('r');
        $qb->where('r.reservationDate < :date');
        $qb->setParameter("date", $date);

        return $qb->getQuery()->getResult();
    }

    public function count($user = null) {
        $qb = $this->createQueryBuilder('r');
        $qb->select('count(r.id)');

        if ($user != null) {
            $qb->where('r.user = :user');
            $qb->setParameter("user", $user->getId());
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getPreviousReservations($page, $resource, $user = null) {
        $nb_per_page = 10;
        $min = ($page - 1) * $nb_per_page;

        $qb = $this->createQueryBuilder('r');
        $qb->where('r.resource = :resource');
        $qb->setParameter("resource", $resource);
        if ($user != null) {
            $reservations = $user->getReservations();
            $date = null;
            foreach ($reservations as $r) {
                if ($r->getResource()->getId() == $resource) {
                    $date = $r->getReservationDate();
                }
            }
            if ($date != null) {
                $qb->andWhere('r.reservationDate < :date');
                $qb->setParameter("date", $date);
            }
        }

        $qb->orderBy('r.reservationDate', 'asc')
                ->setFirstResult($min)
                ->setMaxResults($nb_per_page);
        return $qb->getQuery()->getResult();
    }

}
