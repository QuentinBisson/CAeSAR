<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\AdminBundle\Form\BorrowingSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BorrowingController extends Controller {

  /**
   * Lister les emprunts en cours ou archivés
   * @param type $page
   * @param type $sort
   * @param type $direction
   * @return type
   */
  public function indexAction($page = 1, $sort = 'id', $direction = 'asc') {
    $nb_per_page = 10;
    $em = $this->getDoctrine()->getManager();
    $searchForm = $this->createForm(new BorrowingSearchType());
    $archived = null;

    $repository_borrowing = $em->getRepository('CaesarUserBundle:Borrowing');

    $request = $this->get('request');
    if ($request->isMethod('POST')) {
      $searchForm->bind($request);
      if ($searchForm->isValid()) {
        $data = $searchForm->getData();
        $archived = $data['archived'];
      }
    }

    if ($archived) {
      $borrowings = $repository_borrowing->getAllBorrowingsFromToSortBy($page, $sort, $direction);
      $repository_archived_borrowing = $em->getRepository('CaesarUserBundle:BorrowingArchive');
      $c1 = $repository_borrowing->count();
      $c2 = $repository_archived_borrowing->count();
      $count = $c1 + $c2;
    } else {
      $borrowings = $repository_borrowing->getCurrentBorrowingsFromToSortBy($page, $sort, $direction);
      $count = $repository_borrowing->count();
    }

    /* Pagination */
    $total = $count;
    $pagination = array(
        'cur' => $page,
        'max' => floor($total / $nb_per_page),
    );

    $array = array(
        'borrowings' => $borrowings,
        'page' => $page,
        'sort' => $sort,
        'direction' => $direction,
        'count' => $count,
        'pagination' => $pagination);

    if ($request->isXmlHttpRequest()) {
      return $this->render("CaesarAdminBundle:Borrowing:list.html.twig", $array);
    }

    $array['searchForm'] = $searchForm->createView();

    return $this->render("CaesarAdminBundle:Borrowing:index.html.twig", $array);
  }

  /**
   * Rechercher les emprunts à partir d'un utilisateur
   *
   * @param type $user
   * @param type $page
   * @param type $sort
   * @param type $direction
   * @return type
   */
  public function searchUserAction($user, $page, $sort, $direction) {
    $nb_per_page = 10;
    $em = $this->getDoctrine()->getManager();
    $searchForm = $this->createForm(new BorrowingSearchType());
    $archived = null;

    $repository_borrowing = $em->getRepository('CaesarUserBundle:Borrowing');

    $request = $this->get('request');
    if ($request->isMethod('POST')) {
      $searchForm->bind($request);
      if ($searchForm->isValid()) {
        $data = $searchForm->getData();
        $archived = $data['archived'];
      }
    }
    $user = $em->getRepository('CaesarUserBundle:User')->find($user);
    if ($archived) {
      $borrowings = $repository_borrowing->getAllBorrowingsFromToSortBy($page, $sort, $direction, $user);
      $repository_archived_borrowing = $em->getRepository('CaesarUserBundle:BorrowingArchive');
      $c1 = $repository_borrowing->count($user);
      $c2 = $repository_archived_borrowing->count($user);
      $count = $c1 + $c2;
    } else {
      $borrowings = $repository_borrowing->getCurrentBorrowingsFromToSortBy($page, $sort, $direction, $user);
      $count = $repository_borrowing->count();
    }

    /* Pagination */
    $total = $count;
    $pagination = array(
        'cur' => $page,
        'max' => floor($total / $nb_per_page),
    );

    $array = array(
        'borrowings' => $borrowings,
        'page' => $page,
        'sort' => $sort,
        'direction' => $direction,
        'count' => $count,
        'pagination' => $pagination);

    if ($request->isXmlHttpRequest()) {
      return $this->render("CaesarAdminBundle:Borrowing:list.html.twig", $array);
    }

    $array['searchForm'] = $searchForm->createView();
    return $this->render("CaesarAdminBundle:Borrowing:index.html.twig", $array);
  }

  /**
   * Rechercher les emprunts à partir d'une ressource
   *
   * @param type $resource
   * @param type $page
   * @param type $sort
   * @param type $direction
   * @return type
   */
  public function searchResourceAction($resource, $page, $sort, $direction) {
    $nb_per_page = 10;
    $em = $this->getDoctrine()->getManager();
    $searchForm = $this->createForm(new BorrowingSearchType());
    $archived = null;

    $repository_borrowing = $em->getRepository('CaesarUserBundle:Borrowing');

    $request = $this->get('request');
    if ($request->isMethod('POST')) {
      $searchForm->bind($request);
      if ($searchForm->isValid()) {
        $data = $searchForm->getData();
        $archived = $data['archived'];
      }
    }
    $resource = $em->getRepository('CaesarResourceBundle:Resource')->find($resource);
    if ($resource == null) {
      $this->createNotFoundException();
    }
    if ($archived) {
      $borrowings = $repository_borrowing->getAllBorrowingsFromToSortBy($page, $sort, $direction, null, $resource);
      $repository_archived_borrowing = $em->getRepository('CaesarUserBundle:BorrowingArchive');
      $c1 = $repository_borrowing->count(null, $resource);
      $c2 = $repository_archived_borrowing->count(null, $resource);
      $count = $c1 + $c2;
    } else {
      $borrowings = $repository_borrowing->getCurrentBorrowingsFromToSortBy($page, $sort, $direction, null, $resource);
      $count = $repository_borrowing->count();
    }

    /* Pagination */
    $total = $count;
    $pagination = array(
        'cur' => $page,
        'max' => floor($total / $nb_per_page),
    );

    $array = array(
        'borrowings' => $borrowings,
        'page' => $page,
        'sort' => $sort,
        'direction' => $direction,
        'count' => $count,
        'pagination' => $pagination);

    if ($request->isXmlHttpRequest()) {
      return $this->render("CaesarAdminBundle:Borrowing:list.html.twig", $array);
    }

    $array['searchForm'] = $searchForm->createView();
    return $this->render("CaesarAdminBundle:Borrowing:index.html.twig", $array);
  }

}