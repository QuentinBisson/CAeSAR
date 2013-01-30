<?php
namespace Caesar\UserBundle\Tests\Entity;

use Caesar\UserBundle\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
	public function testLogin() {
		$user = new User();
		$user->setLogin("john");
		$data = $user->getLogin();
				
		$this->assertEquals("john", $data);
	}
	
	public function testCodeBu() {
		$user = new User();
		$user->setCodeBu(12);
		$data = $user->getCodeBu();
	
		$this->assertEquals(12, $data);
	}
	
	public function testEmail() {
		$user = new User();
		$user->setEmail(22);
		$data = $user->getEmail();
	
		$this->assertNotEquals(22, $data);
		
		$user->setEmail("mail");
		$data = $user->getEmail();
		
		$this->assertNotEquals("mail", $data);
	}
	
	
}
