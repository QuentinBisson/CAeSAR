<?php
namespace Caesar\UserBundle\Tests\Entity;

use Caesar\UserBundle\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
	public function testUsername() {
		$user = new User();
		$user->setUsername("john");
		$data = $user->getUsername();
				
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
		/*$user->setEmail(22);
		$data = $user->getEmail();
	
		$this->assertNotEquals(22, $data);*/
		
		$user->setEmail("mail");
		$data = $user->getEmail();
		
		$this->assertEquals("mail", $data);
	}
	
	public function testConfirmPassword() {
		$user = new User();
		$user->setConfirmPassword("john");
		$data = $user->getConfirmPassword();
	
		$this->assertEquals("john", $data);
	}
	
	public function testPassword() {
		$user = new User();
		$user->setPassword("john");
		$data = $user->getPassword();
	
		$this->assertEquals("john", $data);
	}
	
	public function testName() {
		$user = new User();
		$user->setName("john");
		$data = $user->getName();
	
		$this->assertEquals("john", $data);
	}
	
	
	
	
}
