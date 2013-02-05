<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Caesar\LocationBundle\Entity\Location;
use Caesar\LocationBundle\Form\LocationType;
/**
 * Description of LocationController
 *
 * @author bissoqu1
 */
class LocationController extends Controller {

    public function indexAction($page = 1, $sort = 'name', $direction = 'asc') {

        $nb_per_page = 10; // Nombre d'éléments affichés par page (pour la pagination)
        $em = $this->getDoctrine()->getManager();

        $repository_location = $em->getRepository('CaesarLocationBundle:Location');

        $locations = $repository_location->getLocationFromToSortBy($page, $sort, $direction);
        $count = $repository_location->count();

        /* Pagination */
        $total = $count;
        $pagination = array(
            'cur' => $page,
            'max' => floor($total / $nb_per_page),
        );

        $array = array(
            'locations' => $locations,
            'page' => $page,
            'sort' => $sort,
            'direction' => $direction,
            'count' => $count,
            'pagination' => $pagination);

        $request = $this->get('request');
        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarAdminBundle:Location:list.html.twig", $array);
        }

        return $this->render("CaesarAdminBundle:Location:index.html.twig", $array);
    }

    public function addAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $location = new Location();
        $form = $this->createForm(new LocationType(), $location);
        $request = $this->get('request');

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $location = $form->getData();
                $em->persist($location);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'notice', 'L\'emplacement ' . $location->getName() . ' a été ajouté.'
                );
                return $this->redirect($this->generateUrl('caesar_admin_location_homepage'));
            }
        }

        return $this->render('CaesarAdminBundle:Location:add.html.twig', array(
                    'form' => $form->createView(),
                ));
    }

    public function updateAction() {
        return $this->render('CaesarAdminBundle:Location:update.html.twig');
    }

    public function deleteAction() {
        return $this->render('CaesarAdminBundle:Location:delete.html.twig');
    }

}

?>
