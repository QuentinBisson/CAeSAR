<?php

namespace Caesar\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Caesar\ShelfBundle\Entity\Shelf;
use Caesar\ShelfBundle\Form\ShelfType;
use Caesar\ShelfBundle\Form\ShelfSearchType;

/**
 * Description of ShelfController
 *
 * @author bissoqu1
 */
class ShelfController extends Controller {

    public function indexAction($page = 1, $sort = 'name', $direction = 'asc') {

        $nb_per_page = 10; // Nombre d'éléments affichés par page (pour la pagination)
        $searchForm = $this->createForm(new ShelfSearchType());
        $keywords = null;
        $em = $this->getDoctrine()->getManager();

        $repository_shelf = $em->getRepository('CaesarShelfBundle:Shelf');

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $searchForm->bind($request);
            if ($searchForm->isValid()) {
                $data = $searchForm->getData();
                $keywords = $data['keywords'];
            }
        }
        if (!empty($keywords)) {
            $keywords = explode(" ", $keywords);
        }

        $shelves = $repository_shelf->getShelfFromToSortBy($page, $sort, $direction, $keywords);
        $count = $repository_shelf->count();

        /* Pagination */
        $total = $count;
        $pagination = array(
            'cur' => $page,
            'max' => floor($total / $nb_per_page),
        );

        $array = array(
            'shelves' => $shelves,
            'page' => $page,
            'sort' => $sort,
            'direction' => $direction,
            'count' => $count,
            'pagination' => $pagination);

        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarAdminBundle:Shelf:list.html.twig", $array);
        }

        $array['searchForm'] = $searchForm->createView();

        return $this->render("CaesarAdminBundle:Shelf:index.html.twig", $array);
    }

    public function addAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $shelf = new Shelf();

        $form = $this->createForm(new ShelfType(), $shelf);
        $request = $this->get('request');

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $shelf = $form->getData();
                $em->persist($shelf);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'notice', 'L\'emplacement ' . $shelf->getName() . ' a été ajouté.'
                );
                return $this->redirect($this->generateUrl('caesar_admin_shelf_homepage'));
            }
        }

        return $this->render('CaesarAdminBundle:Shelf:add.html.twig', array(
                    'form' => $form->createView()
                ));
    }

    public function updateAction($id) {
        if (filter_input($id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException('L\'identifiant ' . $id . ' est invalide.');
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $shelf = $em->getRepository('CaesarShelfBundle:Shelf')
                    ->find($clean);
        }

        if (!$shelf) {
            throw $this->createNotFoundException('Produit non trouvé avec id ' . $id);
        }

        $form = $this->createForm(new ShelfType(), $shelf);
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $shelf = $form->getData();
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'notice', 'L\'emplacement ' . $shelf->getName() . ' a été modifié.'
                );
                $this->redirect($this->generateUrl('caesar_admin_shelf_homepage'));
            }
        }

        return $this->render('CaesarAdminBundle:Shelf:update.html.twig', array(
                    'form' => $form->createView(), 'shelf' => $id
                ));
    }

    public function deleteAction($id) {
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException('L\'identifiant ' . $id . ' n\'est pas valide.');
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $shelf = $em->getRepository('CaesarShelfBundle:Shelf')
                    ->find($clean);
        }

        if (!$shelf) {
            throw $this->createNotFoundException('Produit non trouvé avec id ' . $id);
        }

        $books = $shelf->getResources();

        if ($books->count() > 0) {
            return $this->render('CaesarAdminBundle:Shelf:delete.html.twig', array('books', $books));
        } else {
            $em->remove($shelf);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', 'L\'emplacement ' . $shelf->getName() . ' a été supprimé.'
            );

            return $this->render('CaesarAdminBundle:Shelf:delete.html.twig');
        }
    }

}

?>
