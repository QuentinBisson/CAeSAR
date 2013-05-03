<?php

namespace CAeSAR\ResourceBundle\DataFixtures\ORM;

use Caesar\ResourceBundle\Entity\Resource;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadResourceData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $arrResult = array();
        $arrLines = file('src/Caesar/ResourceBundle/DataFixtures/ORM/resourceFixtures.csv');

        $shelfRepository = $manager->getRepository('CaesarShelfBundle:Shelf');

        foreach ($arrLines as $line) {
            $arrResult[] = explode(';', $line);
        }
        foreach ($arrResult as $res) {
            $resource = new Resource();
            $resource->setShelf($shelfRepository->findOneByName($res[3]));
            $resource->setCode($res[0]);
            $resource->setDescription($res[1]);
            $resource->setLongDescription(str_replace('\n', "\n", $res[4]));
            $resource->setQuantity($res[2]);
            $filename = $this->handleImage($res[5], $resource->getCode());
            $resource->setPath($filename);
            $manager->persist($resource);
        }
        $manager->flush();
    }

    private function handleImage($url, $code) {
        $newFileName = "";
        $extension = explode('.', $url);
        $newFileName = $code . ".jpeg";
        $img = 'web/resources/img/' . $newFileName;
        file_put_contents($img, file_get_contents($url));
        $this->resizeImg($newFileName);
        return $newFileName;
    }

    /**
     * Méthode permettant de
     * @param type $fileName
     */
    private function resizeImg($fileName) {
        $prefix = "web/resources/img/";
        $info = getimagesize($prefix . $fileName);

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($prefix . $fileName);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($prefix . $fileName);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($prefix . $fileName);

        if ($image != null) {
            $sourceWidth = imagesx($image);
            $sourceHeight = imagesy($image);
            $newWidth = 140;
            $reduction = (($newWidth * 100) / $sourceWidth);
            $newHeight = (($sourceHeight * $reduction) / 100);
            $destinationResource = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($destinationResource, $image, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);
            imagejpeg($destinationResource, "web/resources/img/" . $fileName, 80);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 3; // the order in which fixtures will be loaded
    }

}