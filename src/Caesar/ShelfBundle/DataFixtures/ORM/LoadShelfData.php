<?php
namespace CAeSAR\ShelfBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CAeSAR\ShelfBundle\Entity\Shelf;

class LoadShelfData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    	$arrResult = array();
        $arrLines = file('src/Caesar/ShelfBundle/DataFixtures/ORM/shelfFixtures.csv');
    	foreach($arrLines as $line) {
    		$arrResult[] = explode( ',', $line);
    	}
    	foreach($arrResult as $res) {
    		$shelf = new Shelf();
    		$shelf->setDescription($res[1]);
    		$shelf->setName($res[0]);    		
    		$manager->persist($shelf);
    	}        
        
        $manager->flush();        
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
