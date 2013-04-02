<?php
namespace Caesar\UserBundle\Tests\Entity;

use Caesar\UserBundle\Entity\User;
use Caesar\UserBundle\Entity\Borrowing;
use Caesar\ResourceBundle\Entity\Resource;

class BorrowingTest extends \PHPUnit_Framework_TestCase
{
	

	public function testBorrowingDate() {		
		$borrowing = new Borrowing();
		$date = new \DateTime('now');
		$borrowing->setBorrowingDate($date);
		$data = $borrowing->getBorrowingDate();
				
		$this->assertEquals($date, $data);
	}
	

	public function testUser() {
		$user = new User();		
		$borrowing = new Borrowing();
		$borrowing->setUser($user);
		$data = $borrowing->getUser();
				
		$this->assertEquals($user, $data);
	}

	public function testResource() {		
		$resource = new Resource();
		$borrowing = new Borrowing();
		$borrowing->setResource($resource);
		$data = $borrowing->getResource();
				
		$this->assertEquals($resource, $data);
	}
	
}
