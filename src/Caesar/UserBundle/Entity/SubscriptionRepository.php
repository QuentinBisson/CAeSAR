<?php

namespace Caesar\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SubscriptionRepository
 *
 */
class SubscriptionRepository extends EntityRepository {

    public function findAllInArray() {
        $array_return = array();
        $all = $this->findAll();
        foreach ($all as $one) {
            $tab = array($one->getId(), $one->getResource()->getId(), $one->getUser()->getId());
            array_push($array_return, $tab);
        }
        return $array_return;
    }

}
