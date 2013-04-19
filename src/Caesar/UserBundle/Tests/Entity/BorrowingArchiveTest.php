<?php

namespace Caesar\UserBundle\Tests\Entity;

use Caesar\UserBundle\Entity\User;
use Caesar\UserBundle\Entity\BorrowingArchive;
use Caesar\ResourceBundle\Entity\Resource;

class BorrowingArchiveTest extends \PHPUnit_Framework_TestCase {

    public function testBorrowingDate() {
        $borrowingarchive = new BorrowingArchive();
        $date = new \DateTime('now');
        $borrowingarchive->setBorrowingDate($date);
        $data = $borrowingarchive->getBorrowingDate();

        $this->assertEquals($date, $data);
    }

    public function testUser() {
        $user = new User();
        $borrowingarchive = new BorrowingArchive();
        $borrowingarchive->setUser($user);
        $data = $borrowingarchive->getUser();

        $this->assertEquals($user, $data);
    }

    public function testResource() {
        $resource = new Resource();
        $borrowingarchive = new BorrowingArchive();
        $borrowingarchive->setResource($resource);
        $data = $borrowingarchive->getResource();

        $this->assertEquals($resource, $data);
    }

    public function testReturnDate() {
        $date = new \DateTime('now');
        $borrowingarchive = new BorrowingArchive();
        $borrowingarchive->setReturnDate($date);
        $data = $borrowingarchive->getReturnDate();

        $this->assertEquals($date, $data);
    }

}
