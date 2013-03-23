<?php

namespace Caesar\ResourceBundle\Controller;

use Caesar\ResourceBundle\Entity\Resource;
use Caesar\UserBundle\Entity\Borrowing;
use Caesar\UserBundle\Entity\BorrowingArchive;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;

class ResourceController extends Controller {

  public function consultAction($code) {
    $translator = $this->get('translator');
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else if (filter_input(INPUT_GET, $code, FILTER_VALIDATE_INT) !== false) {
      $clean = $code;
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->find($clean);
    } else {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    return $this->render('CaesarResourceBundle:Resource:consultation.html.twig', array('resource' => $resource));
  }

  public function ajaxGetAction($code) {
    $translator = $this->get('translator');
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }

    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    $request = $this->get('request');
    if ($request->isXmlHttpRequest()) {
      return new Response(json_encode($resource->getJsonData()));
    }
    throw $this->createNotFoundException($translator->trans('form.invalid'));
  }

  public function borrowAction($code) {
    $translator = $this->get('translator');
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }

    $q = $resource->getQuantity();
    $borrowedQuantity = count($resource->getBorrowings());

    //if at least one available
    if ($q > $borrowedQuantity) {
      $reservedQuantity = count($resource->getReservations());
      $available = $q - $borrowedQuantity - $reservedQuantity;

      if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
        $user = $this->get('security.context')->getToken()->getUser();

        if ($available > 0) { //Si pas de réservation bloquante
          $borrow = new Borrowing();
          $borrow->setResource($resource);
          $borrow->setUser($user);
          $em->persist($borrow);
          $em->flush();
          $this->get('session')->getFlashBag()->add(
            'notice', $translator->trans('client.borrowing.resource.borrowed', array('%resource%' => $resource->getDescription()))
          );
          return $this->redirect($this->generateUrl('caesar_client_homepage'));
        } else {
          $reservedAvailable = $q - $borrowedQuantity;
          $acceptedReservations = array();
          $reservations = $resource->getReservations();
          $i = 0;
          array_push($acceptedReservations, $reservations->first());
          while ($i < $reservedAvailable - 1) {
            array_push($acceptedReservations, $reservations->next());
            $i++;
          }
          $reservation = null;
          foreach ($acceptedReservations as $r) {
            if ($r->getUser()->isEqualTo($user)) {
              $reservation = $r;
            }
          }
          //Si user parmi les premiers à réserver
          if ($reservation != null) {
            $em->remove($reservation);
            $borrow = new Borrowing();
            $borrow->setResource($resource);
            $borrow->setUser($user);
            $em->persist($borrow);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
              'notice', $translator->trans('client.borrowing.resource.reservation.borrowed', array('%resource%' => $resource->getDescription()))
            );
            return $this->redirect($this->generateUrl('caesar_client_homepage'));
          } else {
            $isInList = false;
            foreach ($resource->getReservations()->toArray() as $reservation) {
              if ($reservation->getUser()->isEqualTo($user)) {
                $isInList = true;
              }
            }
            //Pas le premier sur la liste de réservation
            if ($isInList) {
              $this->get('session')->getFlashBag()->add(
                'error', $translator->trans('client.borrowing.resource.reservation.error', array('%resource%' => $resource->getDescription()))
              );
              return $this->redirect($this->generateUrl('caesar_client_homepage'));
            } else { //Ressource non réservée.
              $this->get('session')->getFlashBag()->add(
                'error', $translator->trans('client.borrowing.resource.reservation.none', array('%resource%' => $resource->getDescription()))
              );
              return $this->redirect($this->generateUrl('caesar_client_homepage'));
            }
          }
        }
      } else {//Je dois me connecter
        $this->get('session')->getFlashBag()->add(
          'info', $translator->trans('client.borrowing.resource.connect', array('%resource%' => $resource->getDescription()))
        );

        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
          $error = $request->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR
          );
        } else {
          $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
          $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'CaesarUserBundle:User:login.html.twig', array(
              'login_page_title' => $translator->trans('borrow.title'),
              'resource' => $resource,
              'last_username' => $session->get(SecurityContext::LAST_USERNAME),
              'error' => $error)
        );
      }
    }
    //Plus de ressources disponibles
    $this->get('session')->getFlashBag()->add(
      'error', $translator->trans('client.borrowing.resource.unavailable', array('%resource%' => $resource->getDescription()))
    );
    return $this->redirect($this->generateUrl('caesar_client_homepage'));
  }

  public function returnAction($code) {
    $translator = $this->get('translator');
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }

    $q = $resource->getQuantity();
    $borrowedQuantity = count($resource->getBorrowings());

    if ($borrowedQuantity <= 0) {
      throw $this->createNotFoundException($translator->trans('client.return.impossible.exception', array('%resource%' => $resource->getDescription())));
    }

    if ($borrowedQuantity == 1) { //if only one borrowed
      $borrowing = $resource->getBorrowings()->first();
      $archivedBorrowing = new BorrowingArchive();
      $archivedBorrowing->setBorrowingDate($borrowing->getBorrowingDate());
      $archivedBorrowing->setResource($borrowing->getResource());
      $archivedBorrowing->setUser($borrowing->getUser());
      $em->remove($borrowing);
      $em->persist($archivedBorrowing);
      $em->flush();
      $this->get('session')->getFlashBag()->add(
        'notice', $translator->trans('client.return.accepted', array('%resource%' => $resource->getDescription()))
      );
      return $this->redirect($this->generateUrl('caesar_client_homepage'));
    } else if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
      $user = $this->get('security.context')->getToken()->getUser();
      $borrowing = $em->getRepository('CaesarUserBundle:Borrowing')->findOneByUser($user);
      if ($borrowing != null) { //je suis un emprunter Rendre
        $archivedBorrowing = new BorrowingArchive();
        $archivedBorrowing->setBorrowingDate($borrowing->getBorrowingDate());
        $archivedBorrowing->setResource($borrowing->getResource());
        $archivedBorrowing->setUser($borrowing->getUser());
        $em->remove($borrowing);
        $em->persist($archivedBorrowing);
        $em->flush();

        $availableReservations = $q - $borrowedQuantity;
        $userToNotify = array();
        $reservations = $resource->getReservations();
        $i = 0;
        array_push($userToNotify, $reservations->first());
        while ($i < $availableReservations - 1) {
          array_push($userToNotify, $reservations->next());
          $i++;
        }
        //TODO send email to $acceptedReservations

        $this->get('session')->getFlashBag()->add(
          'notice', $translator->trans('client.return.accepted', array('%resource%' => $resource->getDescription()))
        );
        return $this->redirect($this->generateUrl('caesar_client_homepage'));
      } else { //message
        $this->get('session')->getFlashBag()->add(
          'error', $translator->trans('client.return.refused', array('%resource%' => $resource->getDescription()))
        );
        return $this->redirect($this->generateUrl('caesar_client_homepage'));
      }
    }

    $this->get('session')->getFlashBag()->add(
      'info', $translator->trans('client.return.connect', array('%resource%' => $resource->getDescription()))
    );

    $request = $this->getRequest();
    $session = $request->getSession();

    if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
      $error = $request->attributes->get(
        SecurityContext::AUTHENTICATION_ERROR
      );
    } else {
      $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
      $session->remove(SecurityContext::AUTHENTICATION_ERROR);
    }

    return $this->render(
        'CaesarUserBundle:User:login.html.twig', array(
          'login_page_title' => $translator->trans('return.title'),
          'resource' => $resource,
          'last_username' => $session->get(SecurityContext::LAST_USERNAME),
          'error' => $error)
    );
  }

}

