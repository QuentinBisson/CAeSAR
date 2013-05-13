<?php

namespace Caesar\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase {
    private $identifier = "Chimere";
    private $password = "Manticore";
    
    public function testIdentification() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/fr/login');
        $form = $crawler->selectButton("Connexion")->form();
        
        $form['_username'] = $this->identifier;
        
        $client->submit($form);   
        $this->assertTrue($crawler->filter('html:contains("' . $this->identifier . '")')->count() > 0);
    }  
    
    public function testAuthentificationAndInformations() {
        $client = static::createClient();
        
        $login = $client->request('GET', '/fr/login');
        $form_log = $login->selectButton("Connexion")->form();
        $form_log['_username'] = $this->identifier;
        $client->submit($form_log);
        
        $profile = $client->request('GET', '/fr/profile');
        $link = $profile->filterXpath("//a[@name='modifyProfile']")->eq(1)->link();
        $client->click($link);
        $form_auth = $login->selectButton("Connexion")->form();
        $form_auth['caesar_userBundle_passwordType[plainPassword]'] = $this->password;
        $client->submit($form_auth);
        
        $form_profile = $profile->selectButton("Modifier mon profil")->form();
        $form_profile['caesar_userBundle_userUpdateType[name]'] = "Albert";
        $form_profile['caesar_userBundle_userUpdateType[plainPassword]'] = $this->password;
        $form_profile['caesar_userBundle_userUpdateType[confirmPassword]'] = $this->password;
        $client->submit($form_profile);
        
        $this->assertTrue($profile->filter('html:contains("Albert")')->count() > 0);      
    }   

}
