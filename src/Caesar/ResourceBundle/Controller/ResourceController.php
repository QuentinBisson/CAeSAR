<?php

namespace Caesar\ResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ResourceController extends Controller {

    public function indexAction() {
        return $this->render('CaesarResourceBundle:Resource:index.html.twig');
    }

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

}
