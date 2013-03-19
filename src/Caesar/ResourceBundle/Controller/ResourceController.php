<?php

namespace Caesar\ResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller {

  public function consultAction($id) {
    if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
      $clean = $id;
    } else {
      throw $this->createNotFoundException('L\'identifiant ' . $id . ' n\'est pas valide.');
    }

    $em = $this->getDoctrine()->getManager();
    if (isset($clean)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->find($clean);
    }

    if (!$resource) {
      throw $this->createNotFoundException('Ressource non trouvée avec id ' . $id);
    }
    return $this->render('CaesarResourceBundle:Resource:consultation.html.twig', array('resource' => $resource));
  }

  public function ajaxGetAction($code) {
    //TODO clean
    $em = $this->getDoctrine()->getManager();
    if (isset($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
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

}
