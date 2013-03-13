<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\AdminBundle\Form\BorrowingSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BorrowingController extends Controller {

  public function indexAction($page = 1, $sort = 'id', $direction = 'asc', $user = null, $resource = null) {
    $nb_per_page = 10;
    $em = $this->getDoctrine()->getManager();
    $searchForm = $this->createForm(new BorrowingSearchType());
    $user = null;
    $resource = null;
    $archived = null;

    $repository_borrowing = $em->getRepository('CaesarUserBundle:Borrowing');

    $request = $this->get('request');
    if ($request->isMethod('POST')) {
      $searchForm->bind($request);
      if ($searchForm->isValid()) {
        $data = $searchForm->getData();
        //$user = $data['user'];
        //$resource = $data['resource'];
        $archived = $data['archived'];
      }
    }

    if ($archived) {
      $currentBorrowings = $repository_borrowing->getCurrentBorrowingsFromToSortBy($page, $sort, $direction, $user, $resource);
      $repository_archived_borrowing = $em->getRepository('CaesarUserBundle:BorrowingArchive');
      $archivedBorrowings = $repository_archived_borrowing->getArchivedBorrowingsFromToSortBy($page, $sort, $direction, $user, $resource);
      $borrowings = array_merge($currentBorrowings, $archivedBorrowings);
    } else {
      $borrowings = $repository_borrowing->getCurrentBorrowingsFromToSortBy($page, $sort, $direction, $user, $resource);
    }
    $count = count($borrowings);

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