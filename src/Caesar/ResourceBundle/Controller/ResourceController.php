<?php

namespace Caesar\ResourceBundle\Controller;

use Caesar\ResourceBundle\Entity\Resource;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller {

  public function consultAction($code) {
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else if (filter_input(INPUT_GET, $code, FILTER_VALIDATE_INT) !== false) {
      $clean = $code;
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->find($clean);
    } else {
      throw $this->createNotFoundException('L\'identifiant ' . $code . ' n\'est pas valide.');
    }
    if (!$resource) {
      throw $this->createNotFoundException('Ressource non trouvée avec id ' . $code);
    }
    return $this->render('CaesarResourceBundle:Resource:consultation.html.twig', array('resource' => $resource));
  }

  public function ajaxGetAction($code) {
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else {
      throw $this->createNotFoundException('L\'identifiant ' . $code . ' n\'est pas valide.');
    }

    if (!$resource) {
      throw $this->createNotFoundException('Ressource non trouvée avec code ' . $code);
    }
    $request = $this->get('request');
    if ($request->isXmlHttpRequest()) {
      return new Response(json_encode($resource->getJsonData()));
    }
    throw $this->createNotFoundException('Requete invalide');
  }

  public function borrowAction($code) {
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else {
      throw $this->createNotFoundException('L\'identifiant ' . $code . ' n\'est pas valide.');
    }
    if (!$resource) {
      throw $this->createNotFoundException('Ressource non trouvée avec id ' . $code);
    }
    return $this->render('CaesarResourceBundle:Resource:borrow.html.twig', array('resource' => $resource));
  }

  public function returnAction($code) {
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else {
      throw $this->createNotFoundException('L\'identifiant ' . $code . ' n\'est pas valide.');
    }
    if (!$resource) {
      throw $this->createNotFoundException('Ressource non trouvée avec id ' . $code);
    }
    return $this->render('CaesarResourceBundle:Resource:return.html.twig', array('resource' => $resource));
  }

}
