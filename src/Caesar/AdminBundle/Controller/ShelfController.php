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

    /**
     *
     * Action permettant de lister les emplacements
     * @param type $page
     * @param type $sort
     * @param type $direction
     * @return typ
     */
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
        $count = $repository_shelf->count($keywords);

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

    /**
     * Action permettant d'ajouter un emplacement
     * @return type
     */
    public function addAction() {
        $translator = $this->get('translator');
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
                        'notice', $translator->trans('admin.form.shelves.notice.add', array('%shelf%' => $shelf->getName()))
                );
                return $this->redirect($this->generateUrl('caesar_admin_shelf_homepage'));
            }
        }

        return $this->render('CaesarAdminBundle:Shelf:add.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    /**
     * Action permettant de gérer la mise à jour d'un emplacement
     * @param type $id
     * @return type
     * @throws type
     */
    public function updateAction($id) {
        $translator = $this->get('translator');
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException($translator->trans('admin.form.shelves.exception', array('%shelf%' => $id)));
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $shelf = $em->getRepository('CaesarShelfBundle:Shelf')
                    ->find($clean);
        }

        if (!$shelf) {
            throw $this->createNotFoundException($translator->trans('admin.form.shelves.exception', array('%shelf%' => $id)));
        }

        $form = $this->createForm(new ShelfType(), $shelf);
        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $shelf = $form->getData();
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'notice', $translator->trans('admin.form.shelves.notice.update', array('%shelf%' => $shelf->getName()))
                );
                return $this->redirect($this->generateUrl('caesar_admin_shelf_homepage'));
            }
        }

        return $this->render('CaesarAdminBundle:Shelf:update.html.twig', array(
                    'form' => $form->createView(), 'shelf' => $id
        ));
    }

    /**
     * Action permettant de supprimer un emplacement
     * @param type $id
     * @return type
     * @throws type
     */
    public function deleteAction($id) {
        $translator = $this->get('translator');
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException($translator->trans('admin.form.shelves.exception', array('%shelf%' => $id)));
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $shelf = $em->getRepository('CaesarShelfBundle:Shelf')->find($clean);
        }

        if (!$shelf) {
            throw $this->createNotFoundException($translator->trans('admin.form.shelves.exception', array('%shelf%' => $id)));
        }
        $books = $em->getRepository('CaesarShelfBundle:Shelf')->findAllResourcesById($shelf->getId());
        if (count($books) > 0) {
            return $this->render('CaesarAdminBundle:Shelf:delete.html.twig', array('books' => $books, 'count' => count($books)));
        } else {
            $em->remove($shelf);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'notice', $translator->trans('admin.form.shelves.notice.delete', array('%shelf%' => $shelf->getName()))
            );

            return $this->render('CaesarAdminBundle:Shelf:delete.html.twig');
        }
    }

}