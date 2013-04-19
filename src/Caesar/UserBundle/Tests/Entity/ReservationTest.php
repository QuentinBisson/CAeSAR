<?php

namespace Caesar\UserBundle\Tests\Entity;

use Caesar\UserBundle\Entity\User;
use Caesar\UserBundle\Entity\Reservation;
use Caesar\ResourceBundle\Entity\Resource;

class ReservationTest extends \PHPUnit_Framework_TestCase {

    public function testResource() {
        $resource = new Resource();
        $reservation = new Reservation();
        $reservation->setResource($resource);
        $data = $reservation->getResource();

        $this->assertEquals($resource, $data);
    }

    public function testUser() {
        $user = new User();
        $reservation = new Reservation();
        $reservation->setUser($user);
        $data = $reservation->getUser();

        $this->assertEquals($user, $data);
    }

    public function testReservationDate() {
        $date = new \DateTime('now');
        $reservation = new Reservation();
        $reservation->setReservationDate($date);
        $data = $reservation->getReservationDate();

        $this->assertEquals($date, $data);
    }

}
